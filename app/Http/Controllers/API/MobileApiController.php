<?php

namespace App\Http\Controllers\API;

use App\Agency;
use App\Agent;
use App\Http\Controllers\Controller;
use App\Property;
use App\Role;
use App\Speciality;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class MobileApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function client_reg(Request $request)
    {


        // $input = $request->all();
        $w_ids = (explode(",", $request->w_id));
        $check = Agency::where(['id' => $request->office_id, 'status' => 1])->get();



        $getthumnail = '';
        global $d_img;
        $getbasepath = URL::to('/');
        //$data=>array();
        $getthumbnail = request("thumbnail");
        if ($getthumbnail != null) {
            foreach ($request->file('thumbnail') as $image) {
                $exe = $image->getClientOriginalName();
                $filename = time() . '-' . $exe;
                $getthumnail .= $getbasepath . "/public/img/clients/" . $filename;
                $image->move(public_path('img/clients'), $filename);

                $d_img[] = $filename;
            }
        } else {
            $getthumnail = $request->photo;
        }


        if ($check->count() == 0 && $request->p_id == 1 || $check->count() == 0 && $request->p_id == 2) {


            if ($request->p_id == 1) {
                $ag = Agency::create([
                    'name' => $request->office_id,
                    'des' => $request->office_id,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'major_area' => $request->major_area,
                    'minor_area' => $request->minor_area,
                    'status' => 1,
                    'o_name' => $request->name,
                    'o_contact' => $request->phone,
                ]);
                # code...
            } else {
                $ag = Agency::create([
                    'name' => $request->office_id,
                    'des' => $request->office_id,
                    'phone' => $request->phone,
                    'major_area' => $request->major_area,
                    'minor_area' => $request->minor_area,
                    'email' => $request->email,
                    'address' => $request->address,
                    'status' => 1,
                ]);
            }

            $a_data = Agency::where(['phone' => $request->phone])->get();
            global $f_id;
            foreach ($a_data as $d) {
                $f_id = $d->id;
            }
            global $va;
            $va = $request->refferal;

            if ($va == "1") {

                $rew = Ext::create([
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'referal_id' => $request->referal_id,
                    'referal_name' => $request->referal_name,
                    'reward' => $request->reward,
                ]);
            }



            $user = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'p_id' => $request->p_id,
                'thumbnail' => $getthumnail,
                'image' => json_encode($d_img),
                'd_id' => $request->d_id,
                'isonline' => $request->isonline,
                'phone' => $request->phone,
                'office_id' => $f_id,
                'u_id' => $request->u_id,
                'w_id' => json_encode($w_ids),
                'status' => 0,

            ]);
            $agent = Agent::create([
                'name' => $request->name,
                'd_id' => $request->d_id,
                'office_id' => $f_id,
                'position' => $request->p_id,
                'phone' => $request->phone,
                'mobile' => $request->phone,
                'status' => 1,
            ]);



            return response($getthumnail);
        } else {
            global $va;
            $va = $request->refferal;

            if ($va == "1") {

                $rew = Ext::create([
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'referal_id' => $request->referal_id,
                    'referal_name' => $request->referal_name,
                    'reward' => $request->reward,
                ]);

                return response()->json($rew);
            }


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'thumbnail' => $getthumnail,
                'image' => json_encode($d_img),
                'office_id' => $request->office_id,
                'p_id' => $request->p_id,
                'd_id' => $request->d_id,
                'isonline' => $request->isonline,
                'phone' => $request->phone,
                'u_id' => $request->u_id,
                'w_id' => json_encode($w_ids),



            ]);
            $agent = Agent::create([
                'name' => $request->name,
                'd_id' => $request->d_id,
                'office_id' => $request->office_id,
                'position' => $request->p_id,
                'phone' => $request->phone,
                'mobile' => $request->phone,
                'status' => 1,
            ]);
        }

        // $input['password'] = bcrypt($input['password']);
        return response($getthumnail);
        // $success['token'] =  $user->createToken('MyApp')-> accessToken;
        //$success['name'] =  $user->name;

    }

    public function get_users()
    {
        $users = User::all();
        return json_encode($users);
    }

    public function designations()
    {
        $speciality = Speciality::all();
        return json_encode($speciality);
    }

    public function workingspec()
    {
        //don't know
        $speciality = Speciality::all();
        return json_encode($speciality);
    }

    public function positions()
    {
        $roles = Role::all();
        return json_encode($roles);
    }

    public function get_agency()
    {
        $agencies = Agency::where(['status' => 1])->paginate(25);

        $a = array();
        foreach ($agencies as $agency) {
            $user = User::find($agency->user_id);

            array_push($a, [
                'id' => $agency->id,
                'thumbnail' => $user->thumbnail,
                'verified' => $agency->verified,
                'name' => $agency->name,
                'o_name' => $user->name,
                'o_contact' => $user->mobile,
                'address' => $user->address,
                'latitude' => $agency->latitude,
                'longitude' => $agency->longitude,
                'phone' => $user->phone,
                'email' => $user->email,
                'city' => $agency->city,
                'major_area' => $agency->major_area,
                'minor_area' => $agency->minor_area,
                'location' => $agency->location,
                'status' => $agency->status,
                'created_at' => $agency->created_at,
                'updated_at' => $agency->updated_at,
            ]);
        }
        return response()->json([
            'data' => $a
        ]);
    }

    public function get_pro(Request $request)
    {
        $properties = Property::orderBy('id', 'asc')->paginate(25);
        $a = array();

        if (isset($request->id)) {
            $properties = Property::where('id', $request->id)->get();
        }

        foreach ($properties as $property) {
            $user = User::find($property->user_id);
            $agency=Agency::where('user_id','=',$property->user_id)->get();
            // dd($agency);


            array_push($a, [
                'id' => $property->id,
                'User_id' => $user->firebase_id,
                'office_id' => optional($property->user->agent->agency)->id,
                'client_id' => $user->id,
                'post_click' => optional($property->social)->likes,
                'status' => $property->id,
                'url' => $property->id,
                'soft_delete' => $property->id,
                'post_sold' => $property->id,
                'user_name' => $property->id,
                'post_detail_id' => $property->id,
                'location_id' => $property->id,
                'country' => $property->id,
                'region' => $property->id,
                'state' => $property->id,
                'address' => $property->id,
                'city' => $property->id,
                'web_post' => $property->id,
                'post_descrip' => $property->id,
                'latlng' => $property->id,
                'latitude' => $property->id,
                'longitude' => $property->id,
                'major_area' => $property->id,
                'minor_area' => $property->id,
                'street' => $property->id,
                'house' => $property->id,
                'apu' => $property->id,
                'bath' => $property->id,
                'bed' => $property->id,
                'cat_id' => $property->id,
                'phone' => $property->id,
                'price' => $property->id,
                'p_type' => $property->id,
                's_price' => $property->id,
                'corner' => $property->id,
                'amunities' => $property->id,
                'squ' => $property->id,
                'plt' => $property->id,
                'p_for' => $property->id,
                'listtype' => $property->id,
                'user_image' => $property->id,
                'thumbnail' => $property->id,
                'image' => $property->id,
                'created_at' => $property->id,
                'updated_at' => $property->id,
                'ext_a' => $property->id,
                'ext_b' => $property->id,
                'features' => $property->id,
                'free_txt' => $property->id,
                'facing' => $property->id,
                'likes' => $property->id,
                'views' => $property->id,
                'view_id' => $property->id,
                'user_posted' => $property->id
            ]);
        }

        return response()->json([
            'data' => $a
        ]);
    }
}
