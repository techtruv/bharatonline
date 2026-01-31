<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Bank::orderBy('id','DESC')->get();
        return view('admin.bank',compact('records'));
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

        $request->validate([
            'code' => 'required|max:50|unique:banks',
            'name' => 'required|max:255|unique:banks'
        ]);

        $res = Bank::create($input);

        return redirect(route('bank.index'))->with('success','Bank Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = Bank::orderBy('id','DESC')->get();
        $data = Bank::find($id);
        return view('admin.bank',compact('records','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate([
            'code' => 'required|max:50|unique:banks,code,'.$id,
            'name' => 'required|max:255|unique:banks,name,'.$id
        ]);
        unset($input['_token']);
        unset($input['_method']);

        $res = Bank::where('id',$id)->update($input);

        return redirect(route('bank.index'))->with('success','Bank Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Bank::find($id)->delete();
        return redirect(route('bank.index'))->with('success','Bank Deleted Successfully');
    }
}
