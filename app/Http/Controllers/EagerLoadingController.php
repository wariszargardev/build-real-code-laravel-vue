<?php

namespace App\Http\Controllers;

use App\Services\EagerLoadingService;
use Illuminate\View\View;

class EagerLoadingController extends Controller
{
    public function __construct(private readonly EagerLoadingService $eagerLoadingService) {}

    public function index(): View
    {
        return view('eager-loading.index', ['users' => $this->eagerLoadingService->getUsers()]);

        // $with default property
        // return view('eager-loading.index', ['posts' => $this->eagerLoadingService->getLatestPosts()]);
    }
}
