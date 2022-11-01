<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBreedingRequest;
use App\Http\Requests\UpdateBreedingRequest;
use App\Models\Breeding;

class BreedingController extends Controller
{
    public function index()
    {
        return view('breeding/index');
    }

    public function create()
    {
        return view('breeding/new_form');
    }

    public function store(StoreBreedingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Breeding  $breeding
     * @return \Illuminate\Http\Response
     */
    public function show(Breeding $breeding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Breeding  $breeding
     * @return \Illuminate\Http\Response
     */
    public function edit(Breeding $breeding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBreedingRequest  $request
     * @param  \App\Models\Breeding  $breeding
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBreedingRequest $request, Breeding $breeding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Breeding  $breeding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Breeding $breeding)
    {
        //
    }
}
