<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Http\Resources\StateCollection;
use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = State::orderBy('created_at','desc')->paginate(25);
        return new StateCollection($states);


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('admin.state.create',compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);
        State::create($request->all());

        return response()->json([
            'success'=>true
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\state  $state
     * @return \Illuminate\Http\Response
     */
    public function show(state $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\state  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::find($id);
        return view("admin.state.edit",compact('state'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\state  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $state = State::find($id);
        $state->update($request->all());

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\state  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = State::find($id);
        $item->delete();
        return redirect()->back();
    }
}
