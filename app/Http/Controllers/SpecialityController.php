<?php

namespace App\Http\Controllers;

use App\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->keyword){
            $specialities=Speciality::orderBy('created_at','desc')->paginate(25);
            }
            else{
                $specialities=Speciality::where('name','like','%'.$request->keyword.'%')
                ->paginate(25)->setPath ( '' );
                $pagination = $specialities->appends ( array (
                    'keyword' => $request->keyword
            ));
            }
            return view('admin.speciality.index', compact('specialities'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialities = Speciality::all();
        return view('admin.speciality.create',compact('specialities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Speciality::create($request->all());

        return redirect()->route('specialities.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $speciality = Speciality::find($id);
        return view("admin.speciality.edit",compact('speciality'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $speciality = Speciality::find($id);
        $speciality->update($request->all());

        return redirect()->route('specialities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Speciality::find($id);
        $item->delete();
        return redirect()->back();
    }
}
