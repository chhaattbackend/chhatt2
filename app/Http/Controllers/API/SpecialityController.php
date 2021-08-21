<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Http\Resources\SpecialityCollection;
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

        $specialities = Speciality::all();
        return new SpecialityCollection($specialities);
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
        $request->validate([
            'name' => 'required',

        ]);
        Speciality::create($request->all());

        return response()->json([
            'success'=>true
        ]);

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

        return response()->json([
            'success'=>true
        ]);
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
