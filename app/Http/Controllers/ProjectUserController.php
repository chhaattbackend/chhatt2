<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectusers=ProjectUser::paginate(25);
        return view('admin.project_user.index',compact('projectusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $projects=Project::all();
        $users=User::all();

        return view('admin.project_user.create',compact('projects','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProjectUser::create($request->all());
        return redirect()->route('projectusers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectUser $projectUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectUser $projectUser)
    {
        $projects=Project::all();
        $users=User::all();

        return view('admin.project_user.create',compact('projects','users','projectUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectUser $projectUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectUser $projectUser)
    {
        //
    }
}
