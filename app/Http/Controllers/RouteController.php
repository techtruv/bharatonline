<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\State;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records = Route::orderBy('id','ASC')->get();
        return view('admin.route',compact('records'));
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

        $request->validate(['state'=>'required','name'=>'required|max:255|unique:routes']);

        $res = Route::create($input);

        return redirect(route('route.index'))->with('success','Route Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = Route::orderBy('id','ASC')->get();
        $data = Route::find($id);
        return view('admin.route',compact('records','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $request->validate(['state'=>'required','name'=>'required|max:255|unique:routes,id,'.$id]);

        unset($input['_token']);
          unset($input['_method']);
        $res = Route::where('id',$id)->update($input);

        return redirect(route('route.index'))->with('success','Route Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Route::find($id)->delete();
        return redirect(route('route.index'))->with('success','Route Deleted successfully');
    }
}
