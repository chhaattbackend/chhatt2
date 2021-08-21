<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Lead;
use App\LeadAssign;
use App\User;
use Illuminate\Http\Request;

class LeadAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->keyword) {
            $count = LeadAssign::all()->count();
            $leadAssigns = LeadAssign::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $leadAssigns = LeadAssign::where('id','!=',null)->orderBy('created_at','desc');

            $leadAssigns = $leadAssigns->whereHas('agent', function ($query) use ($seacrh) {
                $query->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('agent', function ($query) use ($seacrh) {
                $query->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('phone', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('agent', function ($query) use ($seacrh) {
                $query->whereHas('agency', function ($query) use ($seacrh) {
                    $query->where('major_area', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('lead', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('lead', function ($query) use ($seacrh) {
                $query->where('phone', 'like', '%' . $seacrh . '%');
            })->paginate(25)->setPath('');
            $count = LeadAssign::all()->count();
            $pagination = $leadAssigns->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.lead_assign.index', compact('leadAssigns', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leads = Lead::all();
        return view('admin.lead_assign.create', compact(['leads']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LeadAssign::create([
            'agent_id' => $request->agent_id,
            'lead_id' => $request->lead_id,

        ]);
        return redirect()->route('leadassigns.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadAssign  $leadAssign
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lead_id = $id;
        $agents = Agent::all();

        return view('admin.lead_assign.create', compact('lead_id', 'agents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadAssign  $leadAssign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $leadAssign = LeadAssign::find($id);
        $agents = Agent::all();

        return view('admin.lead_assign.edit', compact('leadAssign', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadAssign  $leadAssign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $leadAssign = LeadAssign::find($id);
        $leadAssign->update($request->all());

        return redirect()->route('leadassigns.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadAssign  $leadAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leadAssign = LeadAssign::find($id);
        $leadAssign->delete();
        return redirect()->back();
    }
    public function users($id)
    {
    }
    public function properties($id)
    {
    }
    public function projects($id)
    {
    }
}
