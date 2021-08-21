<?php

namespace App\Http\Controllers;

use App\AreaOne;
use App\AreaTwo;
use App\AreaThree;
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

        if (!$request->keyword) {
            $areathrees = AreaThree::orderBy('created_at','desc')->paginate(25);
        } else {

            $seacrh = $request->keyword;
            $areathrees = AreaThree::where('id','!=',null)->orderBy('created_at','desc');

            $areathrees = $areathrees->whereHas('area_one', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhereHas('area_two', function ($query) use ($seacrh) {
                $query->where('name', 'like', '%' . $seacrh . '%');
            })->orWhere('name', 'like', '%' . $seacrh . '%')->paginate(25)->setPath('');

            $pagination = $areathrees->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.area_three.index', compact('areathrees'));
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
        return view('admin.area_three.create', compact('areatwos', 'areaones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AreaThree::create($request->all());

        return redirect()->route('areathrees.index');
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
        $areatwos = AreaTwo::all();
        $areaones = AreaOne::all();
        return view("admin.area_three.edit", compact('areathree', 'areatwos', 'areaones'));
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
        $areathree = AreaThree::find($id);
        $areathree->update($request->all());

        return redirect()->route('areathrees.index');
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
        return redirect()->back();
    }
}
