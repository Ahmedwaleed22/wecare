<?php

namespace App\Http\Controllers;

use App\helpers\ApiResponder;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    use ApiResponder;

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) return $this->apiResponse(401, 'validation error', $validateUser->errors());

            if (!Auth::attempt($request->only(['email', 'password']))) return $this->apiResponse(401, 'Email & Password does not match with our record.', $validateUser->errors());

            $user = User::where('email', $request->email)->first();

            return $this->generateToken($user);
        } catch (\Throwable $th) {
            return $this->apiResponse(500, $th->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) return $this->apiResponse(401, 'validation error', $validateUser->errors());

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return $this->generateToken($user);
        } catch (\Throwable $th) {
            return $this->apiResponse(500, $th->getMessage());
        }
    }

    public function me(Request $request)
    {
        return $this->apiResponse(200, null, null, new UserResource($request->user()));
    }

    private function generateToken($user) {
        return $this->apiResponse(200, 'User Created Successfully', null, [
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ]);
    }
}
