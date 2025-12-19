<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\AdvanceType;
use App\Models\Head;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Transaction::all();
       return view('admin.transView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pay_types = AdvanceType::all();
         $heads = Head::all();
        return view('admin.trans',compact('pay_types','heads'));
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
       $input['trans_date']=date('Y-m-d',strtotime($request->trans_date));
       if($request->trans_type=='Income'){
        $input['page']='10';
       }else{
        $input['page']='11';
       }

        $input['createdby'] = auth()->user()->id;
       $input['document'] = 'ok';
        $input;
       Transaction::create($input);

       return redirect()->back()->with('success','Transaction add Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::find($id)->delete();
        return redirect()->back()->with('success','Deleted');
    }
}
