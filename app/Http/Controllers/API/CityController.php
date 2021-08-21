<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;
use App\State;
use App\City;
use App\Http\Resources\City as ResourcesCity;
use App\Http\Resources\CityCollection;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::all();
        return new CityCollection($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $states = State::all();

        return view('admin.city.create',compact(['cities','states']));
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
            'name' => 'required',
            'state_id' => 'required',
    ]);
    if ($validator->fails()) {
      return $validator->errors();
    }
        City::create($request->all());

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $state = State::find($id);

        return new ResourcesCity($city);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        City::where('id',$request->id)->update($request->all());

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = City::find($id);
        $item->delete();
        return response()->json([
            'success'=>true
        ]);
    }
}
