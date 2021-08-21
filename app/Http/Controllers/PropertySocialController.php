<?php

namespace App\Http\Controllers;

use App\PropertySocial;
use Illuminate\Http\Request;

class PropertySocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertysocials=PropertySocial::orderBy('created_at','desc')->paginate(25);
        return view('admin.property_social.index',compact('propertysocials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertySocial  $propertySocial
     * @return \Illuminate\Http\Response
     */
    public function show(PropertySocial $propertySocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertySocial  $propertySocial
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertySocial $propertySocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertySocial  $propertySocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertySocial $propertySocial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertySocial  $propertySocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertySocial $propertySocial)
    {
        //
    }
}
