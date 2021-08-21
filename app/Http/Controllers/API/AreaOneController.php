<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Agency;
use App\Agent;
use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\City;
use App\Http\Resources\AreaOne as ResourcesAreaOne;
use App\Http\Resources\AreaOneCollection;
use App\Http\Resources\AreaThreeCollection;
use App\Http\Resources\AreaTwoCollection;
use App\Http\Resources\CityCollection;
use App\Http\Resources\ConstructionProductCollection;
use App\Lead;
use App\LeadProject;
use App\Property;
use App\PropertyImage;
use App\PropertySocial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AreaOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areones = AreaOne::all();
        // cache()->remember('areaones',99999, function () use ($areones) {
        // });
        // return cache()->get('areaones');
        return new AreaOneCollection($areones);
    }

    public function allareas(Request $request)
    {
        $areaones = AreaOne::where('id', '!=', null);
        $areatwos = AreaTwo::where('id', '!=', null);
        $areathrees = AreaThree::where('id', '!=', null);

        if (isset($request->city)) {
            $seacrh = $request->city;
            $areaones = $areaones->whereHas('city', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            });

            $areatwos = $areatwos->whereHas('area_one', function ($query) use ($seacrh) {
                $query->whereHas('city', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            });

            $areathrees = $areathrees->whereHas('area_one', function ($query) use ($seacrh) {
                $query->whereHas('city', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            });
        }
        $a = new AreaOneCollection($areaones->get());
        $b = new AreaTwoCollection($areatwos->get());
        $c = new AreaThreeCollection($areathrees->get());


        $a = json_decode(json_encode($a));
        $b = json_decode(json_encode($b));
        $c = json_decode(json_encode($c));

        return response()->json([
            'data' => array_merge($a, $b, $c)
        ]);
    }


    public function mainsearch(Request $request)
    {
        $areaones = AreaOne::where('id', '!=', null);
        $areatwos = AreaTwo::where('id', '!=', null);
        $areathrees = AreaThree::where('id', '!=', null);
        $construction_products = DB::table('construction_products')->get();

        if (isset($request->city)) {
            $seacrh = $request->city;
            $areaones = $areaones->whereHas('city', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            });

            $areatwos = $areatwos->whereHas('area_one', function ($query) use ($seacrh) {
                $query->whereHas('city', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            });

            $areathrees = $areathrees->whereHas('area_one', function ($query) use ($seacrh) {
                $query->whereHas('city', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                });
            });
        }
        $a = new AreaOneCollection($areaones->get());
        $b = new AreaTwoCollection($areatwos->get());
        $c = new AreaThreeCollection($areathrees->get());
        $d = new ConstructionProductCollection($construction_products);


        $a = json_decode(json_encode($a));
        $b = json_decode(json_encode($b));
        $c = json_decode(json_encode($c));
        $d =  json_decode(json_encode($d));

        $merged_array = array_merge($a, $b, $c, $d);

        if (isset($request->search)) {
            $search=$request->search;
            $merged_array = \Arr::where($merged_array, function ($value, $key) use ($search) {
                return str_contains(strtolower($value->name), strtolower($search));
            });
        }

        return response()->json([
            'data' => $merged_array
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areaones = AreaOne::all();
        return view('admin.area_one.create', compact('areaones'));
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
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        AreaOne::create($request->all());
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function show(AreaOne $areaone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areaone = AreaOne::find($id);
        return new ResourcesAreaOne($areaone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $areaone = AreaOne::find($request->id);
        $areaone->update($request->all());

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AreaOne::find($id);
        $item->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
