<?php

namespace App\Http\Controllers;

use App\Agent;
use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\City;
use App\GlobalClass;
use App\Http\Resources\Area;
use App\Property;
use App\PropertyFor;
use App\PropertyImage;
use App\PropertyType;
use App\User;
use App\SocialType;
use App\PropertyGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public $globalclass;
    public function __construct()
    {
        $this->globalclass = new GlobalClass;
    }

    public function search(Request $request)
    {
        $str = explode(',', $request->search_areas);
        $area = $str[0];
        $area_id = $str[1];

        $properties = Property::where($area, $area_id)->paginate(25)->setPath('');
        $pagination = $properties->appends(array(
            'search_areas' => $request->search_areas
        ));

        return response()->json([
            'data' => $properties
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!$request->keyword) {
            if (auth()->user()->role->name == 'Agency') {
                $agents = Agent::select('user_id')->where('agency_id',auth()->user()->agency->id)->get();
                $properties = Property::whereIn('user_id',$agents)->orderBy('created_at', 'desc')->paginate(25);
                // $properties = Property::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(25);
            } else {
                $properties = Property::orderBy('created_at', 'desc')->paginate(25);
            }
        } else {

            if (auth()->user()->role->name == 'Agency') {
                $seacrh = $request->keyword;
                $properties = Property::where('agency_id', auth()->user()->agency->id)->orderBy('updated_at', 'desc');

                $properties = $properties->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('user', function ($query) use ($seacrh) {
                    $query->whereHas('agent', function ($query) use ($seacrh) {
                        $query->whereHas('agency', function ($query) use ($seacrh) {
                            $query->where('name', 'like', '%' . $seacrh . '%');
                        });
                    });
                })->orWhereHas('areaOne', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('areaTwo', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('areaThree', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhere('name', 'like', '%' . $seacrh . '%')
                    ->orWhere('type', 'like', '%' . $seacrh . '%')
                    ->orWhere('id', $seacrh)
                    ->orWhere('description', 'like', '%' . $seacrh . '%')
                    ->orWhere('progress', 'like', '%' . $seacrh . '%')
                    ->paginate(25)->setPath('');

                $pagination = $properties->appends(array(
                    'keyword' => $request->keyword
                ));
            } else{
                $seacrh = $request->keyword;
                $properties = Property::where('id', '!=', null)->orderBy('updated_at', 'desc');

                $properties = $properties->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('user', function ($query) use ($seacrh) {
                    $query->whereHas('agent', function ($query) use ($seacrh) {
                        $query->whereHas('agency', function ($query) use ($seacrh) {
                            $query->where('name', 'like', '%' . $seacrh . '%');
                        });
                    });
                })->orWhereHas('areaOne', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('areaTwo', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('areaThree', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhere('name', 'like', '%' . $seacrh . '%')
                    ->orWhere('type', 'like', '%' . $seacrh . '%')
                    ->orWhere('id', $seacrh)
                    ->orWhere('description', 'like', '%' . $seacrh . '%')
                    ->orWhere('progress', 'like', '%' . $seacrh . '%')
                    ->paginate(25)->setPath('');

                $pagination = $properties->appends(array(
                    'keyword' => $request->keyword
                ));
            }
        }

        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();


        return view('admin.property.index', compact('properties', 'area_one', 'area_two'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $city = City::all();
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        $area_three = AreaThree::all();
        $propertyfor = PropertyFor::all();
        $propertytype = PropertyType::all();
        $propertySocialTypes = SocialType::all();
        $propertySocialGroups = PropertyGroup::all();
        return view('admin.property.create', compact(['users', 'city', 'area_one', 'area_two', 'area_three', 'propertyfor', 'propertytype', 'propertySocialTypes', 'propertySocialGroups']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role->name == 'Administrator' || auth()->user()->role->name == 'Agency' ) {
            $request->platform = 'Web | ' . auth()->user()->email;
            $marker = 1;
            if ($request->type == 'Residential') {
                $marker = 4;
            }
            if ($request->type == 'Commercial') {
                $marker = 3;
            }
            if ($request->type == 'Industrial') {
                $marker = 1;
            }
            $property = Property::create($request->except('images', 'platform') + ['platform' => $request->platform]);
            if ($request->hasFile('images')) {
                $this->globalclass->storeMultipleS3($request->file('images'), 'properties', $property->id);
            } else {
                $contents = file_get_contents('https://maps.googleapis.com/maps/api/staticmap?center=' . $request->latlong . '&zoom=18&size=640x450&maptype=satellite&markers=icon:https://chhatt.com/StaticMap/Pins/marker' . $marker . '.png%7C' . $request->latitude . ',' . $request->longitude . '&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU');

                $filename = 'marker' . time() . 'png';

                Storage::disk('s3')->put('properties/StaticMap/' . $filename, $contents);
                PropertyImage::create([
                    'property_id' => $property->id,
                    'name' => 'StaticMap/' . $filename,
                    'sort_order' => 9
                ]);
            }
        }
        return redirect()->route('properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('admin.property_image.edit', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $property = Property::find($id);
        $users = User::all();
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        $area_three = AreaThree::all();
        $propertyfor = PropertyFor::all();
        $propertytype = PropertyType::all();
        $propertySocialTypes = SocialType::all();
        $propertySocialGroups = PropertyGroup::all();
        $city = City::all();
        $link = url()->previous();

        return view('admin.property.edit', compact(['city', 'property', 'users', 'area_one', 'area_two', 'area_three', 'propertyfor', 'link', 'propertytype', 'propertySocialTypes', 'propertySocialGroups']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // @dd('wow');
        if (auth()->user()->role->name == 'Administrator' ||  auth()->user()->role->name == 'Agency') {
            $property = Property::find($id);
            $property->update($request->all());
            $link = $request->link;
            // @dd($link);

            if ($request->hasFile('images')) {
                $this->globalclass->storeMultipleS3($request->file('images'), 'properties', $property->id);
            } else {
                // $contents = file_get_contents('https://maps.googleapis.com/maps/api/staticmap?center=' . $request->latlong . '&zoom=18&size=640x450&maptype=satellite&markers=icon:https://chhatt.com/StaticMap/Pins/marker1.png%7C'.$request->latitude.','.$request->longitude.'&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU');

                // $filename = 'marker' . time() . 'png';
                // Storage::disk('s3')->put('properties/StaticMap/' . $filename, $contents);
                // PropertyImage::create([
                //     'property_id' => $property->id,
                //     'name' => 'StaticMap/' . $filename,
                //     'sort_order' => 9
                // ]);
            }
        }
        return redirect($link)->with('message', 'Property Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->email == 'chhattofficial@chhatt.com') {
            $property = Property::find($id);
            $property->delete();
        }
        return redirect()->back();
    }
    public function filter(Request $request)
    {


        $properties = Property::orderBy('created_at', 'desc')->paginate(25);
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();

        $area_one = AreaOne::orderBy('created_at', 'desc');
        $area_two = AreaTwo::orderBy('created_at', 'desc');
        $properties = Property::orderBy('created_at', 'desc');

        if (isset($request->type)) {
            $properties = $properties->where('properties.type', $request->type);
        }
        if (isset($request->description)) {
            $properties = $properties->where('properties.description', $request->description);
        }

        if (isset($request->area_one_id)) {
            $properties = $properties->where('properties.area_one_id', $request->area_one_id);
        }
        if (isset($request->area_two_id)) {
            $properties = $properties->where('properties.area_two_id', $request->area_two_id);
        }
        if (isset($request->structured)) {
            $properties = $properties->where('properties.structured', $request->structured);
        }


        $properties = $properties->paginate(25);
        $area_one = $area_one->paginate(25);
        $area_two = $area_two->paginate(25);

        $pagination = $properties->appends(array(
            'type' => $request->type,
            'description' => $request->description,
            'area_two_id' => $request->area_two_id,
            'area_one_id' => $request->area_one_id,
            'structured' =>  $request->structured,
        ));

        return view('admin.property.index', compact('properties', 'area_one', 'area_two'));
    }


    public function byParent(Request $request)
    {
        // $properties = Property::orderBy('created_at', 'desc')->where('area_one_id',6)->paginate(25);
        if (isset($request->area_two)) {
            $properties = Property::orderBy('created_at', 'desc')->where('area_two_id', $request->area_two)->paginate(25)->setPath('');
            $area_one = AreaOne::all();
            $area_two = AreaTwo::all();
            $pagination = $properties->appends(array(
                'area_two' => $request->area_two,
            ));
            return view('admin.property.index', compact('properties', 'area_one', 'area_two'));
        }
        if (isset($request->agent_id)) {
            $properties = Property::orderBy('created_at', 'desc')->where('user_id', $request->agent_id)->paginate(25)->setPath('');
            $area_one = AreaOne::all();
            $area_two = AreaTwo::all();
            $pagination = $properties->appends(array(
                'agent_id' => $request->agent_id,
            ));
            return view('admin.property.index', compact('properties', 'area_one', 'area_two'));
        }
        if (isset($request->agency_id)) {
            $properties = Property::orderBy('created_at', 'desc')->where('agency_id', $request->agency_id)->paginate(25)->setPath('');
            $area_one = AreaOne::all();
            $area_two = AreaTwo::all();
            $pagination = $properties->appends(array(
                'agency_id' => $request->agency_id,
            ));
            return view('admin.property.index', compact('properties', 'area_one', 'area_two'));
        }
        if (isset($request->area_one)) {
            $properties = Property::orderBy('created_at', 'desc')->where('area_one_id', $request->area_one)->paginate(25)->setPath('');
            $area_one = AreaOne::all();
            $area_two = AreaTwo::all();
            $pagination = $properties->appends(array(
                'area_one' => $request->area_one,
            ));
            return view('admin.property.index', compact('properties', 'area_one', 'area_two'));
        }
        if (isset($request->parent)) {
            // dd($request->parent);
            $area_one = AreaOne::where('id', $request->parent)->first();
            $area_two = AreaTwo::where('area_one_id', $request->parent)->first();
            $data = view('admin.property.byParentTable', compact('area_one', 'area_two'))->render();

            return response()->json([
                'data' => $data,
            ]);
        }

        $selecttag = AreaOne::all();
        $area_one = AreaOne::where('id', 6)->first();
        $area_two = AreaTwo::where('area_one_id', 6);
        return view('admin.property.by_parent', compact('area_one', 'area_two', 'selecttag'));
    }
}
