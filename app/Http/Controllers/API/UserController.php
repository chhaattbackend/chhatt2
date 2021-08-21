<?php

namespace App\Http\Controllers\API;

use App\Agency;
use App\Agent;
use App\AgentArea;
use App\AgentSpeciality;
use App\AreaOne;
use App\AreaThree;
use App\AreaTwo;
use App\GlobalClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\PropertyImage;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public $globalclass;

    public function __construct()
    {
        $this->globalclass = new GlobalClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function find(Request $request)
    {

        if (isset($request->firebase_id)) {
            $user = User::where('firebase_id', $request->firebase_id)->first();
        }
        if (isset($request->id)) {
            $user = User::where('id', $request->id)->first();
        }
        if (isset($request->phone)) {
            //$name = explode('92',$request->phone);

            $user = User::where('phone',$request->phone)->orWhere('mobile', $request->phone)->first();
        }
        if ($user == null) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        return new UserResource($user);
    }
    public function index()
    {
        $users = User::with(['properties'])->paginate(25);
        return new UserCollection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function profile()
    {
        return view('admin.user.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // $validator = \Validator::make($request->all(), [
        //     'firebase_id' => 'required',
        //     'name' => 'required',
        //     'status' => 'required',
        //     'mobile' => 'required',
        //     'address' => 'required',
        //     'image' => 'required',
        //     'role_id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return $validator->errors();
        // }
        
        if(isset($request->role_id)){
        
        if($request->role_id == 1){
            $request->role_id =5;
            }
        }


        $agency_id = $request->agency_id;

        if ($request->agency_id == null) {
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

            $agency_id = $this->globalclass->createAgencyWithUser($request->agency_name, $request->owner_name, $request->owner_mobile, $request->owner_phone, $area_one_id, $area_two_id, $area_three_id,$request->agency_address);
        }

        $user = User::create($request->all()+['type'=>'property']);
        if ($request->role_id == 3 || $request->role_id == 5) {
            Agent::create([
                'user_id' => $user->id,
                'agency_id' => $agency_id,
                'position_id' => $request->position_id,
            ]);
        }

        if ($request->hasFile('image')) {
            $filename = $this->globalclass->storeS3($request->file('image'), 'users');
            User::where('id', $user->id)->update(['image' => $filename, 'thumbnail' => $filename]);
        }
        $user = User::find($user->id);

        return 'https://chhatt.s3.ap-south-1.amazonaws.com/users/' . $user->image.','.$user->id;

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function save_image(Request $request)
    {
        // $id = $request->userid;
        $user = User::find(auth()->user()->id);
        if ($request->hasFile('dp')) {
            if (auth()->user()->dp != null) {
                // $image_path = 'D:/xampp/htdocs/constructionchatt/public/images/userdp/'.auth()->user()->dp;
                $image_path = public_path('images/userdp/') . auth()->user()->dp;
                // dd($image_path);
                unlink($image_path);
            }
            $nnn = date('YmdHis');
            $completeFileName = $request->file('dp')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $image = $request->file('dp');
            $name = str_replace(' ', '_', $fileNameOnly) . '-' . time() . $nnn . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/userdp');
            $image->move($destinationPath, $name);
            $user->dp = $name;
            $user->save();
            return 1;
        }
    }


    public function rotate_image(Request $request)
    {
        // $data = $request->all();
        // dd($data);
        $filename = $request->image;
        $arrayimage = explode('/', $filename);
        $imagename = $arrayimage[sizeof($arrayimage) - 1];
        $filename = public_path("images/userdp/" . $imagename);
        $degrees = $request->angle;
        if ($request->angle == 90) {
            $degrees = 270;
        }
        if ($request->angle == 270) {
            $degrees = 90;
        }
        // $img=Intervention\Image\Facades\Image::make($filename);
        // $img->rotate($degrees);
        // $img->save(public_path('images/userdp/rotated.jpg'));
        // // Load the image
        // $source = imagecreatefromjpeg($filename);
        // // Rotate
        // $rotate = imagerotate($source, $degrees, 0);
        // // and save it on your server...
        // imagejpeg($rotate, public_path('images/userdp/ahkgsdhas.jpg') );
        $img_new = imagecreatefromjpeg($filename);
        $img_new = imagerotate($img_new, $degrees, 0);
        // Save rotated image
        imagejpeg($img_new, $filename, 80);
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function profileupdate(Request $request)
    {
        $user = User::find($request->user_id);
        $agent = Agent::find($request->agent_id);

        $user->update($request->all());
        $agent->update($request->all());

        if (isset($request->speciality)) {
            AgentSpeciality::where('agent_id', $agent->id)->delete();
            foreach ($request->speciality as $speciality) {
                AgentSpeciality::create([
                    'agent_id' => $agent->id,
                    'speciality_id' => $speciality
                ]);
            }
        }
        if (isset($request->areas)) {
            AgentArea::where('agent_id', $agent->id)->delete();

            foreach ($request->areas as $area) {
                AgentArea::create([
                    'agent_id' => $agent->id,
                    'area_one_id' => $area
                ]);
            }
        }
        return new UserResource($user);
    }

    public function profileimageupdate(Request $request)
    {
        $user = User::find($request->user_id);
        if ($request->hasFile('image')) {
            $filename = $this->globalclass->storeS3($request->file('image'), 'users');
            User::where('id', $user->id)->update(['image' => $filename, 'thumbnail' => $filename]);
        }

        return 'https://chhatt.s3.ap-south-1.amazonaws.com/users/' . $user->image;
    }
}
