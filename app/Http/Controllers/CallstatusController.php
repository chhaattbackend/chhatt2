<?php

namespace App\Http\Controllers;

use App\Callstatus;
use Illuminate\Http\Request;

class CallstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callstatus=Callstatus::paginate(25);
        return view('admin.call_status.index',compact('callstatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.call_status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Callstatus::create($request->all());
        return redirect()->route('callstatus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Callstatus  $callstatus
     * @return \Illuminate\Http\Response
     */
    public function show(Callstatus $callstatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Callstatus  $callstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(Callstatus $callstatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Callstatus  $callstatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Callstatus $callstatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Callstatus  $callstatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Callstatus::find($id);
        $item->delete();
        return redirect()->back();
    }
}
