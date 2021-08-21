<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        if (!$request->keyword) {

            $projectshops = ProjectShop::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $projectshops = ProjectShop::where('id','!=',null)->orderBy('created_at','desc');

            $projectshops = $projectshops->whereHas('project', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhere('type', 'like', '%' . $seacrh . '%')
                ->orWhere('name', 'like', '%' . $seacrh . '%')
                ->paginate(25)->setPath('');

            $pagination = $projectshops->appends(array(
                'keyword' => $request->keyword
            ));
        }

        $projectshops=ProjectShop::orderBy('created_at','desc')->paginate(25);
        return view('admin.project_shop.index',compact(['projectshops']));
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
        ProjectShop::create($request->all());
        return redirect()->route('projectshops.index');
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
        return redirect()->route('projectshops.index');
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
