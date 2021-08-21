<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeadProperty as ResourcesLeadProperty;

;

use App\Http\Resources\LeadPropertyCollection;
use App\Lead;
use App\LeadProject;
use App\LeadProperty;
use App\Property;
use App\User;
use Illuminate\Http\Request;

class LeadPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leadProperties = LeadProperty::orderBy('created_at','desc')->paginate(25);
        return new LeadPropertyCollection($leadProperties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leads = Lead::all();
        $properties=Property::all();
        $users = User::all();

        return view('admin.lead_property.create', compact('leads','properties','users'));
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
            'property_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        LeadProperty::create([
            'property_id'=>$request->property_id,
            'lead_id'=>$request->lead_id,
        ]);
        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadProperty  $leadProperty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lead_id = $id;
        $properties= Property::all();

        return view('admin.lead_property.create', compact(['lead_id','properties']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadProperty  $leadProperty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leadProperty = LeadProperty::find($id);
        return new ResourcesLeadProperty($leadProperty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadProperty  $leadProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $leadProperty = LeadProperty::find($request->id);
        $leadProperty->update($request->all());
        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadProperty  $leadProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leadProperty=LeadProperty::find($id);
        $leadProperty->delete();
        return redirect()->back();
    }
}
