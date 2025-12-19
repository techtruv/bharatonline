<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Supplier::orderBy('id','DESC')->get();
        return view('admin.supplierView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier');
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

        $request->validate([
            'supplierName'=>'required|max:255',
            'mobile'=>'required|max:10|min:10|unique:suppliers'
            ]);

        $res = Supplier::create($input);
        return redirect()->back()->with('success','Supplier added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Supplier::find($id);
        return view('admin.supplier',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $request->validate([
            'supplierName'=>'required|max:255',
            'mobile'=>'required|max:10|min:10|unique:suppliers,id,'.$id
            ]);
        
        unset($input['_method']);
        unset($input['_token']);
        $res = Supplier::where('id',$id)->update($input);
        return redirect(route('supplier.index'))->with('success','Supplier updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $res = Supplier::where('id',$id)->delete();
        return redirect(route('supplier.index'))->with('success','Supplier deleted successfully');

    }
}
