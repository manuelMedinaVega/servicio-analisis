<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResultResource;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function list($positionId)
    {
        $results = Result::where('position_id', $positionId)->orderBy('score', 'desc')->paginate();
        return ResultResource::collection($results);
    }
}
