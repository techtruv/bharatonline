<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Category::with('unit')->orderBy('id','DESC')->get();
        $units = Unit::orderBy('name','ASC')->get();
        return view('admin.category',compact('records','units'));
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
            'category' => 'required|max:255|unique:categories',
            'weight' => 'nullable|numeric|min:0',
            'hsn_code' => 'nullable|max:50',
            'unit_id' => 'nullable|exists:units,id'
        ]);

        $res = Category::create($input);

        return redirect(route('category.index'))->with('success','Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = Category::with('unit')->orderBy('id','DESC')->get();
        $data = Category::find($id);
        $units = Unit::orderBy('name','ASC')->get();
        return view('admin.category',compact('records','data','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate([
            'category' => 'required|max:255|unique:categories,category,'.$id,
            'weight' => 'nullable|numeric|min:0',
            'hsn_code' => 'nullable|max:50',
            'unit_id' => 'nullable|exists:units,id'
        ]);
        unset($input['_token']);
        unset($input['_method']);

        $res = Category::where('id',$id)->update($input);

        return redirect(route('category.index'))->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id)->delete();
        return redirect(route('category.index'))->with('success','Category Deleted Successfully');
    }
}
