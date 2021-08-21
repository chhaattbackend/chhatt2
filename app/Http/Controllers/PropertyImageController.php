<?php

namespace App\Http\Controllers;

use App\GlobalClass;
use App\Property;
use App\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class PropertyImageController extends Controller
{

    public $globalclass;

    public function __construct(){
        $this->globalclass=new GlobalClass;
    }
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
        
        if (auth()->user()->role->name == 'Administrator') {
            // $this->globalclass->storeMultipleS3($request->file('images'),'properties',$request->property_id);

            $property = Property::find($request->property_id);
            if ($property->type == 'Residential') {
                $this->marker = 4;
            }
            if ($property->type == 'Commercial') {
                $this->marker = 3;
            }
            if ($property->type == 'Industrial') {
                $this->marker = 1;
            }

            if ($request->hasFile('images')) {
                $this->globalclass->storeMultipleS3($request->file('images'), 'properties', $property->id);
            } else {
                if (count($property->images) == 0) {

                    $contents = file_get_contents('https://maps.googleapis.com/maps/api/staticmap?center='.$property->latlong.'&zoom=18&size=640x450&maptype=satellite&markers=icon:https://chhatt.com/StaticMap/Pins/marker'.$this->marker.'.png%7C'.$property->latitude.','.$property->longitude.'&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU');

                    $filename = 'marker' . time() . 'png';

                    Storage::disk('s3')->put('properties/StaticMap/' . $filename, $contents);
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'name' => 'StaticMap/' . $filename,
                        'sort_order' => 9
                    ]);
                }
            }
        }
        return redirect()->back();
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
