<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\GlobalClass;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $globalclass;

    public function __construct()
    {
        $this->globalclass = new GlobalClass;
    }

    
    public function index(Request $request)
    {

        if (!$request->keyword) {
            $users = User::orderBy('created_at', 'desc')->paginate(25);
        } else {
            $users = User::where('name', 'like', '%' . $request->keyword . '%')
            ->orWhere('email', 'like', '%' . $request->keyword . '%')
            ->orWhere('id', 'like', '%' . $request->keyword . '%')
            ->orWhere('phone', 'like', '%' . $request->keyword . '%')
            ->orWhere('mobile', 'like', '%' . $request->keyword . '%')
            ->paginate(25)->setPath('');

            $pagination = $users->appends(array(
                'keyword' => $request->keyword
            ));
        }


        $roles = Role::all();

        return view('admin.user.index', compact(['users','roles']));
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
        if ($request->hasFile('image')) {
            $filename = $this->globalclass->storeS3($request->file('image'), 'users');
            User::create($request->except('password','image','dp')+['password' => Hash::make($request->password),'type'=>'property','image' => $filename,'dp' => $filename, 'thumbnail' => $filename]);
        }
        else{
            User::create($request->except('password')+['password' => Hash::make($request->password),'type'=>'property']);
        }
        
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        $roles = Role::all();
        return view("admin.user.edit", compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        if (isset($request->newpassword)) {
            $user->update(['password' => Hash::make($request->newpassword)]);
        }

        if ($request->hasFile('image')) {
            $filename = $this->globalclass->storeS3($request->file('image'), 'users');
            $user->update($request->except('password','image','dp')+['image' => $filename,'dp' => $filename, 'thumbnail' => $filename]);
        }
        else{
            $user->update($request->all());
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        // $user->delete();
        return redirect()->back();
    }

    


    


    public function filter(Request $request){

        $users = User::orderBy('created_at','desc');

        $roles = Role::orderBy('created_at', 'desc');

        if (isset($request->role_id)) {
            $users = $users->where('users.role_id',$request->role_id);

        }
        $users = $users->paginate(25);
        $roles = $roles->paginate(25);

        $pagination = $users->appends(array(
            'role_id' => $request->role_id,

        ));

        return view('admin.user.index', compact(['users','roles']));

    }

}
