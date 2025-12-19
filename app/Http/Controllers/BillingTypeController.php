<?php

namespace App\Http\Controllers;

use App\Models\BillingType;
use Illuminate\Http\Request;

class BillingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = BillingType::orderBy('id','DESC')->get();
        return view('admin.billType',compact('records'));

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate(['name'=>'required|max:255|unique:billing_types']);

        $res = BillingType::create($input);

        return redirect(route('billType.index'))->with('success','Billing Type Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\Response
     */
    public function show(BillingType $billingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = BillingType::orderBy('id','DESC')->get();
        $data = BillingType::find($id);
        return view('admin.billType',compact('records','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate(['name'=>'required|max:255|unique:billing_types,id,'.$id]);
        unset($input['_token']);
        unset($input['_method']);

        $res = BillingType::where('id',$id)->update($input);

        return redirect(route('billType.index'))->with('success','Billing Type Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BillingType  $billingType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = BillingType::find($id)->delete();
         return redirect(route('billType.index'))->with('success','Billing Type Deleted Successfully');
    }
}
