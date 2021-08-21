<?php

namespace App\Http\Controllers;

use App\AgentSpeciality;
use App\Agent;
use App\Speciality;
use Illuminate\Http\Request;

class AgentSpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->keyword) {
            $agentspecialities = AgentSpeciality::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $agentspecialities = AgentSpeciality::where('id','!=',null)->orderBy('created_at','desc');

            $agentspecialities = $agentspecialities->whereHas('agent', function ($query) use ($seacrh) {
                $query->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('speciality', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->paginate(25)->setPath('');

            $pagination = $agentspecialities->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.agent_speciality.index', compact('agentspecialities'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();
        $agentspecialities = Speciality::all();

        return view('admin.agent_speciality.create', compact(['agentspecialities', 'agents']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AgentSpeciality::create($request->all());

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
        $agentspeciality = AgentSpeciality::find($id);
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
        AgentSpeciality::where('id', $id)->update($request->all());

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
        $item = AgentSpeciality::find($id);
        $item->delete();
        return redirect()->back();
    }
}
