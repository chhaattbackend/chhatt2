<?php

namespace App\Http\Controllers;

use App\Agent;
use App\AgentArea;
use App\Http\Resources\AgentArea as ResourcesAgentArea;
use App\Speciality;
use Illuminate\Http\Request;

class AgentAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->keyword){
            $agentareas=AgentArea::orderBy('created_at','desc')->paginate(25);
            }
            else{
                $agentareas=AgentArea::where('name','like','%'.$request->keyword.'%')
                ->paginate(25)->setPath ( '' );
                $pagination = $agentareas->appends ( array (
                    'keyword' => $request->keyword
            ));
            }
            return view('admin.agent_area.index', compact('agentareas'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();
        $agentareas = Speciality::all();

        return view('admin.agent_speciality.create',compact(['agentareas','agents']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        AgentArea::create($request->all());

        return redirect()->route('agent_speciality.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Agent::find($id);
        $agentspeciality = AgentArea::find($id);
        return new ResourcesAgentArea($agent);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        AgentArea::where('id',$request->id)->update($request->all());

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AgentArea::find($id);
        $item->delete();
        return response()->json([
            'success'=>true
        ]);
    }

}
