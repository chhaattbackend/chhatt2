<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Agent;
use App\AreaOne;
use App\Lead;
use App\Project;
use App\Property;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if(auth()->user()->role->name == 'Agency' || auth()->user()->role->name == 'Agents' ){
            return redirect()->route('properties.index');
        }
        $agency=Agency::count();
        $agent=Agent::count();
        $general_members=User::where('role_id',4)->count();
        $properties=Property::orderBy('created_at','DESC')->paginate(10);
        $projects=Project::all();
        $areas=AreaOne::paginate(10);
        $leads = Lead::orderBy('created_at','DESC')->paginate(5);
        $property = Property::whereDate('created_at', Carbon::today())->get();


        return view('home',compact('agency','agent','properties','projects','areas','general_members','leads','property'));
    }

    public function ajaxSearch(){

        $areas=AreaOne::paginate(10);

        $data = view('hometable.areatable', compact('areas'))->render();

        // dd($leads);
        return response()->json([
            'data' => $data,
            'pagination' => (string) $areas->links()
        ]);



    }









}
