<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\GithubService;

class GithubController extends Controller
{
    /**
     * @param App\Services\GitHhubService $service
     */
    protected $gitHubService;

    public function __construct(GithubService $service)
    {
        $this->gitHubService = $service;
    }


    public function find(string $name):JsonResponse
    {
        $repo = $this->gitHubService->findRepository($name);

        return response()->json($repo);
    }

    /**
     * @param  Illuminate\Http\Request $request
     */
    public function index(Request $request)
	{
	    $filter = $request->query('filter');

	    if (!empty($filter)) {
	        $repos = $this->gitHubService->findRepository($filter);
	    } else {
	        $repos = Null;
	    }

	    return view('dashboard')->with('repos', $repos)->with('filter', $filter);
	}



} 
