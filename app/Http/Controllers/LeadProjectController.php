<?php

namespace App\Http\Controllers;

use App\AreaOne;
use App\AreaTwo;
use App\Callstatus;
use App\GlobalClass;
use App\Lead;
use App\LeadProject;
use App\Project;
use App\ResponseStatus;
use Illuminate\Http\Request;

class LeadProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $globalclass = new GlobalClass;
        if (!$request->keyword) {

            $leadProjects = LeadProject::orderBy('id', 'desc')->paginate(25);
            if (auth()->user()->role->name == 'Project Owner' || auth()->user()->role->name == 'Project Leader') {
                if (auth()->user()->project == null) {
                    $project_id = auth()->user()->projectUser->project_id;

                $leadProjects = LeadProject::where('project_id', $project_id)->orderBy('id', 'desc')->paginate(25);}
            } else if (auth()->user()->role->name == 'Project Lead Staff') {
                $leadProjects = LeadProject::where('project_id', auth()->user()->projectUser->project_id)->orderBy('id', 'desc');
                $leadProjects = $globalclass->searchRelation($leadProjects, 'lead', 'created_by', auth()->user()->id)->paginate(25);
            }
        } else {

            $seacrh = $request->keyword;
            $leadProjects = LeadProject::where('id', '!=', null)->orderBy('id', 'desc');

            $leadProjects = $leadProjects->whereHas('project', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('project', function ($query) use ($seacrh) {
                $query->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('project', function ($query) use ($seacrh) {
                $query->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('phone', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('lead', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('lead', function ($query) use ($seacrh) {
                $query->where('phone', 'like', '%' . $seacrh . '%');
            })->paginate(25)->setPath('');

            $pagination = $leadProjects->appends(array(
                'keyword' => $request->keyword
            ));
        }

        $response_status=ResponseStatus::all();
        $call_status=Callstatus::all();

        $area_one = AreaOne::orderBy('created_at', 'desc');
        $area_two = AreaTwo::orderBy('created_at', 'desc');

        return view('admin.lead_project.index', compact(['leadProjects', 'area_one', 'area_two','response_status','call_status']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leads = Lead::all();
        $projects = Project::all();
        return view('admin.lead_project.create', compact(['leads', 'projects']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LeadProject::create([
            'project_id' => $request->project_id,
            'lead_id' => $request->lead_id,

        ]);
        return redirect()->route('leadprojects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadProject  $leadProject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lead_id = $id;
        $projects = Project::all();

        return view('admin.lead_project.create', compact(['lead_id', 'projects']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadProject  $leadProject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lead_id = $id;
        $projects = Project::all();

        return view('admin.lead_project.edit', compact(['lead_id', 'projects']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadProject  $leadProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $leadProject = LeadProject::find($id);
        $leadProject->update($request->all());
        return redirect()->route('leadprojects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadProject  $leadProject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leadProject = LeadProject::find($id);
        $leadProject->delete();
        return redirect()->back();
    }

    public function filter(Request $request)
    {

        $seacrh = $request;



        $leadProjects = LeadProject::orderBy('created_at', 'desc');
        if (isset($request->start_date)) {
            $leadProjects = $leadProjects->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        if (isset($request->call_status)) {
            $seacrh = $request->call_status;
            $leadProjects = $leadProjects->whereHas('lead', function ($query) use ($seacrh) {
                $query->where('call_status', 'like', '%' . $seacrh . '%');
            });
        }
        if (isset($request->response_status)) {

            $seacrh = $request->response_status;
            $leadProjects = $leadProjects->whereHas('lead', function ($query) use ($seacrh) {
                $query->where('response_status',$seacrh);

            });

        }
        if(isset($request->project_id)){
            $leadProjects = $leadProjects->where('project_id',$request->project_id);

        }


        $leadProjects = $leadProjects->paginate(25);

        $pagination = $leadProjects->appends(array(
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'call_status' => $request->call_status,
            'response_status' => $request->response_status,
            'project_id' => $request->project_id

        ));

        return view('admin.lead_project.index', compact('leadProjects'));
    }
}
