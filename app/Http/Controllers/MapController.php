<?php

namespace App\Http\Controllers;

use App\AreaOne;
use App\AreaTwo;
use App\City;
use App\GlobalClass;
use App\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct()
    {
        $this->globalclass = new GlobalClass();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->keyword) {

            $maps = Map::orderBy('created_at', 'desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;

            $maps = Map::where('id', '!=', null)->orderBy('created_at', 'desc');

            $maps = $maps->whereHas('area_one', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('area_two', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('city_id', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhere('name', 'like', '%' . $seacrh . '%')
                ->paginate(25)->setPath('');

            $pagination = $maps->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.maps.index', compact('maps'));
    }
    public function maps(Request $request)
    {
        $all_data = Map::all();
        $compiled_data = array();
        foreach ($all_data as $data) {
            $compiled_data[$data['city']][$data['major_area']][$data['minor_area']][] =
                [$data['location'], 'name' => $data['name'],  'thumbnail' => $data['thumbnail']];
        }
        return json_encode($compiled_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        $cities = City::all();
        return view('admin.maps.create', compact(['area_one', 'area_two', 'cities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role->name == 'Administrator') {
            // dd($request->all());
            $this->validate($request, [
                'name' => 'required',
                'area_one_id' => 'required',
                'area_two_id' => 'required',
                'city_id' => 'required',

            ]);
            // dd('asdasd');
            if ($request->file('image')) {
                $filename = $this->globalclass->storeS3($request->file('image'), 'maps');
                Map::create($request->except('image') + ["image" => $filename]);
            } else {
                Map::create($request->except('image'));
            }
        }
        // dd('acha jee');
        return redirect()->route('maps.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }
    // public function explode()
    // {
    //     $string = 'https://www.chhatt.com/backend/admin/public/img/precinct/';

    //     $maps = Map::all();

    //     collect($maps)->map(function ($map) {
    //         $a = explode('/', $map->image);
    //         // dd(end($a));
    //         $map->update([
    //             'image' => end($a)
    //         ]);
    //     });
    //     dd('$maps');
    //     foreach ($maps as $items) {
    //         Map::whereNotNull('id')->update(['image' => str_ireplace($string, '', $maps->images)]);
    //     }
    //     dd($maps);
    // }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maps = Map::find($id);
        $area_two = AreaTwo::all();
        $area_one = AreaOne::all();
        $cities = City::all();
        return view('admin.maps.edit', compact(['area_one', 'area_two', 'cities', 'maps']));
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
        if (auth()->user()->role->name == 'Administrator') {
            $maps = Map::find($id);
            if ($request->file('image')) {
                $filename = $this->globalclass->storeS3($request->file('image'), 'maps');
                $maps->update($request->except('image') + ["image" => $filename]);
            } else {
                $maps->update($request->all());
            }
        }
        return redirect()->route('maps.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->email == 'chhattofficial@chhatt.com') {

            $item = Map::find($id);
            $item->delete();
        }
        return redirect()->back();
    }
}
