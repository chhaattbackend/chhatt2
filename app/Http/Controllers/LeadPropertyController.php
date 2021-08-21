<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        if (!$request->keyword) {

            $leadProperties = LeadProperty::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $leadProperties = LeadProperty::where('id','!=',null)->orderBy('created_at','desc');

            $leadProperties = $leadProperties->whereHas('property', function ($query) use ($seacrh) {
                $query->where('category', 'like', '%' . $seacrh . '%');
            })->orWhereHas('property', function ($query) use ($seacrh) {
                $query->whereHas('areaOne', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('property', function ($query) use ($seacrh) {
                $query->whereHas('areaTwo', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('property', function ($query) use ($seacrh) {
                $query->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('phone', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('property', function ($query) use ($seacrh) {
                $query->where('size', 'like', '%' . $seacrh . '%');
            })->orWhereHas('lead', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('lead', function ($query) use ($seacrh) {
                $query->where('phone', 'like', '%' . $seacrh . '%');
            })->paginate(25)->setPath('');

            $pagination = $leadProperties->appends(array(
                'keyword' => $request->keyword
            ));
        }


        return view('admin.lead_property.index', compact(['leadProperties',]));
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
        LeadProperty::create([
            'property_id'=>$request->property_id,
            'lead_id'=>$request->lead_id,
        ]);
        return redirect()->route('leadproperties.index');
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
        $lead_id = $id;
        $properties= Property::all();

        return view('admin.lead_property.edit', compact(['lead_id','properties']));
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
        $leadProperty = LeadProperty::find($id);
        $leadProperty->update($request->all());
        return redirect()->route('leadproperties.index');
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
