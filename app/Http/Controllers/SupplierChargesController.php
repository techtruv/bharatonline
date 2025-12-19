<?php

namespace App\Http\Controllers;

use App\Models\SupplierCharges;
use Illuminate\Http\Request;

class SupplierChargesController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $input =$request->all();
        $input['user_id'] =auth()->user()->id;
        SupplierCharges::create($input);
        return "1";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $input =$request->all();
        $input['user_id'] =auth()->user()->id;
        SupplierCharges::create($input);
        return "1";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierCharges  $supplierCharges
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierCharges $supplierCharges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierCharges  $supplierCharges
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierCharges $supplierCharges)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierCharges  $supplierCharges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierCharges $supplierCharges)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierCharges  $supplierCharges
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierCharges $supplierCharges)
    {
        //
    }
}
