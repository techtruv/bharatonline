<?php

namespace App\Http\Controllers;

use App\Models\AccountGroup;
use Illuminate\Http\Request;

class AccountGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = AccountGroup::orderBy('id', 'DESC')->get();
        $parentGroups = AccountGroup::whereNull('under_group_id')->orWhere('under_group_id', 0)->get();
        return view('admin.accountGroup', compact('records', 'parentGroups'));
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
            'code' => 'required|string|max:255|unique:account_groups',
            'group_name' => 'required|string|max:255',
            'under_group_id' => 'nullable|exists:account_groups,id',
        ]);

        $input = $request->all();
        $res = AccountGroup::create($input);

        return redirect()->back()->with('success', 'Account Group Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountGroup  $accountGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AccountGroup $accountGroup)
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
        $records = AccountGroup::orderBy('id', 'DESC')->get();
        $data = AccountGroup::find($id);
        $parentGroups = AccountGroup::where('id', '!=', $id)->get();
        return view('admin.accountGroup', compact('records', 'data', 'parentGroups'));
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
            'code' => 'required|string|max:255|unique:account_groups,code,' . $id,
            'group_name' => 'required|string|max:255',
            'under_group_id' => 'nullable|exists:account_groups,id|not_in:' . $id,
        ]);

        $input = $request->all();

        unset($input['_method']);
        unset($input['_token']);
        $res = AccountGroup::where('id', $id)->update($input);

        return redirect(route('accountGroup.index'))->with('success', 'Account Group Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = AccountGroup::find($id)->delete();
        return redirect()->back()->with('success', 'Account Group Deleted Successfully');
    }
}
