<?php

namespace App\Http\Controllers;

use App\Models\VoucherEntryType;
use Illuminate\Http\Request;

class VoucherEntryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = VoucherEntryType::orderBy('id', 'DESC')->get();
        return view('admin.voucherEntryType', compact('records'));
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
            'code' => 'required|string|max:255|unique:voucher_entry_types',
            'name' => 'required|string|max:255',
        ]);

        $input = $request->all();
        $res = VoucherEntryType::create($input);

        return redirect()->back()->with('success', 'Voucher Entry Type Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherEntryType  $voucherEntryType
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherEntryType $voucherEntryType)
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
        $records = VoucherEntryType::orderBy('id', 'DESC')->get();
        $data = VoucherEntryType::find($id);
        return view('admin.voucherEntryType', compact('records', 'data'));
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
            'code' => 'required|string|max:255|unique:voucher_entry_types,code,' . $id,
            'name' => 'required|string|max:255',
        ]);

        $input = $request->all();

        unset($input['_method']);
        unset($input['_token']);
        $res = VoucherEntryType::where('id', $id)->update($input);

        return redirect(route('voucherEntryType.index'))->with('success', 'Voucher Entry Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = VoucherEntryType::find($id)->delete();
        return redirect()->back()->with('success', 'Voucher Entry Type Deleted Successfully');
    }
}
