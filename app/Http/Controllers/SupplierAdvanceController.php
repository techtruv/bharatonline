<?php

namespace App\Http\Controllers;

use App\Models\SupplierAdvance;
use Illuminate\Http\Request;

class SupplierAdvanceController extends Controller
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
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        SupplierAdvance::create($input);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierAdvance  $supplierAdvance
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierAdvance $supplierAdvance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierAdvance  $supplierAdvance
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierAdvance $supplierAdvance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierAdvance  $supplierAdvance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierAdvance $supplierAdvance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierAdvance  $supplierAdvance
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierAdvance $supplierAdvance)
    {
        //
    }
}
