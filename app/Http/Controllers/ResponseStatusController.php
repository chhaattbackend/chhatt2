<?php

namespace App\Http\Controllers;

use App\ResponseStatus;
use Illuminate\Http\Request;

class ResponseStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsestatus = ResponseStatus::paginate(25);
        return view('admin.response_status.index', compact('responsestatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.response_status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ResponseStatus::create($request->all());
        return redirect()->route('responsestatus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResponseStatus  $responseStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ResponseStatus $responseStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResponseStatus  $responseStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ResponseStatus $responseStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResponseStatus  $responseStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResponseStatus $responseStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResponseStatus  $responseStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResponseStatus $responseStatus,$id)
    {
        $item = ResponseStatus::find($id);
        $item->delete();
        return redirect()->back();
    }
}
