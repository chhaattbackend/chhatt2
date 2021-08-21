<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Agency;
use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\City;
use App\Http\Resources\Agency as ResourcesAgency;
use App\Http\Resources\AgencyCollection;
use App\Http\Resources\AgencyShort;
use App\Http\Resources\AreaAgency;
use App\Http\Resources\AreaAgencyCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AgencyController extends Controller
{

    public function agencyall()
    {
        return AgencyShort::collection(Agency::all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request->firebase_id)) {
            $user = User::where('firebase_id', $request->firebase_id)->first();
            $agencies = Agency::where('id', $user->agent->agency_id)->first();

            return new ResourcesAgency($agencies);
        }

        if (isset($request->user_id)) {
            $user = User::where('id', $request->user_id)->first();
            $agencies = Agency::where('id', $user->agent->agency_id)->first();

            return new ResourcesAgency($agencies);
        }
        if (isset($request->id)) {
            $agencies = Agency::where('id', $request->id)->first();
            return new ResourcesAgency($agencies);
        }
        if (!$request->keyword) {
            $agencies = Agency::paginate(28);
        } else {
            $seacrh = $request->keyword;
            $agencies = Agency::where('id', '!=', null);

            $agencies = $agencies
                ->whereHas('user', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('areaOne', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('areaTwo', function ($query) use ($seacrh) {
                    $query->where('name', 'like', '%' . $seacrh . '%');
                })->orWhereHas('user', function ($query) use ($seacrh) {
                    $query->where('phone', 'like', '%' . $seacrh . '%')->orWhere('mobile', 'like', '%' . $seacrh . '%');
                })->orWhere('name', 'like', '%' . $seacrh . '%')->paginate(25)->setPath('');

            $pagination = $agencies->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return new AgencyCollection($agencies);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agencies = Agency::all();
        $users = User::all();
        $area_one = AreaOne::all();
        $area_two = AreaTwo::all();
        $area_three = AreaThree::all();

        return response()->json([
            'agencies' => $agencies,
            'users' => $users,
            'area_one' => $area_one,
            'area_two' => $area_two,
            'area_three' => $area_three,
        ]);
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
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'verified' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $str = explode(',', $request->search_areas);
        $area = $str[0];
        $area_id = $str[1];
        $area_one_id = null;
        $area_two_id = null;
        $area_three_id = null;
        // dd($request->all());
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

        $user = User::create($request->all()+['type'=>'property']);
        $agency = Agency::create([
            'user_id' => $user->id,
            'name' => $request->agency_name,
            'area_one_id' => $area_one_id,
            'area_two_id' => $area_two_id,
            'area_three_id' => $area_three_id,
            'status' => $request->status,
            'verified' => $request->verified,

        ]);
        return new ResourcesAgency($agency);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = Agency::find($id);
        return new ResourcesAgency($agency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $agency = Agency::find($request->id);
        $agency->update($request->except('name', 'status') + [
            'name' => $request->agency_name,
            'status' => $request->agency_status
        ]);

        User::where('id', $agency->user_id)->update($request->all());

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Agency::find($id);
        $item->delete();
        return response()->json([
            'success' => true
        ]);
    }
    public function actionCheck()
    {
        $all_data = Agency::all();
        $compiled_data = array();
        foreach ($all_data as $data) {

            $city = optional(optional($data->areaOne)->city)->name;
            $area_one_name = optional($data->areaOne)->name;
            $area_two_name = optional($data->areaTwo)->name;

            $compiled_data[$city][$area_one_name][$area_two_name][$data['location']][] = ['id' => $data['id'], 'name' => $data['name'], 'city' => $city, 'area_one_name' => $area_one_name];
        }
        return json_encode($compiled_data);
    }
}
