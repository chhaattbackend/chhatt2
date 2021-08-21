<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Agent;
use App\Agency;
use App\Http\Resources\Agent as ResourcesAgent;
use App\Http\Resources\AgentCollection;
use App\Position;
use App\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->keyword) {
            $agents = Agent::orderBy('created_at', 'desc')->paginate(25);
            if(isset($request->speciality)){
            $agents = Agent::where('id', '!=', null)->orderBy('created_at', 'desc');
            $search=$request->speciality;
            $agents = $agents->whereHas('specialities', function ($query) use ($search) {
                $query->whereHas('speciality', function ($query1) use ($search) {
                    $query1->where('name', $search);
                });
            })->paginate(25)->setPath('');

            $pagination = $agents->appends(array(
                'speciality' => $request->speciality
            ));
            }
        } else {
            // dd($request->keyword);
            $seacrh = $request->keyword;
            $agents = Agent::where('id', '!=', null)->orderBy('created_at', 'desc');

            $agents = $agents->whereHas('user', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('agency', function ($query) use ($seacrh) {
                $query->whereHas('areaOne', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('agency', function ($query) use ($seacrh) {
                $query->whereHas('areaTwo', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            })->orWhereHas('agency', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('user', function ($query) use ($seacrh) {
                $query->where('phone', 'like', '%' . $seacrh . '%');
            })->paginate(25)->setPath('');


            $pagination = $agents->appends(array(
                'keyword' => $request->keyword
            ));
        }

        return new AgentCollection($agents);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();
        $positions = Position::all();
        $agencies = Agency::all();
        $users = User::all();

        return response()->json([
            'agency' => $agencies,
            'users' => $users,
            'positions' => $positions,

        ]);
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
            'agency_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        Agent::create($request->all());

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
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

        return new ResourcesAgent($agent);
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
        $agents = Agent::find($request->id)->update($request->all());

        return response()->json([
            'success' => true
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
        $item = Agent::find($id);
        $item->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
