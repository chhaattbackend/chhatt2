<?php

namespace App\Http\Controllers;

use App\LeadType;
use Illuminate\Http\Request;

class LeadTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leadtypes = LeadType::paginate(25);
        return view('admin.lead_type.index', compact('leadtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lead_type.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LeadType::create($request->all());
        return redirect()->route('leadtypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadType  $leadType
     * @return \Illuminate\Http\Response
     */
    public function show(LeadType $leadType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadType  $leadType
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadType $leadType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadType  $leadType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadType $leadType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadType  $leadType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LeadType::find($id);
        $item->delete();
        return redirect()->back();
    }
}
