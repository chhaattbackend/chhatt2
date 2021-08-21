<?php

namespace App\Http\Controllers;

use App\Agent;
use App\AgentArea;
use App\AreaOne;
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
        if (!$request->keyword) {
            $agentareas = AgentArea::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $agentareas = AgentArea::where('id','!=',null)->orderBy('created_at','desc');

            $agentareas = $agentareas->whereHas('agent', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('areaOne', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->paginate(25)->setPath('');

            $pagination = $agentareas->appends(array(
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
        $agentareas = AgentArea::all();

        return view('admin.agent_speciality.create', compact(['agentareas', 'agents']));
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
        return view("admin.agent_speciality.edit", compact(['agentspeciality', 'agentspeciality']));
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
        AgentArea::where('id', $id)->update($request->all());

        return redirect()->route('agent_speciality.index');
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
        return redirect()->back();
    }
}
