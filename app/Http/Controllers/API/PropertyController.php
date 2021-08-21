<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\GlobalClass;
use App\Http\Resources\Property as ResourcesProperty;
use App\Http\Resources\PropertyCollection;
use App\Http\Resources\PropertyShortCollection;
use App\Property;
use App\PropertyImage;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Resource_;

class PropertyController extends Controller
{
    public $globalclass;
    public function __construct()
    {
        $this->globalclass = new GlobalClass;
    }

    function array_push_assoc($array, $key, $value)
    {
        $array[$key] = $value;
        return $array;
    }

    // public function nearbyproperties()


    public function search(Request $request)
    {

        
        if (isset($request->nearby)) {
            $radius = 10;
            $properties = Property::select(DB::raw('*,( 3959 * acos( cos( radians(' . $request->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $request->longitude . ') ) + sin( radians(' . $request->latitude . ') ) * sin( radians(latitude) ) ) ) AS distance'))->paginate(25);
            return new PropertyCollection($properties->where('distance', '<', $request->radius));
        }

        if (isset($request->id)) {
            $properties = Property::where('id', $request->id)->first();
            return new ResourcesProperty($properties);
        }
        $global = new GlobalClass;
        $search = '';
        $properties = Property::with(['images'])->where('id', '!=', null)->whereHas('images', function ($query) use ($search) {
            $query->where('name', '!=', null);
        });
        $pagination_array = array();

        if (isset($request->search_areas)) {
            $str = explode(',', $request->search_areas);
            $area = $str[0];
            $area_id = $str[1];
            $pagination_array = array('search_areas' => $request->search_areas);
            $properties = $properties->where($area, $area_id);
            $search = '';

            $properties = $properties->whereHas('images', function ($query) use ($search) {
                $query->where('name', '!=', null);
            });
            $pagination_array = $this->array_push_assoc($pagination_array, 'search_areas', $request->search_areas);
        }
        if (isset($request->agency_id)) {
            $properties->where('agency_id', $request->agency_id);
            $pagination_array = $this->array_push_assoc($pagination_array, 'agency_id', $request->agency_id);
        }
        if (isset($request->firebase_id)) {
            $user = User::where('firebase_id', $request->firebase_id)->first();
            $properties->where('user_id', $user->id);
            $pagination_array = $this->array_push_assoc($pagination_array, 'firebase_id', $request->firebase_id);
        }
        if (isset($request->user_id)) {
            $user = User::where('id', $request->user_id)->first();
            $properties->where('user_id', $user->id);
            $pagination_array = $this->array_push_assoc($pagination_array, 'user_id', $request->user_id);
        }
        if (isset($request->deleted)) {
            $properties->where('deleted', $request->deleted);
            $pagination_array = $this->array_push_assoc($pagination_array, 'deleted', $request->deleted);
        }
        if (isset($request->status)) {
            $properties->where('status', $request->status);
            $pagination_array = $this->array_push_assoc($pagination_array, 'status', $request->status);
        }
        if (isset($request->city)) {
            $search = $request->city;
            $properties = $global->searchRelation($properties, 'areaOne', 'city_id', $search);
            $pagination_array = $this->array_push_assoc($pagination_array, 'city', $request->city);
        }
        if (isset($request->bed)) {
            $properties->where('bed', $request->bed);
            $pagination_array = $this->array_push_assoc($pagination_array, 'bed', $request->bed);
        }
        if (isset($request->property_for)) {

            $properties->where('property_for', $request->property_for);
            $pagination_array = $this->array_push_assoc($pagination_array, 'property_for', $request->property_for);
        }
        if (isset($request->property_type)) {
            $property_types = explode(',', $request->property_type);
            $properties->whereIn('property_type', $property_types);
            $pagination_array = $this->array_push_assoc($pagination_array, 'property_type', $request->property_type);
        }
        if (isset($request->bath)) {
            $properties->where('bath', $request->bath);
            $pagination_array = $this->array_push_assoc($pagination_array, 'bath', $request->bath);
        }
        if (isset($request->size)) {
            $properties->where('size', $request->size);
            $pagination_array = $this->array_push_assoc($pagination_array, 'size', $request->size);
        }
        if (isset($request->area_type)) {
            $properties->where('type', $request->area_type);
            $pagination_array = $this->array_push_assoc($pagination_array, 'area_type', $request->area_type);
        }
        if (isset($request->max_price) || isset($request->min_price)) {
            if ($request->min_price == null) {
                $request->min_price = 0;
            }
            if ($request->max_price == null) {
                $request->max_price = 9999999999;
            }
            $properties->whereBetween('price', [$request->min_price, $request->max_price]);
            $pagination_array = $this->array_push_assoc($pagination_array, 'min_price', $request->min_price);
            $pagination_array = $this->array_push_assoc($pagination_array, 'max_price', $request->max_price);
        }
        if (isset($request->max_area) || isset($request->min_area)) {
            if ($request->min_area == null) {
                $request->min_area = 0;
            }
            if ($request->max_area == null) {
                $request->max_area = 999999999;
            }
            $properties->whereBetween('size', [$request->min_area, $request->max_area]);
            $pagination_array = $this->array_push_assoc($pagination_array, 'min_area', $request->min_area);
            $pagination_array = $this->array_push_assoc($pagination_array, 'max_area', $request->max_area);
        }
        if (isset($request->user_id)) {
            $search = $request->user_id;
            $properties = $global->searchRelation($properties, 'user', 'user_id', $search);
            $pagination_array = $this->array_push_assoc($pagination_array, 'user_id', $request->user_id);
        }
        if (isset($request->search)) {
            $search = $request->search;
            $properties = $properties->where('bed','like','%'.$request->search.'%')
            ->orWhere('address','like','%'.$request->search.'%')
            ->orWhere('price','like','%'.$request->search.'%')
            ->orWhere('size','like','%'.$request->search.'%')
            ->orWhere('size_type','like','%'.$request->search.'%')
            ->orWhere('type','like','%'.$request->search.'%')
            ->orWhere('property_for','like','%'.$request->search.'%')
            ->orWhere('id','like','%'.$request->search.'%')
            ->orWhere('property_type','like','%'.$request->search.'%')
            ->orWhere('description','like','%'.$request->search.'%')
            ->orWhere('bath','like','%'.$request->search.'%')
            ->orWhereHas('areaOne', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('areaTwo', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });

            $pagination_array = $this->array_push_assoc($pagination_array, 'search', $request->search);
        }
        if (isset($request->all)) {
            $properties = $properties->orderBy('created_at', 'desc')->get();
            return new PropertyShortCollection($properties);
        }
        if (isset($request->formatted)) {
            // dd($request->formatted);
            $properties = $properties->where('formatted', $request->formatted)->paginate(25);
            return new PropertyCollection($properties);
        }
        // if (isset($request->formatted)) {
        //     // dd($request->formatted);
        //     $properties1 = $properties->where('formatted', 1)->paginate(25);
        //     $properties0 = $properties->where('formatted', 0)->paginate(25);
        //     // return new PropertyCollection($properties);

        //     return response()->json([
        //         'unformatted' => new PropertyCollection($properties0),
        //         'formatted' => new PropertyCollection($properties1),
        //     ]);
        // }

        $properties = $properties->orderBy('created_at', 'desc')->paginate(28)->setPath('');
        $properties->sortBy('priority');
        $pagination = $properties->appends($pagination_array);
        // dd($properties);
        return new PropertyCollection($properties);
    }

