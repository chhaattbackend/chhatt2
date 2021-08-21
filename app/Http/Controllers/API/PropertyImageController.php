<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Http\Resources\PropertyImageCollection;
use App\PropertyImage;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class PropertyImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertyimage=PropertyImage::orderBy('created_at','desc')->paginate(25);

        return new PropertyImageCollection($propertyimage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $validator = \Validator::make($request->all(), [
            'property_id' => 'required',
            'name' => 'required',
            'sort_order' => 'required',
    ]);
    if ($validator->fails()) {
      return $validator->errors();
    }
    return response()->json([
        'success'=>true
    ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyImage $propertyImage)
    {
        // dd($request->all());
        foreach ($request->file('images') as $key=>$image) {
            $exe = $image->getClientOriginalName();
            $filename = time() . '-' . $exe;
            // $getthumnail .= $getbasepath . "/public/img/projects/" . $filename . 'umair';
            $image->move(public_path('img/properties/'), $filename);
            $d_img[] = $filename;
            PropertyImage::create([
                'property_id'=>$request->property_id,
                'name'=>$filename,
                'images' => 'required|image|mimes:jpeg,png,jpg,|max:3072',
                'sort_order'=>$key
            ]);
        }
        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyImage  $propertyImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propertyImage=PropertyImage::find($id);
        $propertyImage->delete();
        return redirect()->back();
    }
}
