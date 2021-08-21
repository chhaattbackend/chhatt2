<?php

namespace App\Http\Controllers;

use App\AreaThree;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->keyword) {

            $projects = Project::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;

            $projects = Project::where('id','!=',null)->orderBy('created_at','desc');

            $projects = $projects->whereHas('area_three', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('user', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('user', function ($query) use ($seacrh) {
                    $query->where('phone', 'like', '%' . $seacrh . '%');
            })->    orWhere('name', 'like', '%' . $seacrh . '%')
            ->orWhere('address', 'like', '%' . $seacrh . '%')
            ->paginate(25)->setPath('');

            $pagination = $projects->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        $projects = Project::all();
        $users = User::all();
        $area_three = AreaThree::all();


        return view('admin.project.create', compact('projects', 'users', 'area_three'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filename = null;
        //$data=>array();
        $message=str_ireplace('<br />','%0A',nl2br($request->message));
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $exe = $image->getClientOriginalName();
            $filename = time() . '-' . $exe;
            $image->move(public_path('images/projects/'), $filename);
        }
        $data = Project::create($request->except('image','message') + ['image' => $filename,'message'=>$message]);
        return redirect()->route('projects.index');

        // return redirect('admin/projects')->with('u_message', 'successfuly updated!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // $projects = Project::all();
        $users = User::all();
        $area_three = AreaThree::all();


        return view('admin.project.edit', compact('project', 'users', 'area_three'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // $filename=null;

        //$data=>array();
        $message=str_ireplace('<br />','%0A',nl2br($request->message));
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $exe = $image->getClientOriginalName();
            $filename = time() . '-' . $exe;
            $image->move(public_path('images/projects/'), $filename);
            $project->update($request->except('image','message') + ['image' => $filename,'message'=>$message]);
        } else {
            $project->update($request->except('image','message')+['message'=>$message]);
        }
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::where('id', $id)->delete();
        return redirect()->back();
    }

    public function delete($id)
    {
        Project::where('id', $id)->delete();
        return redirect()->back();
    }
}
