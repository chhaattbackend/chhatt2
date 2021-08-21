<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\AreaOne;
use App\AreaTwo;
use App\Http\Resources\AreaTwo as ResourcesAreaTwo;
use App\Http\Resources\AreaTwoCollection;
use Illuminate\Http\Request;

class AreaTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areatwos = AreaTwo::with(['area_one'])->get();
        return new AreaTwoCollection($areatwos);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areaones = AreaOne::all();
        return view('admin.area_two.create',compact('areaones'));
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
            'area_one_id' => 'required',
    ]);
    if ($validator->fails()) {
      return $validator->errors();
    }
        AreaTwo::create($request->all());

        return response()->json([
            'success'=>true
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\areatwo  $areatwo
     * @return \Illuminate\Http\Response
     */
    public function show(Areatwo $areatwo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\areatwo  $areatwo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areatwo = AreaTwo::find($id);

       return new ResourcesAreaTwo($areatwo);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\areatwo  $areatwo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $areatwo = AreaTwo::find($request->id);
        $areatwo->update($request->all());

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\areatwo  $areatwo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AreaTwo::find($id);
        $item->delete();
        return response()->json([
            'success'=>true
        ]);
    }
}
