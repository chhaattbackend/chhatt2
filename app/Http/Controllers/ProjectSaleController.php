<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        if (!$request->keyword) {

            $projectsales = ProjectSale::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $projectsales = ProjectSale::where('id','!=',null)->orderBy('created_at','desc');

            $projectsales = $projectsales->whereHas('project', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('shop', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('buyer', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->paginate(25)->setPath('');

            $pagination = $projectsales->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.project_sales.index', compact('projectsales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        $shops = ProjectShop::all();
        $buyers = ProjectBuyer::all();
        return view('admin.project_sales.create', compact('projects', 'shops', 'buyers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ProjectSale::create($request->all());

        return redirect()->route('projectsales.index');
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
    public function edit(Request $request, $id)
    {
        $projectsale = ProjectSale::findOrfail($id);
        $shops = ProjectShop::all();
        $projects = Project::all();
        $buyers = ProjectBuyer::all();

        return view('admin.project_sales.edit', compact('projectsale', 'projects', 'shops', 'buyers'));
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
        $projectsale = ProjectSale::find($id);
        $projectsale->update($request->all());
        return redirect()->route('projectsales.index');
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

        return redirect('/projectsales')->with('message', 'Deleted');
    }
}
