<?php

namespace App\Http\Controllers;

use App\AreaOne;
use App\AreaTwo;
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
        if (!$request->keyword) {
            $areatwos = AreaTwo::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $areatwos = AreaTwo::where('id','!=',null)->orderBy('created_at','desc');

            $areatwos = $areatwos->WhereHas('area_one', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhere('name', 'like', '%' . $seacrh . '%')->paginate(25)->setPath('');

            $pagination = $areatwos->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.area_two.index', compact('areatwos'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areaones = AreaOne::all();
        return view('admin.area_two.create', compact('areaones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AreaTwo::create($request->all());

        return redirect()->route('areatwos.index');
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
        $areaones = AreaOne::all();
        return view("admin.area_two.edit", compact('areatwo', 'areaones'));
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
        $areatwo = AreaTwo::find($id);
        $areatwo->update($request->all());

        return redirect()->route('areatwos.index');
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
        return redirect()->back();
    }
}
