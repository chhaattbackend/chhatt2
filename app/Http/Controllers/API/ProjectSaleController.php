<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Http\Resources\ProjectSaleCollection;
use App\Project;
use App\ProjectBuyer;
use App\ProjectSale;
use App\ProjectShop;
use Illuminate\Http\Request;

class ProjectSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $projectsales = ProjectSale::orderBy('created_at','desc')->paginate(25);
            return new ProjectSaleCollection($projectsales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $projects = Project::all();
            $shops=ProjectShop::all();
            $buyers=ProjectBuyer::all();
            return view('admin.project_sales.create',compact('projects','shops','buyers'));
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
            'shop_id' => 'required',
            'buyer_id' => 'required',
            'price' => 'required',
        ]);
        $data = ProjectSale::create($request->all());

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
    public function edit(Request $request,$id)
    {
            $projectsale = ProjectSale::findOrfail($id);
            $shops=ProjectShop::all();
            $projects = Project::all();
            $buyers=ProjectBuyer::all();

            return view('admin.project_sales.edit',compact('projectsale','projects','shops','buyers'));
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
        // ProjectSale::where('id',$id)->update($request->all());
        $projectsale=ProjectSale::find($id);
        $projectsale->update($request->all());
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
        $data = ProjectSale::findOrfail($id);
        $data->delete();

        return redirect('/projectsales')->with('message','Deleted');
    }
}
