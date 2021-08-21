<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Agency;
use App\Agent;
use App\AreaOne;
use App\Project;
use App\Property;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $agency=Agency::count();
        $agent=Agent::count();
        $general_members=User::where('role_id',4)->count();
        // $properties=Property::orderBy('created_at','DESC')->limit(10)->get();
        $properties=Property::orderBy('created_at','DESC')->paginate(10);
        $projects=Project::all();
        $areas=AreaOne::paginate(10);
        return view('home',compact('agency','agent','properties','projects','areas','general_members'));
    }
}
