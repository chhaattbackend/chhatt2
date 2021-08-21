<?php

namespace App\Http\Controllers;
use App\cr;
use Illuminate\Http\Request;
use App\Client;
use App\Designation;
use App\Position;
use App\Agency;
use App\Leads;
use App\Post;
use App\Activity;
use App\Student;
use App\Area_cat;
use App\Agent;
use App\Map;
use App\Lead;
use App\LeadAssign;
use App\Ext;
use App\Post_detail;
use App\State;
use App\Reward;
use App\Workspec;
use App\Area;
use App\Click;
use App\Plot_cat;
use App\PropertySocial;
use App\SalesAgent;
use App\User;
use DB;
use App\Work_T;
use Validator;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as BaseCollection;
use PhpParser\Builder\Property;

class SampleController extends Controller
{


    public $count = 0;
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
        // $check = request("office_id");
        // if(is_numeric($check)){
        // dd(request("office_id"));
        // }
        // else{
        //     dd(request("office_id"));
        // }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone'=>'required|unique:clients',
            'u_id'=>'required|unique:clients',
        ]);
        if ($validator->fails()) {
           // return json_encode($validator->errors());
           return response()->json(['error'=>$validator->errors()], 401);

        }
        // $input = $request->all();
        $w_ids=(explode(",",$request->w_id));
        $check=Agency::where(['id'=>$request->office_id,'status'=>1])->get();



             $getthumnail = '';
         global $d_img;
        $getbasepath = URL::to('/');
          //$data=>array();
          $getthumbnail = request("thumbnail");
       if($getthumbnail != null)
       {
        foreach($request->file('thumbnail') as $image)
            {
                                    $exe=$image->getClientOriginalName();
                     $filename = time().'-'.$exe ;
              $getthumnail.= $getbasepath."/public/img/clients/".$filename;
                $image->move(public_path('img/clients'), $filename);

              $d_img[]=$filename;
            }
       }
       else{
        $getthumnail = $request->photo;

       }


        if ($check->count()==0 && $request->p_id==1 || $check->count()==0 && $request->p_id==2) {


         if ($request->p_id==1) {
               $ag=Agency::create([
                'name'=>$request->office_id,
                'des'=>$request->office_id,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'major_area'=>$request->major_area,
                'minor_area'=>$request->minor_area,
                'status'=>1,
                'o_name'=>$request->name,
                'o_contact'=>$request->phone,
            ]);
             # code...
         }
         else{
                $ag=Agency::create([
                'name'=>$request->office_id,
                'des'=>$request->office_id,
                'phone'=>$request->phone,
                 'major_area'=>$request->major_area,
                'minor_area'=>$request->minor_area,
                'email'=>$request->email,
                'address'=>$request->address,
                'status'=>1,
            ]);
         }

            $a_data=Agency::where(['phone'=>$request->phone])->get();
             global $f_id;
          foreach($a_data as $d)
            {
                $f_id=$d->id;
            }
            global $va;
            $va=$request->refferal;

            if ($va=="1") {

               $rew = Ext::create([
                 'user_id'=>$request->user_id,
                'name'=>$request->name,
                'referal_id'=>$request->referal_id,
                'referal_name'=>$request->referal_name,
                'reward'=>$request->reward,
                 ]);
            }



             $user = Client::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'p_id'=>$request->p_id,
            'thumbnail'=>$getthumnail,
            'image'=>json_encode($d_img),
            'd_id'=>$request->d_id,
            'isonline'=>$request->isonline,
            'phone'=>$request->phone,
            'office_id'=>$f_id,
            'u_id'=>$request->u_id,
            'w_id'=>json_encode($w_ids),
            'status'=>0,

        ]);
            $agent =Agent::create([
            'name'=>$request->name,
            'd_id'=>$request->d_id,
            'office_id'=>$f_id,
            'position'=>$request->p_id,
            'phone'=>$request->phone,
            'mobile'=>$request->phone,
            'status'=>1,
            ]);



            return response($getthumnail);
        } else {
global $va;
            $va=$request->refferal;

  if ($va=="1") {

               $rew = Ext::create([
                 'user_id'=>$request->user_id,
                'name'=>$request->name,
                'referal_id'=>$request->referal_id,
                'referal_name'=>$request->referal_name,
                'reward'=>$request->reward,
                 ]);

                 return response()->json($rew);
            }


            $user = Client::create([
            'name'=>$request->name,
            'email'=>$request->email,
             'thumbnail'=>$getthumnail,
            'image'=>json_encode($d_img),
            'office_id'=>$request->office_id,
            'p_id'=>$request->p_id,
            'd_id'=>$request->d_id,
            'isonline'=>$request->isonline,
            'phone'=>$request->phone,
            'u_id'=>$request->u_id,
            'w_id'=>json_encode($w_ids),



        ]);
            $agent =Agent::create([
            'name'=>$request->name,
            'd_id'=>$request->d_id,
            'office_id'=>$request->office_id,
            'position'=>$request->p_id,
            'phone'=>$request->phone,
            'mobile'=>$request->phone,
            'status'=>1,
            ]);


        }

        // $input['password'] = bcrypt($input['password']);
        return response($getthumnail);
        // $success['token'] =  $user->createToken('MyApp')-> accessToken;
        //$success['name'] =  $user->name;

    }

    public function designations()
    {
        $d=Designation::all();

        return json_encode($d);
    }
       public function workingspec()
    {
        $data=Work_T::all();
        return json_encode($data);
    }
    public function positions()
    {
        $p=Position::all();

        return json_encode($p);
    }

    public function new_post(Request $request)
    {


        $chk=Client::where('u_id',$request->user_id)->get();

             global $u_img;
           global $getclientid;
             foreach ($chk as $c) {
                $u_img=$c->thumbnail;
                $getclientid = $c->id;
             }

          $getthumnail = '';
         global $d_img;


        $getbasepath = URL::to('/');
          //$data=>array();
          $getthumbnail = request("thumbnail");
       if($getthumbnail != null)
       {
        foreach($request->file('thumbnail') as $image)
            {
                                    $exe=$image->getClientOriginalName();
                     $filename = time().'-'.$exe ;
              $getthumnail.= $getbasepath."/public/img/properties/".$filename.'umair';
                $image->move(public_path('img/properties'), $filename);
              $d_img[]=$filename;
            }
       }
       else{
        $getthumnail = null;
       }
       // $getid=>$request->user_id;
       //  dd($getid);
       // $c_d=Client::where(['u_id'=>$getid])->get();
       // dd($c_d);
       //umair
$getreward = Ext::where(['referal_id'=>$request->user_id])->first();
if($getreward){

    if($getreward->posted <4)
    {
  $p_value=$getreward->posted;
$p_value++;
$getreward->posted=$p_value;
$getreward->save();
}
else {
    $p_value=$getreward->posted;
    $p_value++;
    $getreward->posted=$p_value;
    $getreward->status=1;
$getreward->save();
}
}



            $main='PKR';
        $pkr=$request->s_price;

      if ($request->s_price==null)
            {
        $pkr= $main;

            }


        $data=Post::create([

            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'phone'=>$request->phone,
            'cat_id'=>$request->cat_id,
            'city'=>$request->city,
            'address'=>$request->address,
            'post_descrip'=>$request->post_descrip,
            'price'=>$request->price,
            'p_type'=>$request->p_type,
            'view_id'=>$request->view_id,
            'corner'=>$request->corner,
            'facing'=>$request->facing,
            'amunities'=>$request->amunities,
            's_price'=>$pkr,
            'apu'=>$request->apu,
            'bath'=>$request->bath,
            'bed'=>$request->bed,
            'post_detail_id'=>$request->post_detail_id,
            'latlng'=>$request->latlng,
            'squ'=>$request->squ,
            'plt'=>$request->plt,
            'status'=>$request->status,
            'p_for'=>$request->p_for,
            'user_image'=>$u_img,
            'listtype'=>$request->listtype,
            'free_txt'=>$request->free_txt,
            'client_id'=>$getclientid,
            'thumbnail'=>$getthumnail,
            // 'image'=>json_encode($d_img),

        ]);


if($request->thumbnail==null && $request->p_type=='Commercial' )
{
     $latlng= $data->latlng;
         $url='https://maps.googleapis.com/maps/api/staticmap?center=latlng&zoom=18&size=640x450&maptype=satellite&markers=icon:https://chhatt.com/StaticMap/Pins/marker3.png|latlng&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU';
         $str = 'latlng' ;
$url_ch = str_replace($str, $latlng, $url) ;

        $url_arr = explode ('/', $url_ch);
        $ct = count($url_arr);
        $name = $url_arr[$ct-1];
        $name_div = explode('.', $name);
        $ct_dot = count($name_div);
        $img_type = $name_div[$ct_dot -1];
        $name = time();

        $destinationPath = public_path().'/img/static/'.$name.'.png';
        file_put_contents($destinationPath, file_get_contents($url_ch));

         $str_half = '/home/rescrrdd/' ;
         $checks='https://';
$url_comp = str_replace($str_half, $checks, $destinationPath) ;

 $comp=$data->id;
 $post=Post::where(['id'=>$comp])->update(['thumbnail'=>$url_comp]);


}
else if($request->thumbnail==null && $request->p_type=='Residential' )
{
     $latlng= $data->latlng;
         $url='https://maps.googleapis.com/maps/api/staticmap?center=latlng&zoom=18&size=640x450&maptype=satellite&markers=icon:https://chhatt.com/StaticMap/Pins/marker4.png|latlng&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU';
         $str = 'latlng' ;
$url_ch = str_replace($str, $latlng, $url) ;

        $url_arr = explode ('/', $url_ch);
        $ct = count($url_arr);
        $name = $url_arr[$ct-1];
        $name_div = explode('.', $name);
        $ct_dot = count($name_div);
        $img_type = $name_div[$ct_dot -1];
        $name = time();

        $destinationPath = public_path().'/img/static/'.$name.'.png';
        file_put_contents($destinationPath, file_get_contents($url_ch));

         $str_half = '/home/rescrrdd/' ;
         $checks='https://';
$url_comp = str_replace($str_half, $checks, $destinationPath) ;

 $comp=$data->id;
 $post=Post::where(['id'=>$comp])->update(['thumbnail'=>$url_comp]);

}

else if($request->thumbnail==null && $request->p_type=='Industrial' )
{
     $latlng= $data->latlng;
         $url='https://maps.googleapis.com/maps/api/staticmap?center=latlng&zoom=18&size=640x450&maptype=satellite&markers=icon:https://chhatt.com/StaticMap/Pins/marker1.png|latlng&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU';
         $str = 'latlng' ;
$url_ch = str_replace($str, $latlng, $url) ;

        $url_arr = explode ('/', $url_ch);
        $ct = count($url_arr);
        $name = $url_arr[$ct-1];
        $name_div = explode('.', $name);
        $ct_dot = count($name_div);
        $img_type = $name_div[$ct_dot -1];
        $name = time();

        $destinationPath = public_path().'/img/static/'.$name.'.png';
        file_put_contents($destinationPath, file_get_contents($url_ch));

         $str_half = '/home/rescrrdd/' ;
         $checks='https://';
         $url_comp = str_replace($str_half, $checks, $destinationPath) ;

         $comp=$data->id;
         $post=Post::where(['id'=>$comp])->update(['thumbnail'=>$url_comp]);

}

        if ($data) {
          return response()->json([$data->id , $data->thumbnail , ]);
        } else {
            return response()->json(['status'=>'failed']);
        }

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

    public function get_users()
    {
        $cdata= Client::all();

        return json_encode($cdata);
    }

    public function get_agency()
    {
        $ag=Agency::where(['status'=>1])->get();
        return json_encode($ag);
    }

    /**
     * Store a newly created resource in storage.
     *whats app ao call py
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
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }

    public function get_pro(Request $request)

        {


         $properties=Post::orderBy('id', 'desc')->paginate(25);
         if(isset($request->id)){
             $properties=Post::where('id',$request->id)->paginate(25);
         }


            return json_encode($properties);
            //umair
            // return response()->json([
            //     'data'=>$properties
            // ]);



    $url='properties';
    $p_type=$request->p_type;
    $Commercial='https://chhatt.com/StaticMap/Pins/marker3.png';
    $Residential='https://chhatt.com/StaticMap/Pins/marker4.png';
    $Industrial='https://chhatt.com/StaticMap/Pins/marker1.png';
#LALA
  if($url != null && $request->p_type == 'Residential')
  {

    $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')
->where(['p_type'=>$p_type ])
->orderBy('id','desc')->get();
 return response()->json(['Data'=>$data, 'Residential'=>$Residential]);

}
elseif($url != null   && $request->p_type == 'Commercial')
  {

    $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')
    ->where(['p_type'=>$p_type ])
    ->orderBy('id','desc')->get();
     return response()->json(['Data'=>$data, 'Commercial'=>$Commercial]);
  }
  elseif($url != null  && $request->p_type == 'Industrial')
  {

    $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')
    ->where(['p_type'=>$p_type ])
    ->orderBy('id','desc')->get();
    return response()->json(['Data'=>$data, 'Industrial'=>$Industrial]);
  }

    }
    // Likes section Start
    public function pro_likes(Request $request)
    {

        $u_id=$request->u_id;
        $p_id=$request->p_id;


        $check=Activity::where(['u_id'=>$u_id,'p_id'=>$p_id])->get();

        $counter=Activity::where(['u_id'=>$u_id,'p_id'=>$p_id])->get()->count();

        $c_d=Client::where(['u_id'=>$u_id])->get();
        global $view;
        global $thumbnail;
        global $office_id;
        global $pos_id;
        global $name;
        global $_id;
        foreach ($check as $c) {

            # code...
            $view=$c;
        }

        foreach ($c_d as $v) {
            # code...
            $thumbnail=$v->thumbnail;
            $office_id=$v->office_id;
            $pos_id=$v->p_id;
            $name=$v->name;
            $_id=$v->id;
        }
        $p_client=CLient::findOrFail($_id);

        if ($p_client->office_id=="") {
            if ($check->count()<1) {
                $like_ok=Activity::create([
                'u_id'=>$u_id,
                'p_id'=>$p_id,
                'likes'=>1,
                'name'=>$name,
                'thumbnail'=>$thumbnail,
            ]);
                return response()->json(['status'=>'1']);
            } else {
                $id=Activity::findOrFail($view->id);

                if ($office_id=="") {
                    if ($check->count()<2) {
                        if ($id->likes==0) {
                            $id->u_id=$u_id;
                            $id->p_id=$p_id;
                            $id->likes=1;
                            $id->save();
                        } else {
                            $id->u_id=$u_id;
                            $id->p_id=$p_id;
                            $id->likes=0;
                            $id->save();
                        }


                        return response()->json(['status'=>'success']);
                    }
                }
            }
        }


        $f_name=Agency::findOrFail($office_id);

        $p_name=Position::findOrFail($pos_id);
        if ($check->count() <1) {
            $like_ok=Activity::create([
                'u_id'=>$u_id,
                'p_id'=>$p_id,
                'likes'=>1,
                'name'=>$name,
                'office_name'=>$f_name->name,
                'p_name'=>$p_name->name,
                'thumbnail'=>$thumbnail,
            ]);


            return response()->json(['status'=>'1']);
        } else {
            $id=Activity::findOrFail($view->id);

            if ($check->count()<2) {
                if ($id->likes==0) {
                    $id->u_id=$u_id;
                    $id->p_id=$p_id;
                    $id->likes=1;
                    $id->save();
                } else {
                    $id->u_id=$u_id;
                    $id->p_id=$p_id;
                    $id->likes=0;
                    $id->save();
                }


                return response()->json(['status'=>'success']);
            }
        }
    }

    public function pro_views(Request $request)
    {
        $u_id=$request->u_id;
        $p_id=$request->p_id;

        $check=Activity::where(['u_id'=>$u_id,'p_id'=>$p_id])->get();

        $counter=Activity::where(['u_id'=>$u_id,'p_id'=>$p_id])->get()->count();

        $c_d=Client::where(['u_id'=>$u_id])->get();
        global $view;
        global $thumbnail;
        global $office_id;
        global $pos_id;
        global $name;
        global $_id;
        foreach ($check as $c) {

                # code...
            $view=$c;
        }

        foreach ($c_d as $v) {
            # code...
            $thumbnail=$v->thumbnail;
            $office_id=$v->office_id;
            $pos_id=$v->p_id;
            $name=$v->name;
            $_id=$v->id;
        }
        $p_client=CLient::findOrFail($_id);

        if ($p_client->office_id=="") {
            if ($check->count()<1) {
                $like_ok=Activity::create([
                    'u_id'=>$u_id,
                    'p_id'=>$p_id,
                    'views'=>1,
                    'name'=>$name,
                    'thumbnail'=>$thumbnail,
                ]);
                return response()->json(['status'=>'1']);
            } else {
                $id=Activity::findOrFail($view->id);

                if ($office_id=="") {
                    if ($check->count()<2) {
                        if ($id->views==1) {
                            $id->u_id=$u_id;
                            $id->p_id=$p_id;
                            $id->views=1;
                            $id->save();
                        } else {
                            $id->u_id=$u_id;
                            $id->p_id=$p_id;
                            $id->views=1;
                            $id->save();
                        }


                        return response()->json(['status'=>'success']);
                    }
                }
            }
        }


        $f_name=Agency::findOrFail($office_id);

        $p_name=Position::findOrFail($pos_id);
        if ($check->count() <1) {
            $like_ok=Activity::create([
                    'u_id'=>$u_id,
                    'p_id'=>$p_id,
                    'Views'=>1,
                    'name'=>$name,
                    'office_name'=>$f_name->name,
                    'p_name'=>$p_name->name,
                    'thumbnail'=>$thumbnail,
                ]);


            return response()->json(['status'=>'1']);
        } else {
            $id=Activity::findOrFail($view->id);

            if ($check->count()<2) {
                if ($id->views==1) {
                    $id->u_id=$u_id;
                    $id->p_id=$p_id;
                    $id->views=1;
                    $id->save();
                } else {
                    $id->u_id=$u_id;
                    $id->p_id=$p_id;
                    $id->views=1;
                    $id->save();
                }


                return response()->json(['status'=>'success']);
            }
        }
    }


    // get count start


    public function get_count(Request $request)
    {


        $PropertySocial=PropertySocial::where('id',$request->p_id)->first();
        return json_encode(['likes'=>$PropertySocial->likes,'views'=>$PropertySocial->views,'eng'=>'1']);
    }

    public function get_likes_list(Request $request)
    {
        $users=Activity::where(['p_id'=>$request->p_id,'likes'=>1])->get();

        return json_encode($users);
    }
    public function views_list(Request $request)
    {
        $views_list=Activity::where(['p_id'=>$request->p_id,'views'=>1])->get();

        return json_encode($views_list);
    }

    public function get_eng_list(Request $request)
    {
        $eng_list=Activity::where(['p_id'=>$request->p_id,'eng'=>1])->get();

        foreach ($eng_list as  $e) {
            # code...

            $users=Client::where(['u_id'=>$e->u_id])->get();
        }

        if ($users->count()>1) {
            return json_encode($users);
        } else {
            return json_encode("0");
        }
    }

    public function profile(Request $request)
    {
        $u_id=$request->u_id;
        $user=User::where(['firebase_id'=>$u_id])->first();

        if($user->agency!=null){
            //  $w_d=json_decode($w_id);
            return response()->json([
                'user'=>[
                    "id"=> $user->id,
                    "u_id"=> $user->firebase_id,
                    "name"=> $user->name,
                    "email"=> $user->email,
                    "phone"=> $user->phone,
                    "thumbnail"=> $user->thumbnail,
                    "office_id"=> optional($user->agency)->id,
                    "p_id"=> $user->role_id,
                    "d_id"=> "1",
                    "isonline"=> null,
                    "status"=> $user->status,
                    "created_at"=> $user->created_at,
                    "updated_at"=> $user->updated_at,
                    "w_id"=> "[\"Bahria Town Karachi expert\"]",
                    "image"=> "[\"".$user->thumbnail."\"]",
                    "rew"=> 0
                ],

                'office_info'=>[
                    "name"=> optional($user->agency)->name,
                    "u_id"=> $user->address,
                    "name"=> $user->phone,
                    "totalagent"=> optional($user->agency->agents)->count(),

                ],

                ]);

            }
            else{
                return response()->json([
                    'user'=>[
                        "id"=> $user->id,
                        "u_id"=> $user->firebase_id,
                        "name"=> $user->name,
                        "email"=> $user->email,
                        "phone"=> $user->phone,
                        "thumbnail"=> $user->thumbnail,
                        "office_id"=> optional($user->agency)->id,
                        "p_id"=> $user->role_id,
                        "d_id"=> "1",
                        "isonline"=> null,
                        "status"=> $user->status,
                        "created_at"=> $user->created_at,
                        "updated_at"=> $user->updated_at,
                        "w_id"=> "[\"Bahria Town Karachi expert\"]",
                        "image"=> "[\"".$user->thumbnail."\"]",
                        "rew"=> 0
                    ],

                    'office_info'=>[
                        "name"=> null,
                        "u_id"=> $user->address,
                        "name"=> $user->phone,
                        "totalagent"=> null,

                    ],
                    'designations'=>$user

                    ]);
            }

    }
    public function Search(Request $request)
    {
        $bath=$request->bath;
        $bed=$request->bed;
        $city=$request->city;
        $address=$request->address;
        $price=$request->price;
        $p_type=$request->p_type;
        $p_for=$request->p_for;

        $data=Post::where(['bath'=>$bath,'bed'=>$bed,'city'=>$city,'address'=>$address,'price'=>$price,'p_type'=>$p_type,'p_for'=>$p_for])->get();

        dd($data);
    }


      public function upload(Request $request){

        $getthumnail = '';
        $getbasepath = URL::to('/');
          //$data=>array();
foreach($request->file('thumbnail') as $image)
            {


                                    $exe=$image->getClientOriginalName();
                     $filename = time().'-.'.$exe ;
                    $getthumnail.= $getbasepath."/public/img/properties/".$filename.'umair';


                $image->move(public_path('img/properties'), $filename);
              $d_img[]=$filename;
            }


          return json_encode($getthumnail);

   // $d_img=request('thumbnail');




        //  for ($a=0; $a<=2; $a++){



        //             $exe=$image->getClientOriginalName();
        //              $filename = time().'-.'.$exe ;

        //         $image->move(public_path('img/properties'), $filename);
        //       $d_img[]=$filename;
        //     }




    }

    public function sea()
    {

        //1122
        //Reservation::whereBetween('reservation_from', [$from, $to])->get();
        //$results=DB::t
        //able('posts');
        $results = Post::with('post')->latest();
        $min = request("min");
        $max = request("max");
        $minarea = request("minarea");
        $maxarea= request("maxarea");
        $bed = request("bed");
        $bath = request("bath");
        $city = request("city");
        $price = request("price");
        $p_type = request("p_type");
        $p_type2 = request("p_type2");
        $p_for = request("p_for");
        $listtype = request("listtype");
        $location= request("address");
        $city = request("city");
        $post_detail_id=request("post_detail_id");




          if ($listtype!=null) {
            $results = Post::join('post_details','posts.post_detail_id','post_details.id')->where(['listtype'=>$listtype])->select('posts.*','post_details.major_area','post_details.minor_area');
        }


         if($location != null){
          //$results->where('address', 'LIKE', '%'.$location.'%')->where('city', 'LIKE', '%'.$city.'%');
               $p_ids=(explode(",",$location));
              // dd($p_ids[1]);
            $results->where('post_details.major_area',$p_ids[1])->where('post_details.minor_area',$p_ids[0]);
            // return $results->get();


        }


        if($minarea != null){

         $results->whereBetween('plt', [$minarea, $maxarea]);
        }

        if($min!=null || $max!=null){
         $results->whereBetween('price', [$min, $max]);
        }

        if ($bath!=null) {
            $results->where(['bath'=>$bath]);
        }
        if ($bed!=null) {
            $results->where(['bed'=>$bed]);
        }
        if ($city!=null) {
            $results->where(['city'=>$city]);
        }
        if ($price!=null) {
            $results->where(['price'=>$price]);
        }
        if ($post_detail_id!=null && $location == "null") {
            $results->where(['post_detail_id'=>$post_detail_id]);
        }
        if ($p_type!=null) {

       $p_ids=(explode(",",$p_type));



            $results->where('p_type',$p_type2)->whereIn('cat_id',$p_ids);

        }

        if ($p_for!=null) {
            $results->where(['p_for'=>$p_for]);
        }
        $results->where(['status'=>'1']);
        // $results->put('major_area',$results->post)
        // dd($results->get());
        return json_encode($results->get());

    }
    # code...



     public function a_agent()
    {

        // $data=Agent::where(['office_id'=>$request->office_id,'status'=>1])->get();

        //$client=Client::where(['office_id'=>$request->office_id])->get();
          //    global $f_id;
          // foreach($client as $d)
          //   {
          //       $f_id[]=$d->u_id;
          //   }
          //    global $f_id;
          //   foreach($f_id as $data){
          //       $count[]=Post::where('user_id',$data)->get()->count();
          //   }

    //      $prod=DB::table('posts')
    //  ->join('clients', 'clients.office_id',   '=', 'posts.office_id')
    // ->select('clients.name', 'clients.phone', 'clients.email')->
    //     get()
global $getoffice_id;
        if(request('office_id') == null){
        $check=Agency::where(['name'=>$request->office_name,'status'=>1])->get();
        foreach ($check as $key ) {
            $getoffice_id = $key->id;
        }
    }
    else{
$getoffice_id = request('office_id') ;
    }

$prod=DB::select("select client_id,COUNT(*) as 'total' ,c.name as 'name',c.thumbnail as 'thumbnail',c.phone as 'phone', c.u_id ,p.id

from posts p
JOIN clients c ON p.client_id =c.id
Where p.status='1' && c.office_id=$getoffice_id
GROUP  BY client_id",[1]);

 $cost= DB::select("SELECT  m.name, m.phone, m.thumbnail, m.u_id
FROM    clients m
JOIN    agents o
ON      o.office_id = m.office_id
WHERE  m.office_id = $getoffice_id
GROUP BY name",[1]);

  $users=Agency::where(['id'=>$getoffice_id])->get(['name','o_name','o_contact','address','major_area','minor_area','location','phone','verified','thumbnail']);


        return json_encode(['Post'=>$prod , 'Agent'=>$cost , 'Agency'=>$users]);


    }
    public function s_Data(Request $request)
    {
        $data=Post::where(['bed'=>$request->bed,'bath'=>$request->bath])->Orwhere(['p_type'=>$request->p_type,'p_for'=>$request->p_for])->get();

        return json_encode($data);

    }
    public function m_post(Request $request)
  {
   // $data=Post::where(['user_id'->$request])->get();
    $data=Post::where(['user_id'=>$request->user_id])->get();
    return json_encode($data);
}

 public function ag_data(Request $request){

        $data=Client::where(['office_id'=>$request->office_id])->get();

       return json_encode($data);
 }

    public function u_likes(Request $request){

        $g_id=$request->p_id;

       $p_ids=(explode(" ",$g_id));

       $data=Post::whereIn('id', $p_ids)->get();


       return json_encode($data);
     //   $data=Activity::where(['u_id'=>])

    }
     public function pid(Request $request){

        $id=$request->u_id;
        $p_id = $request->p_id;
        $d_id = $request->d_id;
        $oid = $request->office_id;

   //      $data=Client::findOrFail($id)->update(
   // ['office_id' => $request->office_id,
   // 'd_id' => $request->d_id,'p_id' => $request->p_id,]);
        Client::where('u_id', $id)->update(array('p_id' =>  $p_id,'d_id' =>  $d_id,'office_id' =>  $oid));

}
    public function file(Request $request){
        $fileName="user_image.jpg";
        $path=$request->file('photo')->move(public_path("/img/properties/"), $fileName);
        $photoURL= url('/img/peoperties/'.$fileName);
        return response()->json(['url'=> $photoURL],200);
    }

        public function getname(Request $request)
   {

        $data=Client::findOrFail($request->id);
        if ($request->widcount != "null") {
         $w_ids=(explode(",",$request->w_id));
        }
        else{
            $ag=Work_T::create([
                'name'=>$request->w_id,
            ]);


        $w_ids=(explode(",",$request->w_id));



        }

          $data->name=$request->name;
          $data->thumbnail=$request->thumbnail;


          $data->d_id=$request->d_id;
          $data->email=$request->email;


          if($request->office_id != "null"){
                $data->office_id=$request->office_id;

          }
          else{

             $ag=Agency::create([
                'name'=>$request->cname,
                'des'=>$request->cname,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->caddres,
                'status'=>1,
            ]);
                $a_data=Agency::where(['phone'=>$request->phone])->get();
                global $f_id;
          foreach($a_data as $d)
            {
                $f_id=$d->id;
                $data->office_id=$f_id;

            }

          // Client::where(['phone'=>$request->phone])->update(['office_id' => $f_id]);
          }
           $posts=Post::where('user_id',$request->u_id)->update
         (array('user_image'=>$request->thumbnail));

          $data->w_id=json_encode($w_ids);
          $data->p_id=$request->p_id;
            $data->save();
              return json_encode($data);

   }
   public function getstat(Request $request)
   {
             $id=$request->id;
       $data=Post::findOrFail($id);

        $data->status=$request->status;

        $data->save();
        return json_encode($data);

   }
    public function propid(Request $request)
   {
       $data=Post::findOrFail($id);
       $data=Post::all();
   }
    public function chk_id(Request $request)
   {

             $phone=$request->phone;
        // $client=Client::where(['phone'=>$phone])->get(['name','office_id','phone','thumbnail','p_id','d_id','u_id','w_id']);


         $latlong=DB::table('agencies')
    ->join('clients', 'clients.office_id',   '=', 'agencies.id')
    ->where( 'clients.phone',   '=', $phone)
     ->select('clients.name','clients.office_id','clients.phone','clients.thumbnail','clients.p_id','clients.d_id','clients.u_id','clients.w_id','agencies.name as com_name')
     ->get();

        //umairali

    //  $client=DB::table('clients')
       // ->where('name', 'John')
    //  ->leftjoin('agencies', 'agencies.id',   '=', 'clients.office_id')
    //  ->where('phone', '=', $phone)
    // ->select('agencies.id as agencyname' , 'clients.*' )
    // ->get();
         //        global $office_id;
         //     foreach ($client as $c) {
         //        $office_id=$c->office_id;
         //    }
         // $agency=Agency::where(['id'=>$office_id])->get('name');

         return json_encode($latlong);

    }
     public function maps(Request $request)
   {

       $all_data = Map::all();

$compiled_data = array();

foreach ($all_data as $data)
{
$compiled_data[$data['city']][$data['major_area']] [$data['minor_area']] [] =
[$data['location'], 'name' => $data['name'],  'thumbnail' => $data['thumbnail']];

}

 return json_encode($compiled_data);

}

 public function sub(Request $request)
   {

    $forcity=[];


    foreach (Agency::all() as $major_area)  {

        // $forcity[] = ([ $major_area->city, $major_area->major_area  ]);
        $forcity = array($major_area->city, $major_area->major_area);

       if (in_array($major_area->city, $forcity)) {

         $forcity[] = [
                'Major_Area' => $major_area->major_area,
            '' => [
                'Minor_Area' => $major_area->minor_area,
            '' => [
                'Location' => $major_area->location,
        ' ' => [
                'Agency Name' => $major_area->name
            ]]]
        ];
  }
    }
//    $result = [];
// foreach (Agency::all() as $user) {
//   $result[] = [
//              'City' => $user->city,
//         'Major' => [
//                 'Major_Area' => $user->major_area,
//             'Minor' => [
//                 'Minor_Area' => $user->minor_area,
//             'Location' => [
//                 'Location' => $user->location,
//         'Agency' => [
//                 'Name' => $user->name
//             ]]]]
//         ];
// }

return json_encode($forcity);
}
 public function agencies(Request $request)
   {

       $data=Agency::all();
       return json_encode($data);
   }




   public function actionCheck(){

$all_data = Agency::groupBy('minor_area','name')->get();

$compiled_data = array();

foreach ($all_data as $data){
//     if ($data->location == null) {
// $compiled_data[$data['city']][$data['major_area']]
// [$data['minor_area']][] = ['id' => $data['id'], 'name' => $data['name']];
//         # code...
//     }
//     else{
        $compiled_data[$data['city']][$data['major_area']]
[$data['minor_area']][$data['location']][] = ['id' => $data['id'], 'name' => $data['name'], 'city' => $data['city'], 'major_area' => $data['major_area']];
    // }

}



 return json_encode($compiled_data);



}
public function listmaps(Request $request)
   {

    $data=Map::paginate(10);
       return json_encode($data);
   }
   public function reward(Request $request)
   {

       $ext=Ext::create([
                'user_id'=>$request->user_id,
                'name'=>$request->name,
                'referal_id'=>$request->referal_id,
                'referal_name'=>$request->referal_name,
                'reward'=>$request->reward,

            ]);
       return json_encode($ext);
   }
    public function area_cat(Request $request)
   {

       $area=Area_cat::all();
       return json_encode($area);
   }


    public function mob_data(Request $request)
   {
      $a_data = $request->ages;
      // $number = $request->paramnumber;

      // $count = count($a_data);
      foreach ($variable as $key) {
      $getexplode = explode(",",$key);

                          $reward=Reward::create([
                'cs_name'=>$getexplode[0],
                'cs_number'=>$getexplode[1],

            ]);
          # code...
      }

       // for($a = 0; $a<$count; $a++){
       //               $reward=Reward::create([
       //          'cs_name'=>$a_data[$a],
       //          'cs_number'=>"fhgfhfgh",


       //      ]);

       // }

      return json_encode($reward);
   }

  public function plot_cat(Request $request)
   {

       $plot=Plot_cat::all();
       return json_encode($plot);
   }


    public function plot_det(Request $request)
   {


        $getdata = $request->getcat;



      $cat=Plot_cat::where(['s_no'=>$request->s_no])->get($getdata);


        return json_encode($cat);

   }
 public function posted(Request $request)
   {


     $approve=Ext::where('posted', '=', 5)->get();
     $nonapprove=Ext::where('posted', '<', 5)->get();

     return json_encode([ 'Approved' => $approve , 'NonApproved' => $nonapprove ]);


   }
     public function postbyid(Request $request)
   {


    $data=Post::where(['id'=>$request->id])->get();

    return json_encode($data);

   }
   public function postEdit(Request $request)
{

 $post=Post::find($request->id);

          global   $getthumnail;
          global $d_img;
          global $oldimg;
           global $resultthumb;
          global $resultimg;

    $oldimg=$request->oldimg;
        $getbasepath = URL::to('/');
          //$data=>array();
          $getthumbnail = request("thumbnail");

         if($getthumbnail != null){
                foreach($request->file('thumbnail') as $image)
            {
                 $exe=$image->getClientOriginalName();
                     $filename = time().'-'.$exe ;
              $getthumnail.= $getbasepath."/public/img/properties/".$filename.'umair';
                $image->move(public_path('img/properties'), $filename);
              $d_img[]=$filename;
            }
         }


           if($oldimg!="")
       {
        $d_img=$request->image;
        $resultthumb= $oldimg . $getthumnail;
        $resultimg= $oldimg . $d_img;
        $post->city=$request->city;
        $post->address=$request->address;
        $post->phone=$request->phone;
        $post->squ=$request->squ;
        $post->post_descrip=$request->post_descrip;
        $post->apu=$request->apu;
        $post->plt=$request->plt;
        $post->bed=$request->bed;
        $post->bath=$request->bath;
        $post->latlng=$request->latlng;
        $post->listtype=$request->listtype;
        $post->cat_id=$request->cat_id;
        $post->p_for=$request->p_for;
        $post->p_type=$request->p_type;
        $post->price=$request->price;
        $post->s_price=$request->s_price;
        $post->amunities=$request->amunities;
        $post->thumbnail=$resultthumb;
        $post->image=$resultimg;
        }
        else
        {
        $post->city=$request->city;
        $post->address=$request->address;
        $post->phone=$request->phone;
        $post->squ=$request->squ;
        $post->post_descrip=$request->post_descrip;
        $post->apu=$request->apu;
        $post->plt=$request->plt;
        $post->bed=$request->bed;
        $post->bath=$request->bath;
        $post->latlng=$request->latlng;
        $post->listtype=$request->listtype;
        $post->cat_id=$request->cat_id;
        $post->p_for=$request->p_for;
        $post->p_type=$request->p_type;
        $post->price=$request->price;
        $post->s_price=$request->s_price;
        $post->amunities=$request->amunities;
            if($request->thumbnail!=""){
        $post->thumbnail=$getthumnail;
        }
        if($request->image!=""){
        $post->image=json_encode($d_img);
        }
        }

        $post->save();

     }
     public function globsearch(Request $request)
   {
    $inp=$request->inp;


    if($inp!="")
    {
    $filter = DB::table('agencies')->where('name','LIKE','%'.$inp.'%')->orWhere('o_name','LIKE','%'.$inp.'%')->orWhere('address','LIKE','%'.$inp.'%')->orWhere('minor_area','LIKE','%'.$inp.'%')
    ->orWhere('major_area','LIKE','%'.$inp.'%')->orWhere('o_contact','LIKE','%'.$inp.'%')->get();

    }
    return json_encode($filter);
      }


      public function globsearchmap(Request $request)
   {
    $inp=$request->inp;

    if($inp!="")
    {
$filter = DB::table('agencies')
->where('city','LIKE','%'.$inp.'%')
->orWhere('major_area','LIKE','%'.$inp.'%')
->orWhere('minor_area','LIKE','%'.$inp.'%')
->orWhere('location','LIKE','%'.$inp.'%')
    ->get();

    }
    return json_encode($filter);
   }
public function AgencyVerf(Request $request)
   {


    $verf=Agency::where(['id'=>$request->id])->update(['verified'=>1]);

    return json_encode($verf);

   }
   public function Softdelete(Request $request)
   {


    $verf=Post::where(['id'=>$request->id])->update(['soft_delete'=>1]);

    return json_encode($verf);

   }
public function SearchSpec(Request $request)
   {
    $inp=$request->inp;
    $client=DB::table('clients')
     ->rightjoin('designations', 'designations.id',   '=', 'clients.d_id')
     ->rightjoin('positions', 'positions.id',   '=', 'clients.p_id')
      ->rightjoin('agencies', 'agencies.id',   '=', 'clients.office_id')
     ->where('designations.name', '=', $inp)
    ->select('clients.name as Name' ,'clients.email as Email' ,'clients.u_id as FireBaseID','clients.thumbnail as Thumbnail' ,'agencies.name as Agency' ,'designations.name as workingspec','positions.name as Position'  )
    ->get();
//    $prod=DB::table('clients')
// ->join('designations', function($join)
// {
//     $join->on('clients.d_id', '=', 'designations.id')
//     ->on('clients.p_id','=','positions.id');
// })
// ->where('designations.name', '=', $inp )
// ->select('designations.name as Speciality','positions.name as Speciality','clients.name as Name' ,'clients.thumbnail as Thumb','clients.email as Email')
//  ->get();

    //  $client=DB::table('clients')
    // ->leftjoin('designations', 'designations.id', '=', 'followers.follower_id')
    //     ->leftjoin('positions', 'positions.id',   '=', 'clients.p_id')
    //     ->where('users.id','=', $inp)
    //     ->get();
    return json_encode($client);

   }
public function MajMinor(Request $request)
   {
    $city=$request->city;

$users = DB::table('posts')
            ->select('major_area', 'minor_area','latlng')
            ->where('city','=',$city)
            ->whereNotNull('minor_area')
            ->groupBy('city','major_area')
            ->get();
          return json_encode($users);

        }
public function setoffice()
{

//$roles = DB::table('clients')->pluck()->all();


$tab=Client::all();

 foreach ($tab as $role){

  $office= Post::where(['user_id'=>$role->u_id])->update(['office_id'=>$role->office_id]);

}
}
  public function pdf(Request $request)
    {

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('/storage/files/uploads'), $fileName);

        $state=State::create([
                'file'=>$fileName,

            ]);
        return response()->json(['Status'=>'Success']);
  }

   public function up_postdetails(Request $request)
    {
  $getpost = Post_detail::all();
foreach ($getpost as $key)
{

    $getmaj=$key->id;

    $update = Post::where(['major_area'=>$key->major_area,'minor_area'=>$key->minor_area])->update(array
    ('post_detail_id'=>$getmaj));
}
}


  public function getvaluation(Request $request){
    $getcatmajor = $request->catmajor;
    $getcat_minor = $request->cat_minor;
    $getserialno = $request->serialno;
    $getarea = $request->area;


     $getcat= DB::select("SELECT  $getcatmajor
FROM    area_cats
WHERE serial_no = $getserialno");
    $get = $getcat[0];
    $getl = $get->$getcatmajor;



    $getval= DB::select("SELECT  $getcat_minor
FROM    plot_cats
WHERE s_no = '$getl'");
$getactual = $getval[0];
$getactual->$getcat_minor;



$int = (int)$getactual->$getcat_minor;
//$total = $getactual * 3;
return json_encode($int*$getarea);


}
 public function get_paginated_pro()
    {
        $pro=Post::orderBy('id', 'desc')
        ->where(['status'=>1])
        ->paginate(10);

    // $pro=ModelName::whereRaw('self', '!=', true')->get();

        return json_encode($pro);
    }
     public function temporary()
 {

$all_data = Agency::groupBy('minor_area','name')->get();

$compiled_data = array();

foreach ($all_data as $data){
    if ($data->location == null) {
$compiled_data[$data['city']][$data['major_area']]
[$data['minor_area']] = ['id' => $data['id'], 'name' => $data['name']];
        # code...
    }
    else{
        $compiled_data[$data['city']][$data['major_area']]
[$data['minor_area']][$data['location']][] = ['id' => $data['id'], 'name' => $data['name']];
    }

}



 return json_encode($compiled_data);
}

   // REACT  UI
public function agencyformsg(Request $request)
   {
     $minor_area= $request->minor_area;
       $city=$request->city;
       $major_area=$request->major_area;

     $latlong=DB::table('agencies')
    ->join('clients', 'clients.office_id',   '=', 'agencies.id')
    ->where( 'city',   '=', $city)
    ->where( 'minor_area',   '=', $minor_area)
    ->where( 'p_id',   '=', 2)
    ->where( 'major_area',   '=', $major_area)
     ->select('clients.*','agencies.name as agencyname','agencies.address')
     ->get();
     $check=count($latlong);

if($check===0)
{
    $here=DB::table('agencies')
    ->join('clients', 'clients.office_id',   '=', 'agencies.id')
    ->where( 'major_area',   '=', $major_area)
    ->where( 'p_id',   '=', 2)
     ->select('clients.*','agencies.name as agencyname','agencies.address')
     ->get();

     return json_encode(['Agencies'=>$here]);
}

    // $latlong=DB:('agencies')
    // ->join('clients', 'clients.office_id','=', 'agencies.id')
    //  ->where(['major_area'=>$request->major_area])->where(['minor_area'=>$request->minor_area])->where(['city'=>$request->city])
    //  ->select('agencies.*','clients.*')->get();
       return json_encode(['Agencies'=>$latlong]);
   }
 public function latlong(Request $request)
   {


       $latlong=Post::where('status', '=', 1)->get(['id','address', 'latlng','status']);
       return json_encode(['latlong'=>$latlong]);
   }

public function nearprop(Request $request)
   {
//lala
$latitudeFrom = $request->latitudeFrom;
$longitudeFrom = $request->longitudeFrom;
$earthRadius= 6371000;

$data=Post::where(['status'=>1])->orderBy('id','desc')->get();
foreach ($data as $da => $val)
{

  $latlng=$val->latlng;
    $address=$val->address;

   $lat=(explode(",",$latlng));

  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($lat[0]);
  $lonTo = deg2rad($lat[1]);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  $date = $angle * $earthRadius;
  if ($date< 500) {
    $distribute[] = $val;
  }


    }

   return ($distribute);




// The index page.






     //haha


      }
//     return json_encode($prop);



public function allareas(Request $request)
   {

    $data=Area::all();
    return json_encode($data);

   }

    public function post_allmarker(Request $request)
    {
        $url='properties';
   $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')
   ->select('id', 'latlng', 'address','p_type')
->orderBy('id','desc')->get();

   return json_encode($data);
    }
   public function post_marker(Request $request)
   {
   $url='properties';
   $p_type=$request->p_type;
   $Commercial='https://chhatt.com/StaticMap/Pins/marker3.png';
   $Residential='https://chhatt.com/StaticMap/Pins/marker4.png';
   $Industrial='https://chhatt.com/StaticMap/Pins/marker1.png';
#LALA
 if($url != null && $request->p_type == 'Residential')
 {

   $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')
->where(['p_type'=>$p_type ])
->select('id', 'latlng', 'address','p_type')
->orderBy('id','desc')->get();
return response()->json(['Data'=>$data, 'Residential'=>$Residential]);

}
elseif($url != null   && $request->p_type == 'Commercial')
 {

   $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')
   ->where(['p_type'=>$p_type ])
   ->select('id', 'latlng', 'address','p_type')
   ->orderBy('id','desc')->get();
    return response()->json(['Data'=>$data, 'Commercial'=>$Commercial]);
 }
 elseif($url != null  && $request->p_type == 'Industrial')
 {

   $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')
   ->where(['p_type'=>$p_type ])
   ->select('id', 'latlng', 'address','p_type')
   ->orderBy('id','desc')->get();
   return response()->json(['Data'=>$data, 'Industrial'=>$Industrial]);
 }
}

public function agencyarea(Request $request)
   {

       $data=Agency::orderBy('major_area', 'desc')->get('major_area','minor_area','address');
       return json_encode($data);
   }
   public function post_majorminor(Request $request)
   {
    $ps=DB::table('posts')
    ->join('post_details', 'post_details.id',   '=', 'posts.post_detail_id')
    ->where( 'status',   '=', 1)
     ->select('posts.*','post_details.*')
     ->get();
       return json_encode($ps);
   }
   public function postdetail_majorminor(Request $request)
   {

    $data=Post_detail::all();
    return json_encode($data);
   }

 public function postcard(Request $request)
   {
    $url='properties';
  if($url != null)
  {
    $staticimg='https://www.chhatt.com/StaticMap/319691231070000pm.png';
    $data1=Post::where('thumbnail','!=',$staticimg)->limit(5)->get();
    $data=Post::where('status', '=', 1)->where('thumbnail', 'LIKE', '%'.$url.'%')->orderBy('id','desc')->inRandomOrder()->get();
    $data1->merge($data);
  }
    return json_encode($data);
}

    public function postdetail(Request $request)
   {
    $data=Post::where(['id'=>$request->id, 'status'=>'1'])->get();
    return json_encode($data);

   }


   public function relatedPostOnApp(Request $request)
   {

       $p_type= $request->p_type;
       $p_for= $request->p_for;
       $cat_id=$request->cat_id;
       $city= $request->city;
       $price =$request->price;
       $address =$request->address;
       $pr='90000000';

    if($p_type!="" && $p_for!="" && $city!="" && $price!="" && $address!="" && $cat_id!="")
    {
    $data = DB::table('posts')->where('p_type','LIKE','%'.$p_type.'%')->where('p_for','LIKE','%'.$p_for.'%')->orwhere('cat_id','LIKE','%'.$cat_id.'%')
    ->orwhere('city','LIKE','%'.$city.'%')->whereBetween('price', [$price, $pr])->orwhere('address','LIKE','%'.$address.'%')
    ->where('status', 1)->limit(3)->get();

    return json_encode($data);
    }
    else
    {
       $chk= Post::where(['status'=>1])->orderBy('id','desc')->limit(3)->get();
       return json_encode($chk);
    }

}
    public function relatedPost(Request $request)
   {

       $p_type= $request->p_type;
       $p_for= $request->p_for;
       $city= $request->city;
       $cat_id= $request->cat_id;
        $thumb='properties';

    if($p_type!="" && $p_for!="" && $city!="" && $cat_id!="")
    {
    $data = DB::table('posts')->where('p_type','LIKE','%'.$p_type.'%')->where('p_for','LIKE','%'.$p_for.'%')->where('city','LIKE','%'.$city.'%')->where('cat_id','LIKE','%'.$cat_id.'%')->where('thumbnail','LIKE','%'.$thumb.'%')
    ->where('status', 1)->inRandomOrder()->paginate(10);
    }

else
{
   $data=Post::where('status', '=', '1')->where('thumbnail', 'LIKE', '%'.$thumb.'%')->get();
}

    return json_encode($data);

   }

   public function allcount(Request $request)
   {
       $data='No data found';
    $my_post=$request->my_post;
    $my_fav_post=$request->my_fav_post;
    $my_team=$request->my_team;
    $nearby_post=$request->nearby_post;
    $agency_dir=$request->agency_dir;
    $map=$request->map;
    $valuation_calculator=$request->valuation_calculator;
    $searh_post=$request->searh_post;
if($my_post=="my_post")
{
    $data=Click::where(['attribute_id'=>$my_post])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
elseif($my_fav_post=="my_fav_post")
{
    $data=Click::where(['attribute_id'=>$my_fav_post])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
elseif($my_team=="my_team")
{
    $data=Click::where(['attribute_id'=>$my_team])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
elseif($nearby_post=="nearby_post")
{
    $data=Click::where(['attribute_id'=>$nearby_post])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
elseif($agency_dir=="agency_dir")
{
    $data=Click::where(['attribute_id'=>$agency_dir])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
elseif($map=="my_fav_post")
{
    $data=Click::where(['attribute_id'=>$map])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
elseif($valuation_calculator=="valuation_calculator")
{
    $data=Click::where(['attribute_id'=>$valuation_calculator])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
elseif($searh_post=="searh_post")
{
    $data=Click::where(['attribute_id'=>$searh_post])->increment('count',1);
    return response()->json(['Post'=>'Seen By User']);
}
else
{
    return json_encode($data);

}
   }
public function UImaps(Request $request)
   {

       $all_data = Map::all();

$compiled_data = array();

foreach ($all_data as $data)
{
$compiled_data[$data['city']][][$data['major_area']]  [] =
[$data['major_area'], 'location' => $data['location'],  'image' => $data['image']];

}
    return response()->json(['Cities'=>$compiled_data]);

}
public function get_agency_details()
    {


    //      $prod=DB::table('agencies')
    //  ->leftjoin('clients', 'clients.office_id',   '=', 'agencies.id')->where(['p_id'=>'1'])
    // ->select('clients.thumbnail as image', 'agencies.*')->
    //     get();

$prod=DB::table('agencies')
->leftjoin('clients', function($join)
{
    $join->on('clients.office_id', '=', 'agencies.id');
})
->where('agencies.thumbnail', '!=', null )
->where('agencies.verified', '=', '1' )
->where('clients.p_id', '=', '1' )
->select('clients.thumbnail as image' ,'clients.office_id as office_id','clients.p_id as position    ','agencies.*')
 ->paginate(10);

        return json_encode($prod);
    }
    public function Mapbyid(Request $request)
   {
     $id=$request->id;
     $data=Map::where(['id'=>$id])->get();


    return json_encode($data);

}

// SELECT agencies.id, agencies.name, agencies.created_at, agencies.address, agencies.location, agencies.minor_area, agencies.major_area, agencies.city, clients.office_id, clients.name, clients.created_at
// FROM agencies
// INNER JOIN clients ON agencies.id= clients.office_id
// WHERE agencies.created_at BETWEEN '2020-02-01 00:00:00' AND '2020-02-01 23:59:59'

public function add(Request $request)
{

     $client=DB::table('clients')
     ->leftjoin('positions', 'positions.id',   '=', 'clients.p_id')
      ->leftjoin('agencies', 'agencies.id',   '=', 'clients.office_id')
      ->whereBetween('clients.created_at', ['2020-02-01 00:00:00', '2020-02-01 23:59:59'])
      ->select('clients.*','positions.name as check','agencies.name as agencyname', DB::raw("count(clients.created_at) as count"))
      ->groupBy('clients.id')
      ->get();
       $clients=DB::table('clients')
     ->leftjoin('positions', 'positions.id',   '=', 'clients.p_id')
      ->leftjoin('agencies', 'agencies.id',   '=', 'clients.office_id')
      ->whereBetween('clients.created_at', ['2020-02-01 00:00:00', '2020-02-01 23:59:59'])
      ->select('clients.id', DB::raw("count(clients.created_at) as count"))
      ->get();

        return response()->json(['data'=>$client,'count'=>$clients]);
}

public function allPostCities(Request $request)
{
$data=DB::table('posts')
            ->select('city')
            ->distinct()->get();
            return json_encode($data);
}
public function PostDetailByCity(Request $request)
{
    $city=$request->city;
    $data=Post_detail::where(['city'=>$city])->get();
    return json_encode($data);
}

public function staticmap(Request $request)
{
        $url = "https://maps.googleapis.com/maps/api/staticmap?center=24.8707771,67.07421990000002&maptype=hybrid&zoom=18&size=500x400&maptype=roadmap&markers=color:red%7Clabel:C%7C24.8707771,67.07421990000002&key=AIzaSyAAdMS03mAk6qDSf4HUmZmcjvSkiSN7jIU";
        $url_arr = explode ('/', $url);
        $ct = count($url_arr);
        $name = $url_arr[$ct-1];
        $name_div = explode('.', $name);
        $ct_dot = count($name_div);
        $img_type = $name_div[$ct_dot -1];
        $name = time();

        $destinationPath = public_path().'/img/static/'.$name.'.png';
        file_put_contents($destinationPath, file_get_contents($url));

$search = '/home/rescrrdd/' ;
$trimmed = str_replace($search, 'https://', $destinationPath) ;
        dd($trimmed);

}
public function UIpostEdit(Request $request) {
    $post=Post::find($request->id);
   $post->major_area=$request->major_area;
   $post->minor_area=$request->minor_area;

    $post->post_detail_id=$request->post_detail_id;
   $post->save();
    return response()->json($post);
}
public function UIgetpost(Request $request) {
    $post=DB::table('posts')
            ->whereNull('post_detail_id')->take(10)->get();


    return response()->json($post);
}
public function UIgetpostdetail(Request $request) {

            $users = DB::table('post_details')
            ->select("*",
            DB::raw("CONCAT(post_details.major_area,'-',post_details.minor_area,'-',post_details.id) AS concatenated"))
        ->get();


    return response()->json($users);
}
public function PostSold(Request $request)
   {

    $verf=Post::where(['id'=>$request->id])->update(['post_sold'=>1]);

    return json_encode($verf);

   }


public function UIcreatePostdetail(Request $request) {

    $data=Post_detail::create([
                'city'=>$request->city,
                'latlng'=>$request->latlng,
                'major_area'=>$request->major_area,
                'minor_area'=>$request->minor_area,
            ]);
    return json_encode($data);
}


public function user_properties(Request $request) {

    $data=Post::where(['User_id'=>$request->user_id])->where('soft_delete', 0)->orderBy('id','desc')->get();
    $users = Client::where('u_id', $request->user_id)->get();
    // return json_encode($data, $users);

    return response()->json(array($data, $users));
}
//API made by Akash
public function globalSearch(Request $request) {

	$results = Agency::latest();
	$agency = $request->name;
	$owner = $request->o_name;
	$major = $request->major_area;
	$minor = $request->minor_area;
    $phone = $request->phone;

    $results = Agency::where('name', 'LIKE', '%'.$agency.'%')
    ->where('o_name', 'LIKE', '%'.$owner.'%')
    ->where('major_area', 'LIKE', '%'.$major.'%')
    ->where('minor_area', 'LIKE', '%'.$minor.'%')
    ->where('phone', 'LIKE', '%'.$phone.'%')
    ->get();

    return response()->json(['Agency: ' => $results]);
}
public function post_details_major(Request $request)
{

    $data = Post_detail::where(['major_area'=>$request->major])->get();
    return $data;
}

//API made by Akash
public function userSearch(Request $request) {
    $q = $request->get('query');
    //where('votes', 100)
    // $data = Client::where('name', 'like', '%' . $q . '%')
    $data = Client::where('name', $q)
    // ->orwhere('id', $q)
    ->get();

    return response()->json($data);
}

//API made by Akash
public function cityCount()
{

    $data = DB::table('posts')
    ->select(DB::raw('COUNT(city) as total'),'city')
    ->groupBy('city')
    ->get();

    return $data;
}
public function post_click(Request $request)
{
    $id=$request->id;
    $click=Post::where(['id'=>$id])->increment('post_click', 1);

    return response()->json(['Property'=>'Seen By User']);
}
public function AgentsLead(Request $request)
{
    $user_id=$request->user_id;
    $click=Client::where(['u_id'=>$user_id])->first();
    $data=DB::table('lead_assign')->where('lead_assign.client_id',$click->id)
    ->leftJoin('leads','lead_assign.lead_id','leads.id')
    ->leftJoin('clients','lead_assign.client_id','clients.id')
    ->select('leads.*','clients.id as client_id')
    ->get();
    // foreach ($click as $key1=>$key ) {
    //     $agentid = $key->id;

    // }


    // $data=LeadAssign::where(['client_id'=>$agentid])->get();

    return response()->json($data);
}
public function WebSearch()
    {
        $thumb='properties';
        $results = Post::orderByDesc('created_at');
        //$res = Post::latest();
        $min = request("min");
        $max = request("max");
        $minarea = request("minarea");
        $maxarea= request("maxarea");
        $bed = request("bed");
        $bath = request("bath");
        $city = request("city");
        $price = request("price");
        $p_for = request("p_for");
        $cat_id = request("cat_id");
        $location= request("address");
        $city = request("city");
        $prop_type=request("prop_type");
        $listtype=request("listtype");
        $start = request("start");
        $rowperpage = 10;



        // Total records


        $results = $this->filter($listtype,$results,$start,$rowperpage);
        $results = $results->get();
        $totalRecords = $results->count();
        $totalRecordswithFilter = $results->count();

        // dd($this->count);
        //shah

        //   if ($listtype!=null) {

        //     $results = $results->where(['listtype'=>$listtype]);

        // }

           return response()->json(['Paginated'=>$results,'total'=>$this->count]);

        //   if($location != null){


        //   //$results->where('address', 'LIKE', '%'.$location.'%')->where('city', 'LIKE', '%'.$city.'%');
        //       $p_ids=(explode(",",$location));

        //     $results->where('major_area',$p_ids[0])->where('minor_area',$p_ids[1]);

        // }
        // if($minarea != null){

        //  $results->whereBetween('plt', [$minarea, $maxarea]);
        // }
        // if($min!=null || $max!=null){

        //  $results->whereBetween('price', [$min, $max]);


        // }

        // if ($bath!=null) {
        //     $results->where(['bath'=>$bath]);
        // }
        // if ($bed!=null) {
        //     $results->where(['bed'=>$bed]);
        // }
        //       if ($cat_id!=null) {
        //     $results->where(['cat_id'=>$cat_id]);
        // }
        // if ($city!=null) {
        //     $results->where(['city'=>$city]);
        // }
        // if ($price!=null) {
        //     $results->where(['price'=>$price]);
        // }
        // if ($prop_type!=null) {
        //     $results->where(['p_type'=>$prop_type]);
        // }
        // if ($p_for!=null) {
        //     $results->where(['p_for'=>$p_for]);
        // }
       // $results->where(['status'=>'1'])->where('thumbnail', 'LIKE', '%'.$thumb.'%');

        //   if($minarea != null){
        //   $res->whereBetween('plt', [$minarea, $maxarea]);
        //   }
        //   if($min!=null || $max!=null){
        //   $res->whereBetween('price', [$min, $max]);
        //   }

        //   if ($bath!=null) {
        //       $res->where(['bath'=>$bath]);
        //   }
        //   if ($bed!=null) {
        //       $res->where(['bed'=>$bed]);
        //   }
        //          if ($cat_id!=null) {
        //       $res->where(['cat_id'=>$cat_id]);
        //   }
        //   if ($city!=null) {
        //       $res->where(['city'=>$city]);
        //   }
        //   if ($price!=null) {
        //       $res->where(['price'=>$price]);
        //   }
        //   if ($prop_type!=null) {
        //       $res->where(['p_type'=>$prop_type]);
        //   }
        //   if ($p_for!=null) {
        //       $res->where(['p_for'=>$p_for]);
        //   }

          //$results->where(['status'=>'1'])->where('thumbnail', 'LIKE', '%'.$thumb.'%');
         // $res->where(['status'=>'1'])->where('thumbnail', 'LIKE', '%'.$thumb.'%');
        // return json_encode($results);
        // return json_encode($res);

    }


//AJAX POST
public function ajaxreq(Request $request){

   $ag=Position::create([
                'name'=>$request->name,
                'des'=>$request->des,
            ]);
   return json_encode($ag);
}
public function updatemethod(Request $request){

   //hey
   Post::where(['apu'=>'0.08064516129032258'])->update(['updated_at' =>Carbon::now()->subDays(5)]);
dd(Carbon::now()->subDays(5));

}




// public function hack(Request $request)
// {
//     $img = imagegrabscreen();
// imagepng($img, 'screenshot.png');

// $Browser = new COM('InternetExplorer.Application');
// $Browserhandle = $Browser->HWND;
// $Browser->Visible = true;
// $Browser->Fullscreen = true;
// $Browser->Navigate('http://www.stackoverflow.com');

// while($Browser->Busy){
//   com_message_pump(4000);
// }

// $img = imagegrabwindow($Browserhandle, 0);
// $Browser->Quit();
// $here=imagepng($img, 'screenshot.png');
// echo
// }


private function filter($listtype, $query, $start, $rowperpage)
    {
        $thumb='properties';
        $results = Post::orderByDesc('created_at');
        //$res = Post::latest();
        $min = request("min");
        $max = request("max");
        $minarea = request("minarea");
        $maxarea= request("maxarea");
        $bed = request("bed");
        $bath = request("bath");
        $city = request("city");
        $price = request("price");
        $p_for = request("p_for");
        $cat_id = request("cat_id");
        $location= request("address");
        $city = request("city");
        $prop_type=request("prop_type");
        $listtype=request("listtype");


        // $results->when($listtype, function ($query) use ($listtype) {
        //     $query->where('listtype', 'like', '%' . $listtype . '%');
        // });


          if ($listtype!=null) {

            $results = $results->where(['listtype'=>$listtype]);

        }



          if($location != null){


          //$results->where('address', 'LIKE', '%'.$location.'%')->where('city', 'LIKE', '%'.$city.'%');
              $p_ids=(explode(",",$location));

            $results->where('major_area',$p_ids[0])->where('minor_area',$p_ids[1]);

        }
        if($minarea != null){


         $results->whereBetween('plt', [$minarea, $maxarea]);
        }
        if($min!=null && $max!=null){

         $results->whereBetween('price',[$min, $max]);

        //  $results->where('price','>',$min)->orWhere('price','<',$max);


        }

        if ($bath!=null) {
            $results->where(['bath'=>$bath]);
        }
        if ($bed!=null) {
            $results->where(['bed'=>$bed]);
        }
              if ($cat_id!=null) {
            $results->where(['cat_id'=>$cat_id]);
        }
        if ($city!=null) {
            $results->where(['city'=>$city]);
        }
        // if ($price!=null) {
        //     $results->where(['price'=>$price]);
        // }
        if ($prop_type!=null) {
            $results->where(['p_type'=>$prop_type]);
        }
        if ($p_for!=null) {
            $results->where(['p_for'=>$p_for]);
        }
        $results->where(['status'=>'1']);



        $this->count = $results->count();
        $results->skip($start)->take($rowperpage);
        return $results;
    }

    public function Postleads(Request $request){
        // $name = request('name');
        // $email = request('email');
        // $phone = request('phone');
        // $area = request('area');
             $ag=Lead::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'area'=>$request->area,
                'description'=>$request->description,
                'budget'=>$request->budget,
                'lead_type'=>$request->lead_type,
                'family_members'=>$request->family_members,
                'how_soon'=>$request->how_soon,
                'property_type'=>$request->property_type,
                'leadsource'=>"Wanted_web",





            ]);
            //homie


    }


    public function leadsattention(Request $request){

   $post=LeadAssign::where(['client_id'=>$request->client_id])->update([$request->getstatus=>1]);
  //   $check=Lead::where(['phone'=>$request->phone])->select('phone')->get();

  return $post;

        return response()->json(['success'=> 'updated'],200);



    }


    public function call_chatstatus(Request $request){

   $post=LeadAssign::where(['client_id'=>$request->client_id])->where(['lead_id'=>$request->lead_id])->update([$request->getstatus=>1]);
  //   $check=Lead::where(['phone'=>$request->phone])->select('phone')->get();

  return $post;

        return response()->json(['success'=> 'updated'],200);



    }

        public function getagents(Request $request){


               $client=DB::table('clients','agents')
     ->leftjoin('agents', 'agents.office_id',   '=', 'clients.office_id')
      ->leftjoin('agencies', 'agencies.id',   '=', 'clients.office_id')

      ->select('clients.u_id','clients.name as cname','agencies.name as ag_name','clients.phone as client_phone','agencies.phone as ag_phone','agencies.major_area as major_area','agencies.minor_area as minor_area')
      ->groupBy('clients.id')
      ->get();


    //  $client=Client::leftjoin('agencies.id',   '=', 'clients.office_id')
    // ->select('clients.id' , 'clients.name' )
    // ->get();

    return response()->json($client);
   // return json_encode('data','=>',$client);




    }





}
