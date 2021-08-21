<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;;

use App\Http\Resources\ProjectSaleInstallmentCollection;
use App\ProjectBuyer;
use App\ProjectSaleInstallment;
use App\ProjectShop;
use Illuminate\Http\Request;

class ProjectSaleInstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $ProjectSaleInstallments = ProjectSaleInstallment::orderBy('created_at','desc')->paginate(25);


            return new ProjectSaleInstallmentCollection($ProjectSaleInstallments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $data = ProjectSaleInstallment::all();
            $shops=ProjectShop::all();
            $buyers=ProjectBuyer::all();

            return view('admin.project_sales_installment.create',compact('data','shops','buyers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'shop_id' => 'required',
            'buyer_id' => 'required',
            'price' => 'required',
            'down_payment' => 'required',
            'installment_rate' => 'required',
            'paid' => 'required',


        ]);
        $data = ProjectSaleInstallment::create($request->all());

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
            $psinstallment = ProjectSaleInstallment::find($request->id);
            $shops=ProjectShop::all();
            $buyers=ProjectBuyer::all();

            return view('admin.project_sales_installment.edit',compact('psinstallment','shops','buyers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ProjectSaleInstallment::where('id',$id)->update($request->except('_token'));

        return response()->json([
            'success'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProjectSaleInstallment::findOrfail($id);
        $data->delete();

        return redirect('/ProjectSaleInstallments')->with('message','Deleted');
    }
}
