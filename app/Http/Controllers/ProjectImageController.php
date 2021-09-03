<?php

namespace App\Http\Controllers;

use App\GlobalClass;
use App\Project;
use App\ProjectImage;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $globalclass;
    public function __construct()
    {
        $this->globalclass = new GlobalClass();
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectImage  $projectImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectImage $projectImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectImage  $projectImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectImage $projectImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectImage  $projectImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectImage $projectImage)
    {
        $project = Project::find($request->project_id);
        if ($request->hasfile('images')) {
            $this->globalclass->storeMultipleS3project($request->file('images'), 'projects', $project->id);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectImage  $projectImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projectImage=ProjectImage::find($id);
        $projectImage->delete();
        return redirect()->back();
    }
}