    public function related(Request $request)
    {
        $areaOne = AreaOne::where('name', $request->area_one_name)->first();
        $properties = Property::where('area_one_id', $areaOne->id)->where('type', $request->area_type)->whereBetween('size', [$request->size - 100, $request->size + 100])->limit(10)->get();

        return new PropertyCollection($properties);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('created_at', 'desc')->paginate(25);
        return new PropertyCollection($properties);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        $area_three = AreaThree::all();
        return view('admin.property.create', compact(['users', 'area_one', 'area_two', 'area_three']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('images'));
        // $validator = \Validator::make($request->all(), [
        //     'user_id' => 'required',

        //     'address' => 'required',
        //     'price' => 'required',
        //     'size' => 'required',
        //     'size_type' => 'required',
        //     // 'bed' => 'required',
        //     // 'bath' => 'required',
        //     'latlong' => 'required',
        //     // 'latitude' => 'required',
        //     'property_type' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return $validator->errors();
        // }




        $str = explode(',', $request->search_areas);
        $area = $str[0];
        $area_id = $str[1];

        $latitude = null;
        $longitude = null;

        if (isset($request->latlong)) {
            $latitude = explode(',', $request->latlong)[0];
            $longitude = explode(',', $request->latlong)[1];
        }
        // dd($latitude);

        $user = User::where('firebase_id', $request->firebase_id)->first();

        if ($user == null) {
            return response()->json([
                'success'
            ]);
        }
        $str = explode(',', $request->search_areas);
        $area = $str[0];
        $area_id = $str[1];
        $area_one_id = null;
        $area_two_id = null;
        $area_three_id = null;

        if ($area == 'area_one_id') {
            $area_one_id = AreaOne::where('id', $area_id)->first()->id;
        } elseif ($area == 'area_two_id') {
            $area_two = AreaTwo::find($area_id);
            $area_one_id = AreaOne::where('id', $area_two->area_one_id)->first()->id;
            $area_two_id = $area_two->id;
        } else {
            $area_three = AreaThree::find($area_id);
            $area_one_id = AreaOne::where('id', $area_three->area_one_id)->first()->id;
            $area_two_id = AreaTwo::where('id', $area_three->area_two_id)->first()->id;
        }

        // dd($area_two_id);
        // dd($user->id);
        $property = Property::create($request->except('area_one_id', 'area_two_id', 'area_three_id', 'user_id', 'images', 'latitude', 'longitude') + [
            'area_one_id' => $area_one_id,
            'area_two_id' => $area_two_id,
            'area_three_id' => $area_three_id,
            'user_id' => $user->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'status' => '0',


        ]);



        if ($request->hasFile('images')) {

            $this->globalclass->storeMultipleS3($request->file('images'), 'properties', $property->id);
        } else {
            $contents = file_get_contents('https://maps.googleapis.com/maps/api/staticmap?center=latlng&zoom=18&size=640x450&maptype=satellite&markers=icon:https://chhatt.com/StaticMap/Pins/marker3.png|' . $request->latlong . '&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU');
            $filename = 'marker' . time() . 'png';
            Storage::disk('s3')->put('properties/StaticMap/' . $filename, $contents);

            PropertyImage::create([
                'property_id' => $property->id,
                'name' => 'StaticMap/' . $filename,
                'sort_order' => 9
            ]);
        }
        return new ResourcesProperty($property);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        // $property = Property::find($id);
        return new ResourcesProperty($property);
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
        return new ResourcesProperty($property);

        return view('admin.property.edit', compact(['property', 'users', 'area_one', 'area_two', 'area_three']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $property = Property::find($request->id);
        $property->update($request->all());
        return response()->json([
            'success' => true
        ]);
    }
    public function favproperty(Request $request)
    {
        $ids = $request->p_id;
        $arrayids[] = explode(" ", $ids);
        foreach ($arrayids as  $id) {
            $properties = Property::find($id);
        }
        return new PropertyCollection($properties);
    }

    public function unformatedProperty(Request $request)
    {

        Property::create([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'formatted' => 0,
        ]);
        return response()->json([
            'success' => true
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::find($id);
        $property->update(['deleted' => 1]);
        return redirect()->back();
    }

    // public function favproperty(Request $request)
    // {

    //     $ids = $request->p_id;
    //     $arrayids[] = explode(" ", $ids);

    //     foreach ($arrayids as  $id) {
    //         $properties = Property::find($id);

    //     }
    //     return new PropertyCollection($properties);
    // }
}
