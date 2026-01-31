<?php

namespace App\Http\Controllers;

use App\Models\PhoneDirectory;
use Illuminate\Http\Request;

class PhoneDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = PhoneDirectory::orderBy('id','DESC')->get();
        return view('admin.phoneDirectory',compact('records'));
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
            'name' => 'required|max:255',
            'address' => 'nullable|max:500',
            'phone_no' => 'nullable|max:20',
            'mobile_no' => 'nullable|max:20',
            'mobile_no1' => 'nullable|max:20',
            'mobile_no2' => 'nullable|max:20',
            'gst_no' => 'nullable|max:50|unique:phone_directories'
        ]);

        $res = PhoneDirectory::create($input);

        return redirect(route('phoneDirectory.index'))->with('success','Phone Directory Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneDirectory  $phoneDirectory
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneDirectory $phoneDirectory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhoneDirectory  $phoneDirectory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = PhoneDirectory::orderBy('id','DESC')->get();
        $data = PhoneDirectory::find($id);
        return view('admin.phoneDirectory',compact('records','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhoneDirectory  $phoneDirectory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required|max:255',
            'address' => 'nullable|max:500',
            'phone_no' => 'nullable|max:20',
            'mobile_no' => 'nullable|max:20',
            'mobile_no1' => 'nullable|max:20',
            'mobile_no2' => 'nullable|max:20',
            'gst_no' => 'nullable|max:50|unique:phone_directories,gst_no,'.$id
        ]);
        unset($input['_token']);
        unset($input['_method']);

        $res = PhoneDirectory::where('id',$id)->update($input);

        return redirect(route('phoneDirectory.index'))->with('success','Phone Directory Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneDirectory  $phoneDirectory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PhoneDirectory::find($id)->delete();
        return redirect(route('phoneDirectory.index'))->with('success','Phone Directory Deleted Successfully');
    }
}
