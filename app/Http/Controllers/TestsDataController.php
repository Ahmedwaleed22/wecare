<?php

namespace App\Http\Controllers;

use App\helpers\ApiResponder;
use App\Http\Resources\TestDataResource;
use App\Models\TestsData;
use Illuminate\Http\Request;

class TestsDataController extends Controller
{
    use ApiResponder;

    public function all() {
        $testData = TestsData::with(['test', 'doctor', 'patient'])->get();
        return $this->apiResponse(200, null, null, TestDataResource::collection($testData));
    }

    public function store(Request $request) {
        $request->merge([
            'result' => json_encode($request->result),
            'user_id' => $request->user()->id,
        ]);

        $request->validate([
            'result' => 'required|json',
            'test_id' => 'required|integer',
            'patient_id' => 'required|integer'
        ]);

        $testData = TestsData::create($request->all());
        return $this->apiResponse(200, null, null, new TestDataResource($testData));
    }

    public function show(TestsData $testData) {
        return $this->apiResponse(200, null, null, new TestDataResource($testData));
    }
}
