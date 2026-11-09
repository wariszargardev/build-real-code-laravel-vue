<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Demo\DemoModeRequest;
use App\Services\Day01EagerLoading\EagerLoadingDemo;
use Illuminate\Http\JsonResponse;

class Day01EagerLoadingController extends Controller
{
    public function __construct(private EagerLoadingDemo $eagerLoadingDemo) {}

    public function selectColumns(DemoModeRequest $request): JsonResponse
    {
        return response()->json($this->eagerLoadingDemo->selectColumns($request->mode()));
    }
}
