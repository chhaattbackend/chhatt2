<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\AgentSpeciality;
use App\Agent;
use App\Http\Resources\AgentSpeciality as ResourcesAgentSpeciality;
use App\Http\Resources\AgentSpecialityCollection;
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
        $agentspecialities = AgentSpeciality::orderBy('created_at','desc')->paginate(25);
        return new AgentSpecialityCollection($agentspecialities);
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

        return view('admin.agent_speciality.create',compact(['agentspecialities','agents']));
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
            'agent_id' => 'required',
            'speciality_id' => 'required',
    ]);
    if ($validator->fails()) {
      return $validator->errors();
    }
        AgentSpeciality::create($request->all());

        return response()->json([
            'success'=>true
        ]);

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
       return new ResourcesAgentSpeciality($agentspeciality);
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
        AgentSpeciality::where('id',$request->id)->update($request->all());

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
        $item = AgentSpeciality::find($id);
        $item->delete();
        return response()->json([
            'success'=>true
        ]);
    }
}
