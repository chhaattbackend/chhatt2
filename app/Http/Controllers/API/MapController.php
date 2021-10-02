<?php

namespace App\Http\Controllers\API;

use App\AreaOne;
use App\Http\Controllers\Controller;
use App\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function maps(Request $request)
    {



        $all_data = Map::all();
        $link='https://chhatt.s3.ap-south-1.amazonaws.com/maps/';
        $compiled_data =array();
        foreach ($all_data as $data) {


            $compiled_data[@$data->city->name]
            [@$data->areaOne->name][@$data->areaTwo->name][] =
                [ $data['name'], 'name' => $data['name'],  'thumbnail' => $link.$data['image']];
        }
        return json_encode($compiled_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
