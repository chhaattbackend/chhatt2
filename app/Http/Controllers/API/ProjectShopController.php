<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Http\Resources\ProjectShopCollection;
use App\Project;
use App\ProjectShop;
use Illuminate\Http\Request;

class ProjectShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectshops=ProjectShop::orderBy('created_at','desc')->paginate(25);
        return new ProjectShopCollection($projectshops);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('admin.project_shop.create',compact(['projects']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'name' => 'required',
            'floor' => 'required',
            'size' => 'required',
            'size_type' => 'required',
            'code' => 'required',
            'type' => 'required',
        ]);
        ProjectShop::create($request->all());
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
        $projectshop=ProjectShop::find($id);
        $projects = Project::all();
        return view('admin.project_shop.edit',compact(['projectshop','projects']));
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
        $projectshop=ProjectShop::find($id);
        $projectshop->update($request->all());
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

        $item=ProjectShop::find($id);
        $item->delete();
        return redirect()->back();
    }
}
