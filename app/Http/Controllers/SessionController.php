<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $records = Session::orderBy('id','DESC')->get();
        return view('admin.session',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $records = Session::orderBy('id','DESC')->get();
        return view('admin.session',compact('records'));
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
            'from_date'=>'required|date',
            'to_date'=>'required|date',
            'session_name'=>'required|max:255'
        ]);

        $input['from_date'] = date('Y-m-d',strtotime($request->from_date));
        $input['to_date'] = date('Y-m-d',strtotime($request->to_date));
        $input['createdby'] = auth()->user()->id;
        
        Session::create($input);
        return redirect(route('session.create'))->with('success','Session Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $records = Session::orderBy('id','DESC')->get();
        $data = Session::find($id);
        return view('admin.session',compact('records','data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $input = $request->all();
        
        $request->validate([
            'from_date'=>'required|date',
            'to_date'=>'required|date',
            'session_name'=>'required|max:255'
        ]);

        $input['from_date'] = date('Y-m-d',strtotime($request->from_date));
        $input['to_date'] = date('Y-m-d',strtotime($request->to_date));
        $input['createdby'] = auth()->user()->id;
        
        unset($input['_method']);
        unset($input['_token']);
        Session::where('id',$id)->update($input);
        return redirect(route('session.create'))->with('success','Session Updated Successfully');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          Session::where('id',$id)->delete();
        return redirect(route('session.create'))->with('success','Session Deleted Successfully');
 
    }
}
