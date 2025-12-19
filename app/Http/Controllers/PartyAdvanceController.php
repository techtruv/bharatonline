<?php

namespace App\Http\Controllers;

use App\Models\PartyAdvance;
use Illuminate\Http\Request;

class PartyAdvanceController extends Controller
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
        $input['user_id'] =auth()->user()->id;
        PartyAdvance::create($input);
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
     * @param  \App\Models\PartyAdvance  $partyAdvance
     * @return \Illuminate\Http\Response
     */
    public function show(PartyAdvance $partyAdvance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartyAdvance  $partyAdvance
     * @return \Illuminate\Http\Response
     */
    public function edit(PartyAdvance $partyAdvance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PartyAdvance  $partyAdvance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartyAdvance $partyAdvance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartyAdvance  $partyAdvance
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartyAdvance $partyAdvance)
    {
        //
    }
}
