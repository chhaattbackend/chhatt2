<?php

namespace App\Http\Controllers;

use App\Agent;
use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\Callstatus;
use App\GlobalClass;
use App\Lead;
use App\LeadProject;
use App\LeadSource;
use App\LeadType;
use App\Mail\mail as MailMail;
use App\Project;
use App\ProjectUser;
use App\PropertyType;
use App\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $globalclass = new GlobalClass;
        $callstatus = Callstatus::all();
        $responsestatus = ResponseStatus::all();


        if (!$request->keyword) {
            $leads = Lead::orderBy('id', 'desc')->where('status',0);

            if (auth()->user()->role->name == 'Project Owner' || auth()->user()->role->name == 'Project Leader' || auth()->user()->role->name == 'Agent') {
                if (auth()->user()->project == null) {
                    $project_id = auth()->user()->projectUser->project_id;


                $user_ids = ProjectUser::where('project_id', $project_id)->select('user_id')->get()->toArray();
                $leads = $globalclass->searchRelationIn($leads, 'created_by1', 'id', $user_ids);}
            } else if (auth()->user()->role->name == 'Project Lead Staff') {
                $leads->where('created_by', auth()->user()->id);
            }


            $leads = $leads->paginate(25);
        } else {

            $search = $request->keyword;
            $leads = Lead::where('id', '!=', null)->orderBy('created_at', 'desc')->where('status',0);

            $leads = $leads->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('leadsource', 'like', '%' . $search . '%')
                ->orWhere('property_type', 'like', '%' . $search . '%');
            $leads->orWhereHas('created_by1', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });

            $leads = $leads->paginate(25)->setPath('');

            $pagination = $leads->appends(array(
                'keyword' => $request->keyword
            ));
        }
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        $image='https://chhatt.com/static/media/realtorhigh.50c95b4c.webp';
        return view('admin.lead.index', compact(['leads', 'callstatus', 'responsestatus', 'area_one', 'area_two','image']));
    }


    public function completedleads(Request $request)
    {
        $globalclass = new GlobalClass;
        $callstatus = Callstatus::all();
        $responsestatus = ResponseStatus::all();


        if (!$request->keyword) {
            $leads = Lead::orderBy('id', 'desc')->where('status',1);

            if (auth()->user()->role->name == 'Project Owner' || auth()->user()->role->name == 'Project Leader' || auth()->user()->role->name == 'Agent') {
                if (auth()->user()->project == null) {
                    $project_id = auth()->user()->projectUser->project_id;


                $user_ids = ProjectUser::where('project_id', $project_id)->select('user_id')->get()->toArray();
                $leads = $globalclass->searchRelationIn($leads, 'created_by1', 'id', $user_ids);}
            } else if (auth()->user()->role->name == 'Project Lead Staff') {
                $leads->where('created_by', auth()->user()->id);
            }


            $leads = $leads->paginate(25);
        } else {

            $search = $request->keyword;
            $leads = Lead::where('id', '!=', null)->orderBy('created_at', 'desc')->where('status',1);

            $leads = $leads->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('leadsource', 'like', '%' . $search . '%')
                ->orWhere('property_type', 'like', '%' . $search . '%');
            $leads->orWhereHas('created_by1', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });

            $leads = $leads->paginate(25)->setPath('');

            $pagination = $leads->appends(array(
                'keyword' => $request->keyword
            ));
        }
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        return view('admin.lead.index', compact(['leads', 'callstatus', 'responsestatus', 'area_one', 'area_two']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leads = Lead::all();
        $leadtype = LeadType::all();
        $leadsource = LeadSource::all();
        $callstatus = Callstatus::all();
        $responsestatus = ResponseStatus::all();
        $propertytype = PropertyType::all();
        $projects = Project::all();
        $areaones = AreaOne::all();
        $areatwos = AreaTwo::all();
        $agents = Agent::all();
        return view('admin.lead.create', compact('agents', 'areatwos', 'areaones', 'leads', 'leadtype', 'leadsource', 'callstatus', 'responsestatus', 'propertytype', 'projects'));
    }
    public function createproject()
    {
        $leads = Lead::all();
        $leadtype = LeadType::all();
        $leadsource = LeadSource::all();
        $callstatus = Callstatus::all();
        $responsestatus = ResponseStatus::all();
        $propertytype = PropertyType::all();
        $projects = Project::all();
        return view('admin.lead.createproject', compact('leads', 'leadtype', 'leadsource', 'callstatus', 'responsestatus', 'propertytype', 'projects'));
    }
    public function storeproject(Request $request)
    {
        $lead = Lead::create($request->except('project_id') + ['created_by' => auth()->user()->id]);

        $lead_id = $lead->id;

        LeadProject::create([
            'lead_id' => $lead_id,
            'project_id' => $request->project_id,
        ]);


        return redirect()->route('leadprojects.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Lead::create($request->all() + ['created_by' => auth()->user()->id]);
        return redirect()->route('leads.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        // AreaOne::where('id','!=',null)->update(['city_id'=>1]);
        $areaones = AreaOne::all();
        $areatwos = AreaTwo::all();
        $areathrees = AreaThree::all();
        return view('admin.lead.show', compact('areaones', 'areatwos', 'areathrees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        $leadtype = LeadType::all();
        $leadsource = LeadSource::all();
        $callstatus = Callstatus::all();
        $responsestatus = ResponseStatus::all();
        $propertytype = PropertyType::all();
        $areaones = AreaOne::all();
        $areatwos = AreaTwo::all();
        return view('admin.lead.edit', compact('lead', 'leadtype', 'leadsource', 'callstatus', 'responsestatus', 'propertytype', 'areaones', 'areatwos'));
        // return view("admin.lead.edit", compact(['lead']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        $lead->update($request->all());

        return redirect()->away($request->previous_url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        // if(auth()->user()->role->name='Administrator'){
        $lead->delete();
        // }
        return redirect()->back();
    }

    public function filter(Request $request)
    {

        $callstatus = Callstatus::all();
        $leads = Lead::orderBy('created_at', 'desc')->paginate(25);
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        $k1 = null;
        $k2 = null;
        $k3 = null;

        $leads = Lead::orderBy('created_at', 'desc');
        $area_one = AreaOne::orderBy('created_at', 'desc');
        $area_two = AreaTwo::orderBy('created_at', 'desc');
        if (isset($request->start_date)) {
            $leads = $leads->whereBetween('leads.created_at', [$request->start_date, $request->end_date]);
            $k1 = 1;
        }
        if (isset($request->leadsource)) {
            $leads = $leads->where('leads.leadsource', $request->leadsource);
            $k2 = 1;
        }
        if (isset($request->response_status)) {
            $leads = $leads->where('leads.response_status', $request->response_status);
            $k3 = 1;
        }
        if (isset($request->area_one_id)) {
            $leads = $leads->where('leads.area_one_id', $request->area_one_id);
        }
        if (isset($request->area_two_id)) {
            $leads = $leads->where('leads.area_two_id', $request->area_two_id);
        }

        $allcount = $leads->count();
        $leads = $leads->paginate(25);
        $area_one = $area_one->paginate(25);
        $area_two = $area_two->paginate(25);

        $pagination = $leads->appends(array(
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'leadsource' => $request->leadsource,
            'response_status' => $request->response_status,
            'area_one_id' => $request->area_one_id,
            'area_two_id' => $request->area_two_id
        ));
        $responsestatus = ResponseStatus::all();

        return view('admin.lead.index', compact('leads', 'leads', 'k1', 'k2', 'k3', 'allcount', 'area_one', 'area_two', 'callstatus', 'responsestatus'));
    }


    public function ajaxSearch(Request $request)
    {

        $callstatus = Callstatus::all();
        $responsestatus = ResponseStatus::all();
        $globalclass = new GlobalClass;

        // dd('search');
        // dd($request->all());
        // dd($request->all());

        if (isset($request->sort_by) && isset($request->sort_from)) {
            // dd('sort_by');
            // dd($request->all());
            $search = $request->keyword;
            $leads = Lead::where('id', '!=', null)->orderBy($request->sort_from, $request->sort_by)->where('status',0);

            if ($search != null) {
                $leads = $leads->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('leadsource', 'like', '%' . $search . '%')
                    ->orWhere('property_type', 'like', '%' . $search . '%');
                $leads->orWhereHas('created_by1', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });

                $leads = $leads->paginate(25)->setPath('');

                $pagination = $leads->appends(array(
                    'keyword' => $request->keyword,
                    'sort_from' => $request->sort_from,
                    'sort_by' => $request->sort_by

                ));
            } else {
                $leads = Lead::orderBy($request->sort_from, $request->sort_by)->where('status',0);
                if (auth()->user()->role->name == 'Project Owner' || auth()->user()->role->name == 'Project Leader') {
                    if (auth()->user()->project == null) {
                        $project_id = auth()->user()->projectUser->project_id;
                    }
                    $user_ids = ProjectUser::where('project_id', $project_id)->select('user_id')->get()->toArray();
                    $leads = $globalclass->searchRelationIn($leads, 'created_by1', 'id', $user_ids);
                } else if (auth()->user()->role->name == 'Project Lead Staff') {
                    $leads->where('created_by', auth()->user()->id);
                }
                $leads = $leads->paginate(25);
            }
        } else {
            if ($request->keyword == null || $request->keyword == ' ') {
                $leads = Lead::orderBy('created_at', 'desc')->where('status',0);
                if (auth()->user()->role->name == 'Project Owner' || auth()->user()->role->name == 'Project Leader') {
                    if (auth()->user()->project == null) {
                        $project_id = auth()->user()->projectUser->project_id;
                    }

                    $user_ids = ProjectUser::where('project_id', $project_id)->select('user_id')->get()->toArray();
                    $leads = $globalclass->searchRelationIn($leads, 'created_by1', 'id', $user_ids);
                } else if (auth()->user()->role->name == 'Project Lead Staff') {
                    $leads->where('created_by', auth()->user()->id);
                }


                $leads = $leads->paginate(25);
            } else {

                $search = $request->keyword;
                $leads = Lead::where('id', '!=', null)->orderBy('created_at', 'desc')->where('status',0);

                $leads = $leads->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('leadsource', 'like', '%' . $search . '%')
                    ->orWhere('property_type', 'like', '%' . $search . '%');
                $leads->orWhereHas('created_by1', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });

                $leads = $leads->paginate(25)->setPath('');

                $pagination = $leads->appends(array(
                    'keyword' => $request->keyword,
                    'sort_from' => $request->sort_from,
                    'sort_by' => $request->sort_by
                ));
            }
        }

        if (isset($request->dltid)) {
            // dd($request->dltid);
            foreach ($request->dltid as $id) {
                $item = Lead::find($id);
                $item->delete();
            }
            $leads = Lead::orderBy('created_at', 'desc')->where('status',0);
            if (auth()->user()->role->name == 'Project Owner' || auth()->user()->role->name == 'Project Leader') {
                if (auth()->user()->project == null) {
                    $project_id = auth()->user()->projectUser->project_id;
                }

                $user_ids = ProjectUser::where('project_id', $project_id)->select('user_id')->get()->toArray();
                $leads = $globalclass->searchRelationIn($leads, 'created_by1', 'id', $user_ids);
            } else if (auth()->user()->role->name == 'Project Lead Staff') {
                $leads->where('created_by', auth()->user()->id);
            }


            $leads = $leads->paginate(25);
        }



        $data = view('admin.lead.ajaxtable', compact(['leads', 'callstatus', 'responsestatus']))->render();

        // dd($callstatus);
        return response()->json([
            'data' => $data,
            'total' => (string) $leads->total(),
            'pagination' => (string) $leads->links()
        ]);
    }


    public function ajax(Request $request)
    {
        // dd($request->all());
        if (isset($request->visit_id)) {
            // dd($request->visit_id);
            $lead = Lead::find($request->visit_id);
            $lead->update([
                'visit_date' => $request->visit_date
            ]);
            return response()->json([
                'date' => $request->visit_date
            ]);
        }
        if (isset($request->status_id)) {
            $lead = Lead::find($request->status_id);
            $lead->update([
                'status' => $request->status_val
            ]);
        }
        if (isset($request->callstatus_id)) {
            $lead = Lead::find($request->callstatus_id);
            $lead->update([
                'call_status' => $request->callstatus_val
            ]);
        }
        if (isset($request->responsestatus_id)) {
            $lead = Lead::find($request->responsestatus_id);
            $lead->update([
                'response_status' => $request->responsestatus_val
            ]);
        }
        if (isset($request->desc_id)) {
            $lead = Lead::find($request->desc_id);
            $lead->update([
                'description' => $request->desc_val . '
Updated By: ' . auth()->user()->name . '
Updated At: ' . date("h:m A d-M-y"),
            ]);

            return response()->json([
                'desc' => $request->desc_val . '
Updated By: ' . auth()->user()->name . '
Updated At: ' . date("h:m A d-M-y")
            ]);
        }


        return 1;
    }
}
