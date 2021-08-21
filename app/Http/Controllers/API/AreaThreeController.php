<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\AreaOne;
use App\AreaTwo;
use App\AreaThree;
use App\Http\Resources\AreaThree as ResourcesAreaThree;
use App\Http\Resources\AreaThreeCollection;
use App\Http\Resources\AreaTwoCollection;
use Illuminate\Http\Request;

class AreaThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areathrees = AreaThree::all();
        return new AreaThreeCollection($areathrees);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areaones = AreaOne::all();
        $areatwos = AreaTwo::all();
        return view('admin.area_three.create',compact('areatwos','areaones'));
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
            'area_two_id' => 'required',
            'area_one_id' => 'required',
    ]);
    if ($validator->fails()) {
      return $validator->errors();
    }
        AreaThree::create($request->all());

        return response()->json([
            'success'=>true
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\areathree  $areathree
     * @return \Illuminate\Http\Response
     */
    public function show(Areathree $areathree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\areathree  $areathree
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areathree = AreaThree::find($id);

        return new ResourcesAreaThree($areathree);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\areathree  $areathree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $areathree = AreaThree::find($request->id);
        $areathree->update($request->all());

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\areathree  $areathree
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AreaThree::find($id);
        $item->delete();
        return response()->json([
            'success'=>true
        ]);
    }
}
