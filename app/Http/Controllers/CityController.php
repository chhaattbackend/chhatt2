<?php

namespace App\Http\Controllers;

use App\State;
use App\City;


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

        if (!$request->keyword) {
            $cities = City::paginate(25);
        } else {

            $seacrh = $request->keyword;
            $cities = City::where('id','!=',null)->orderBy('created_at','desc');

            $cities = $cities->whereHas('state', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhere('name', 'like', '%' . $seacrh . '%')->paginate(25)->setPath('');

            $pagination = $cities->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.city.index', compact('cities'));
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

        return view('admin.city.create', compact(['cities', 'states']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        City::create($request->all());

        return redirect()->route('cities.index');
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
        $cities = City::find($id);
        $states = State::find($id);

        return view("admin.city.edit", compact(['cities', 'states']));
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
        City::where('id', $id)->update($request->all());

        return redirect()->route('city.index');
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
        return redirect()->back();
    }
}
