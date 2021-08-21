<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Agent;
use App\AgentSpeciality;
use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\City;
use App\Lead;
use App\LeadProject;
use App\Property;
use App\PropertyImage;
use App\PropertySocial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AreaOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        // $agenciesold=DB::table('agencies1')->get();
        // foreach($agenciesold as $agency){
        //     Agency::where('name',$agency->name)->update([
        //         'image'=>$agency->thumbnail
        //     ]);
        // }

        // $oldleads = \DB::table('leads11')->get();
        // foreach ($oldleads as $oldlead) {

        //     Lead::create([

        //         'project_id' => $oldlead->project_id,
        //         'name' => $oldlead->name,
        //         'phone' => $oldlead->phone,
        //         'email' => $oldlead->email,
        //         'description' => $oldlead->description,
        //         'area' => $oldlead->area,
        //         'budget' => $oldlead->budget,
        //         'lead_type' => $oldlead->lead_type,
        //         'how_soon' => $oldlead->how_soon,
        //         'family_members' => $oldlead->family_members,
        //         'property_type' => $oldlead->property_type,
        //         'leadsource' => $oldlead->leadsource,
        //         'status' => $oldlead->lead_status,
        //         'call_status' => $oldlead->call_status,
        //         'response_status' => $oldlead->response_status,
        //         'created_by' => $oldlead->created_by,
        //     ]);
        // }

        // $leads = Lead::all();
        // foreach ($leads as $lead) {
        //     if ($lead->project_id != null) {
        //         if ($lead->project_id == 4) {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 2
        //             ]);
        //         } else if($lead->project_id == 5){
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 4
        //             ]);
        //         }
        //         else if($lead->project_id == 6){
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 3
        //             ]);
        //         }
        //         else if($lead->project_id == 1){
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 1
        //             ]);
        //         }


        //     }
        // }

        if (!$request->keyword) {
            $areaones = AreaOne::paginate(25);
        } else {
            $areaones = AreaOne::where('name', 'like', '%' . $request->keyword . '%')
                ->paginate(25)->setPath('');
            $pagination = $areaones->appends(array(
                'keyword' => $request->keyword
            ));
        }
        return view('admin.area_one.index', compact('areaones'));




        // $clients = DB::table('clients')->get();
        // foreach ($clients as  $value) {
        //     $user = User::where('name', $value->name)->orWhere('phone', $value->phone)->first();
        //     $agent = Agent::where('user_id', $user->id)->first();
        //     // dd($value->d_id);
        //     AgentSpeciality::create([
        //         'agent_id' => $agent->id,
        //         'speciality_id' => $value->d_id,
        //     ]);
        // }
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areaones = AreaOne::all();
        $cities = City::all();
        return view('admin.area_one.create', compact('areaones', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AreaOne::create($request->all());
        return redirect()->route('areaones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        // dd('done');
        set_time_limit(0);
        // Area One

        // $areas = DB::table('post_details')->get();
        // foreach ($areas as $area) {

        //     // $minor_area_name=DB::table('post_details')->where('id',$area->post_detail_id)->first();
        //     // $major_area_name=$minor_area_name->major_area;
        //     // $minor_area_name=$minor_area_name->minor_area;


        //     $areaone = AreaOne::where('name', $area->major_area)->first();

        //     // $areatwo=AreaTwo::where('name',$minor_area_name)->first();

        //     if ($areaone == null) {
        //         AreaOne::create([
        //             'name' => $area->major_area,
        //             'city_id' => 1
        //         ]);
        //     }
        // }
        // AreaOne::create([
        //     'name' => 'Unknown Area',
        //     'city_id' => 1
        // ]);



        // // Area Two

        // $areas = DB::table('post_details')->get();
        // foreach ($areas as $area) {

        //     // $minor_area_name=DB::table('post_details')->where('id',$area->post_detail_id)->first();
        //     // $major_area_name=$minor_area_name->major_area;
        //     // $minor_area_name=$minor_area_name->minor_area;

        //     $areaone = AreaOne::where('name', $area->major_area)->first();

        //     $areatwo = AreaTwo::where('name', $area->minor_area)->first();


        //     AreaTwo::create([
        //         'name' => $area->minor_area,
        //         'area_one_id' => $areaone->id,
        //         'latitude' => $area->latitude,
        //         'longitude' => $area->longitude,
        //         'latlong' => $area->latlng

        //     ]);
        // }



        // // Clients


        // $clients = DB::table('clients')->get();
        // foreach ($clients as $client) {
        //     // $check=User::where('email',$client->email)->first();
        //     // if($check==null){
        //     User::create([
        //         'name' => $client->name,
        //         'email' => $client->email,
        //         'password' => Hash::make('password'),
        //         'phone' => $client->phone,
        //         'thumbnail' => $client->thumbnail,
        //         'firebase_id' => $client->u_id,
        //         'role_id' => 4
        //     ]);
        //     // }
        // }


        // // Agencies

        // $agencies = DB::table('agencies1')->get();
        // foreach ($agencies as $agency) {
        //     $email = strtolower(str_ireplace(' ', '-', $agency->name));
        //     // dd();
        //     $name = $agency->o_name;
        //     if ($name == null) {
        //         $name = $agency->name;
        //     }
        //     $user = User::create([
        //         'name' => $name,
        //         'mobile' => $agency->o_contact,
        //         'address' => $agency->address,
        //         'latitude' => $agency->latitude,
        //         'longitude' => $agency->longitude,
        //         'status' => $agency->status,
        //         'thumbnail' => $agency->thumbnail,
        //         'role_id' => 2,
        //         'phone' => $agency->phone,
        //         'email' => $email . '@chhatt.com',
        //         'password' => Hash::make('password'),

        //     ]);

        //     $agency1 = Agency::create([
        //         'name' => $agency->name,

        //         'user_id' => $user->id,
        //         'major_area' => $agency->major_area,
        //         'minor_area' => $agency->minor_area,
        //         'location' => $agency->location,
        //         'verified' => $agency->verified,
        //         'status' => $agency->status,

        //     ]);
        //     //

        // }


        // // Agents

        // $agents1 = DB::table('agents1')->get();
        // foreach ($agents1 as $agent) {

        //     $office = DB::table('agencies1')->where('id', $agent->office_id)->first();
        //     if ($office != null) {
        //         $agency = Agency::where('name', $office->name)->first();
        //         $user = User::where('phone', $agent->phone)->first();
        //         if ($user != null && $agency != null) {
        //             // dd($agent->phone);
        //             // dd($agency->id);
        //             // dd($user->id);
        //             Agent::create([
        //                 'agency_id' => $agency->id,
        //                 'user_id' => $user->id,
        //                 'position_id' => $agent->position
        //             ]);
        //         }
        //     }
        // }


        // // Properties

        // $a = 0;
        // $chatprop = DB::table('posts')->get();
        // foreach ($chatprop as $property) {
        //     // user_id
        //     $client = DB::table('clients')->where('id', $property->client_id)->first();
        //     if ($client != null) {
        //         $user = User::where('phone', $client->phone)->first();
        //         // area_one_id
        //         if ($property->post_detail_id != null) {
        //             $post_detail = DB::table('post_details')->where('id', $property->post_detail_id)->first();
        //             if ($post_detail != null) {
        //                 $area_one = AreaOne::where('name', $post_detail->major_area)->first();
        //                 if ($area_one != null) {
        //                     $area_two = AreaTwo::where('area_one_id', $area_one->id)->where('name', $post_detail->minor_area)->first();
        //                     if ($area_two == null) {
        //                         $a++;
        //                     }
        //                 }
        //                 $latitude = explode(',', $property->latlng)[0];
        //                 $longitude = explode(',', $property->latlng)[1];
        //                 // dd($area_one);
        //                 // dd($area_two);
        //                 if ($area_one != null && $area_two != null) {
        //                     $property1 = Property::create([
        //                         'user_id' => $user->id,
        //                         'area_one_id' => $area_one->id,
        //                         'area_two_id' => $area_two->id,
        //                         'address' => $property->address,
        //                         'price' => $property->price,
        //                         'size' => $property->plt,
        //                         'size_type' => $property->squ,
        //                         'type' => $property->p_type,
        //                         'bed' => $property->bed,
        //                         'bath' => $property->bath,
        //                         'description' => $property->p_for,
        //                         'property_for' => $property->p_for,
        //                         'property_type' => $property->cat_id,
        //                         'priority' => 3,
        //                         'advertised' => 0,
        //                         'images' => $property->thumbnail,
        //                         'latitude' => $latitude,
        //                         'longitude' => $longitude,

        //                     ]);
        //                     PropertySocial::create([
        //                         'property_id' => $property1->id,
        //                         'clicks' => $property->post_click,
        //                         'likes' => $property->likes,
        //                         'views' => $property->views,

        //                     ]);
        //                 }
        //             }
        //         }
        //     }
        // }


        // //Property Images



        // Property::where('bed', 'null')->update(['bed' => null]);
        // Property::where('bed', 'null')->update(['bed' => null]);




        // // updating users to agents

        // $agents = Agent::all();
        // foreach ($agents as $agent) {
        //     User::where('id', $agent->user_id)->where('role_id', 4)->update([
        //         'role_id' => 3
        //     ]);
        // }


        // // assigning leads to projects


        // $leads = Lead::all();
        // foreach ($leads as $lead) {
        //     if ($lead->project_id != null) {
        //         if ($lead->project_id == 4) {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 2
        //             ]);
        //         } else {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 1
        //             ]);
        //         }
        //     }
        // }



        // // updating agency areas
        // $agencies = Agency::all();
        // foreach ($agencies as $agency) {
        //     $areaone = AreaOne::where('name', $agency->major_area)->first();
        //     if ($areaone != null) {
        //         $areatwo = AreaTwo::where('name', $agency->minor_area)->where('area_one_id', $areaone->id)->first();
        //     }
        //     if ($areaone != null && $areatwo != null) {
        //         Agency::where('id', $agency->id)->update([
        //             'area_one_id' => $areaone->id,
        //             'area_two_id' => $areatwo->id,

        //         ]);
        //     }
        // }




        // $users = User::all();
        // foreach ($users as $key => $user) {
        //     $image = str_ireplace('https://chhatt.com/backend/admin/public/img/clients/', '', $user->thumbnail);
        //     User::where('id', $user->id)->update(['thumbnail' => $image]);
        // }






        // // updating lat long in agencies

        // $agenciesold = DB::table('agencies1')->get();
        // foreach ($agenciesold as $agency) {
        //     Agency::where('name', $agency->name)->update([
        //         'latitude' => $agency->latitude,
        //         'longitude' => $agency->longitude

        //     ]);
        // }


        // $string = 'https://chhatt.com/backend/admin/public/img/properties/';

        // $properties = Property::all();
        // foreach ($properties as $property) {
        //     Property::where('id', $property->id)->update(['images' => str_ireplace($string, '', $property->images)]);
        // }

        // $string = 'umair';

        // $properties = Property::all();
        // foreach ($properties as $property) {
        //     Property::where('id', $property->id)->update(['images' => str_ireplace($string, ',', $property->images)]);
        // }

        // $string = 'https://www.chhatt.com/StaticMap/';

        // $properties = Property::all();
        // foreach ($properties as $property) {
        //     Property::where('id', $property->id)->update(['images' => str_ireplace($string, 'StaticMap/', $property->images)]);
        // }


        // $properties = Property::all();
        // foreach ($properties as $property) {
        //     // $check=strpos($property->images, 'https');
        //     if ($property->images != null && $property->images != 'null') {
        //         $images = explode(',', $property->images);
        //         $imagecount = count($images);
        //         for ($i = 0; $i < $imagecount; $i++) {
        //             PropertyImage::create([
        //                 'property_id' => $property->id,
        //                 'name' => $images[$i],
        //                 'sort_order' => $i
        //             ]);
        //         }
        //     }
        // }

        // PropertyImage::where('name', '')->delete();


        // $string = 'https://www.chhatt.com/backend/admin/public/img/properties/';

        // $properties = PropertyImage::all();
        // foreach ($properties as $property) {
        //     PropertyImage::where('id', $property->id)->update(['name' => str_ireplace($string, '', $property->name)]);
        // }

        // $string = 'https://www.chhatt.com/backend/admin/public/img/properties/';

        // $properties = PropertyImage::all();
        // foreach ($properties as $property) {
        //     PropertyImage::where('id', $property->id)->update(['name' => str_ireplace($string, '', $property->name)]);
        // }


        // $string = 'https://chhatt.com/backend/admin/public/img/static/';

        // $properties = PropertyImage::all();
        // foreach ($properties as $property) {
        //     PropertyImage::where('id', $property->id)->update(['name' => str_ireplace($string, 'static/', $property->name)]);
        // }


        // // $properties = Property::all();
        // // foreach ($properties as $property) {
        // //     Property::where('id', $property->id)->update([
        // //         'property_type' => $property->description,
        // //         'description' => NULL
        // //     ]);
        // // }

        // $properties = Property::all();
        // foreach ($properties as $property) {
        //     if ($property->user->agent != null) {
        //         $agency = Agency::where('id', $property->user->agent->agency->id)->first();

        //         Property::where('id', $property->id)->update([
        //             'agency_id' => $agency->id
        //         ]);
        //     }
        // }


        // $oldleads = \DB::table('leads11')->get();
        // foreach ($oldleads as $oldlead) {

        //     Lead::create([

        //         'project_id' => $oldlead->project_id,
        //         'name' => $oldlead->name,
        //         'phone' => $oldlead->phone,
        //         'email' => $oldlead->email,
        //         'description' => $oldlead->description,
        //         'area' => $oldlead->area,
        //         'budget' => $oldlead->budget,
        //         'lead_type' => $oldlead->lead_type,
        //         'how_soon' => $oldlead->how_soon,
        //         'family_members' => $oldlead->family_members,
        //         'property_type' => $oldlead->property_type,
        //         'leadsource' => $oldlead->leadsource,
        //         'status' => $oldlead->lead_status,
        //         'call_status' => $oldlead->call_status,
        //         'response_status' => $oldlead->response_status,
        //         'created_by' => $oldlead->created_by,
        //     ]);
        // }

        // // assigning leads to projects


        // $leads = Lead::all();
        // foreach ($leads as $lead) {
        //     if ($lead->project_id != null) {
        //         if ($lead->project_id == 4) {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 2
        //             ]);
        //         } else if($lead->project_id == 5){
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 4
        //             ]);
        //         }
        //         else if($lead->project_id == 6){
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 3
        //             ]);
        //         }


        //     }
        // }

        // $leads = Lead::all();
        // foreach ($leads as $lead) {
        //     $area = AreaOne::where('name', 'LIKE', '%' . $lead->area . '%')->first();
        //     if ($lead->area == null || $area == null) {
        //         $area = AreaOne::where('name', 'Unknown Area')->first();
        //     }
        //     Lead::where('id', $lead->id)->update(['area_one_id' => $area->id]);
        // }

        // $agencies = Agency::where('area_one_id', '!=', null)->get();
        // foreach ($agencies as $agency) {
        //     $areaone = AreaOne::where('name', 'like', '%' . $agency->major_area . '%')->first();
        //     if ($areaone != null) {
        //         Agency::where('id', $agency->id)->update(['area_one_id' => $areaone->id]);
        //     }
        //     // $areatwo=AreaTwo::where('name', 'like', '%' . $agency->minor_area . '%')->where('area_one_id', $areaone->id);
        // }


        // $agencies = Agency::where('area_one_id', '!=', null)->where('area_two_id', null)->get();
        // foreach ($agencies as $agency) {
        //     $areatwo = AreaTwo::where('name', 'like', '%' . $agency->minor_area . '%')->where('area_one_id', $agency->area_one_id)->first();
        //     if ($areatwo != null) {
        //         Agency::where('id', $agency->id)->update(['area_two_id' => $areatwo->id]);
        //     }
        //     // $areatwo=AreaTwo::where('name', 'like', '%' . $agency->minor_area . '%')->where('area_one_id', $areaone->id);
        // }

        // $leads = Lead::all();
        // foreach ($leads as $lead) {
        //     if ($lead->project_id != null) {
        //         if ($lead->project_id == 4) {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 2
        //             ]);
        //         } else if ($lead->project_id == 5) {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 4
        //             ]);
        //         } else if ($lead->project_id == 6) {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 3
        //             ]);
        //         } else if ($lead->project_id == 1) {
        //             LeadProject::create([
        //                 'lead_id' => $lead->id,
        //                 'project_id' => 1
        //             ]);
        //         }
        //     }
        // }



        // $properties = Property::all();
        // foreach ($properties as $properties) {
        //     if ($properties->area_two_id == '427' || $properties->area_two_id == '442' || $properties->area_two_id == '423') {
        //         Property::where('id', $properties->id)->update([
        //             'area_two_id' => 69
        //         ]);
        //     }

        //     if ($properties->area_one_id == '103' || $properties->area_one_id == '104') {
        //         Property::where('id', $properties->id)->update([
        //             'area_one_id' => 6,
        //             'area_two_id' => 69
        //         ]);
        //     }
        // }


         $properties = Property::all();
        foreach ($properties as $property) {
            Property::where('id',$property->id)->update(['bed'=>$property->bed.' bed','bath'=>$property->bath.' bath']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areaone = AreaOne::find($id);
        $cities = City::all();
        return view("admin.area_one.edit", compact('areaone', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $areaone = AreaOne::find($id);
        $areaone->update($request->all());

        return redirect()->route('areaones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\areaone  $areaone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AreaOne::find($id);
        $item->delete();
        return redirect()->back();
    }
}
