<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Agent;
use App\Http\Resources\LeadAssign as ResourcesLeadAssign;
use App\Http\Resources\LeadAssignCollection;
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
        $leadassigns = LeadAssign::orderBy('created_at','desc');
        if(isset($request->agent_id)){
            $leadassigns->where('agent_id',$request->agent_id);
        }
        if(isset($request->firebase_id)){
            $user=User::where('firebase_id',$request->firebase_id)->first();
            $leadassigns->where('agent_id',$user->agent->id);
        }
        if(isset($request->user_id)){
            $user=User::where('id',$request->user_id)->first();
            $leadassigns->where('agent_id',$user->agent->id);
        }
        $leadassigns=$leadassigns->paginate(25);
        return new LeadAssignCollection($leadassigns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leads=Lead::all();
        return response()->json([
            'leads'=>$leads
        ]);
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
            'agent_id' => 'required',
            'lead_id' => 'required',
            'client_feedback' => 'required',
            'realtor_feedback' => 'required',

    ]);
    if ($validator->fails()) {
      return $validator->errors();
    }

        LeadAssign::create([
            'agent_id'=>$request->agent_id,
            'lead_id'=>$request->lead_id,

        ]);
        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadAssign  $leadAssign
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lead_id=$id;
        $agents=Agent::all();

        return view('admin.lead_assign.create',compact('lead_id','agents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadAssign  $leadAssign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $leadAssign=LeadAssign::find($id);
        $agents=Agent::all();

        return new ResourcesLeadAssign($leadAssign);
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
        $leadAssign=LeadAssign::where('lead_id',$request->lead_id)->where('agent_id',$request->agent_id)->update($request->all());

        $leadAssign=LeadAssign::where('lead_id',$request->lead_id)->first();
        return new ResourcesLeadAssign($leadAssign);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadAssign  $leadAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leadAssign=LeadAssign::find($id);
        $leadAssign->delete();
        return response()->json([
            'success'=>true
        ]);
    }
    public function users($id){

    }
    public function properties($id){

    }
    public function projects($id){

    }
}
