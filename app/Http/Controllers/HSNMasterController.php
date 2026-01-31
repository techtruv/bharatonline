<?php

namespace App\Http\Controllers;

use App\Models\HSNMaster;
use Illuminate\Http\Request;

class HSNMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = HSNMaster::orderBy('id', 'DESC')->get();
        return view('admin.hsnMaster', compact('records'));
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
        $request->validate([
            'hsn_code' => 'required|string|max:255|unique:hsn_masters',
            'type' => 'required|string|max:255',
            'commodity' => 'required|string|max:255',
            'sgst_percent' => 'required|numeric|min:0|max:100',
            'cgst_percent' => 'required|numeric|min:0|max:100',
            'igst_percent' => 'required|numeric|min:0|max:100',
        ]);

        $input = $request->all();
        $res = HSNMaster::create($input);

        return redirect()->back()->with('success', 'HSN Master Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HSNMaster  $hsnMaster
     * @return \Illuminate\Http\Response
     */
    public function show(HSNMaster $hsnMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = HSNMaster::orderBy('id', 'DESC')->get();
        $data = HSNMaster::find($id);
        return view('admin.hsnMaster', compact('records', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hsn_code' => 'required|string|max:255|unique:hsn_masters,hsn_code,' . $id,
            'type' => 'required|string|max:255',
            'commodity' => 'required|string|max:255',
            'sgst_percent' => 'required|numeric|min:0|max:100',
            'cgst_percent' => 'required|numeric|min:0|max:100',
            'igst_percent' => 'required|numeric|min:0|max:100',
        ]);

        $input = $request->all();

        unset($input['_method']);
        unset($input['_token']);
        $res = HSNMaster::where('id', $id)->update($input);

        return redirect(route('hsnMaster.index'))->with('success', 'HSN Master Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = HSNMaster::find($id)->delete();
        return redirect()->back()->with('success', 'HSN Master Deleted Successfully');
    }
}
