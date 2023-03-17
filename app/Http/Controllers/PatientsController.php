<?php

namespace App\Http\Controllers;

use App\helpers\ApiResponder;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    use ApiResponder;

    public function all()
    {
        $patients = Patient::with('doctor')->get();
        return $this->apiResponse(200, null, null, PatientResource::collection($patients));
    }

    public function store(PatientRequest $request)
    {
        $request->merge([
            'user_id' => $request->user()->id,
        ]);

        $patient = Patient::create($request->all());
        return $this->apiResponse(200, null, null, new PatientResource($patient));
    }

    public function show(Patient $patient)
    {
        return $this->apiResponse(200, null, null, new PatientResource($patient));
    }
}
