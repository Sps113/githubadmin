<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\GitHubRepository;
use App\Http\Requests\Repositories as RequestRepositories;

class  GithubFavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repositories = GitHubRepository::where('user_id', '=', auth()->user()->id)->paginate(5);

        return view('favorites.index')->with('repositories', $repositories);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestRepositories  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RequestRepositories $request)
    {        
        if($request->validated()) {
            GitHubRepository::create($request->all() );
            return response()->json(['message' => 'Successful '.$request->name.' adding to favorites']);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        
        GitHubRepository::where('user_id', $request->user_id)->where('name', $request->name)->delete();
        return response()->json(['message' => 'Successful '.$request->name.' deleting from favorites']);
        
    }
}
