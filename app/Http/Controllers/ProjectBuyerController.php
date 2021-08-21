<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        if (!$request->keyword) {

            $projectbuyers = ProjectBuyer::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $projectbuyers = ProjectBuyer::where('id','!=',null)->orderBy('created_at','desc');

            $projectbuyers = $projectbuyers->whereHas('project', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhere('name', 'like', '%' . $seacrh . '%')
                ->orWhere('contact', 'like', '%' . $seacrh . '%')
                ->orWhere('cnic', 'like', '%' . $seacrh . '%')
                ->paginate(25)->setPath('');

            $pagination = $projectbuyers->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.project_buyer.index', compact(['projectbuyers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('admin.project_buyer.create', compact(['projects']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProjectBuyer::create($request->all());
        return redirect()->route('projectbuyers.index');
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
        $projectbuyer = ProjectBuyer::find($id);
        $projects = Project::all();
        return view('admin.project_buyer.edit', compact(['projectbuyer', 'projects']));
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
        $projectbuyer = ProjectBuyer::find($id);
        $projectbuyer->update($request->all());
        return redirect()->route('projectbuyers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = ProjectBuyer::find($id);
        $item->delete();
        return redirect()->back();
    }
}
