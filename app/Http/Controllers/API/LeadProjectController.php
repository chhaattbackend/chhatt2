<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeadProject as ResourcesLeadProject;
use App\Http\Resources\LeadProjectCollection;;

use App\Lead;
use App\LeadProject;
use App\Project;
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


        if (!$request->keyword) {
            $leadProjects = LeadProject::with(['project'])->paginate(25);
        } else {

            $search = $request->keyword;
            $leadProjects = LeadProject::where('id', '!=', null)->orderBy('created_at', 'desc');

            $leadProjects = $leadProjects->whereHas('project', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('project', function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })->orWhereHas('project', function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('phone', 'like', '%' . $search . '%');
                });
            })->orWhereHas('lead', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('lead', function ($query) use ($search) {
                $query->where('phone', 'like', '%' . $search . '%');
            })->paginate(25)->setPath('');


           
            $pagination = $leadProjects->appends(array(
                'keyword' => $request->keyword
            ));
            return new LeadProjectCollection($leadProjects);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leads = Lead::all();
        return view('admin.lead_project.create', compact(['leads']));
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
            'lead_id' => 'required',
            'project_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        LeadProject::create([
            'project_id' => $request->project_id,
            'lead_id' => $request->lead_id,

        ]);
        return response()->json([
            'success' => true
        ]);
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
        $leadproject = LeadProject::find($id);
        return new ResourcesLeadProject($leadproject);
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
        $leadProject = LeadProject::find($request->id);
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
}
