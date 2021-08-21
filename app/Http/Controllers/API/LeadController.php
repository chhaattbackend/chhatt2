<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\GlobalClass;
use App\Http\Resources\Lead as ResourcesLead;
use App\Http\Resources\LeadCollection;
use App\Lead;
use App\LeadAssign;
use App\LeadProperty;
use App\User;
use App\Mail\mail as MailMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Lead::orderBy('created_at','desc')->paginate(25);
        return new LeadCollection($leads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Lead::all();
        return view('admin.lead.create', compact('data'));
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $lead=Lead::create($request->all());
        if($request->from=='web'){

            LeadProperty::create([
                'property_id'=>$request->property_id,
                'lead_id'=>$lead->id,
                'message'=>$request->message
            ]);


        $data = array(
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            // "description" => $request->description,
            // "budget" => $request->budget,
            // "lead_type" => $request->lead_type,
            // "how_soon" => $request->how_soon,
            // "family_members" => $request->family_members,
            // "leadsource" => $request->leadsource,
            // "call_status" => $request->call_status,
            // "response_status" => $request->response_status,
            // "property_type" => $request->nproperty_typeame,
            // "added_by" => auth()->user()->name,

        );
        $user=User::where('id',$request->user_id)->first();
        $globalclass=new GlobalClass;
        $globalclass->sendLeadSms($lead->name,$lead->email,$lead->phone,$request->message,optional($lead->areaOne)->name,$lead->budget,$lead->lead_type,$lead->family_members,$lead->property_type,$user->phone,$request->link,'web');
    }

        // Mail::to('muddasirali99@gmail.com')->send(new MailMail($data));
        return response()->json([
            'success' => true,
            'data'=>$request->all(),


        ]);
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
    public function edit($id)
    {
        $lead = Lead::find($id);
        return new ResourcesLead($lead);
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
        $lead=Lead::find($request->id);
        $lead->update($request->all());
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function filter(Request $request)
    {


        $leads = Lead::orderBy('created_at','desc')->paginate(25);
        $k1 = null;
        $k2 = null;
        $k3 = null;

        $leads = Lead::orderBy('created_at', 'desc');
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

        $allcount = $leads->count();
        $leads = $leads->paginate(25);
        $pagination = $leads->appends(array(
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'leadsource' => $request->leadsource,
            'response_status' => $request->response_status,
        ));

        return view('admin.lead.index', compact('leads', 'leads', 'k1', 'k2', 'k3', 'allcount'));
    }
}
