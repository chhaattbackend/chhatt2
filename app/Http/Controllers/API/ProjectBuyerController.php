<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectBuyer as ResourcesProjectBuyer;

;

use App\Http\Resources\ProjectBuyerCollection;
use App\Project;
use App\ProjectBuyer;
use Illuminate\Http\Request;

class ProjectBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectbuyers=ProjectBuyer::orderBy('created_at','desc')->paginate(25);
        return new ProjectBuyerCollection($projectbuyers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('admin.project_buyer.create',compact(['projects']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'project_id' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'cnic' => 'required',
            'dob' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        ProjectBuyer::create($request->all());
        return response()->json([
            'success'=>true
        ]);
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
        $projectbuyer= ProjectBuyer::find($id);
        return new ResourcesProjectBuyer($projectbuyer);
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
        $projectbuyer=ProjectBuyer::find($id);
        $projectbuyer->update($request->all());
        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item=ProjectBuyer::find($id);
        $item->delete();
        return redirect()->back();
    }
}
