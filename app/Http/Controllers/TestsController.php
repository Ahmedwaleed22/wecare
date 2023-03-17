<?php

namespace App\Http\Controllers;

use App\helpers\ApiResponder;
use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    use ApiResponder;

    public function all() {
        $tests = Test::all();
        return $this->apiResponse(200, null, null, TestResource::collection($tests));
    }
    
    public function get(Test $test) {
        return $this->apiResponse(200, null, null, new TestResource($test));
    }
}
