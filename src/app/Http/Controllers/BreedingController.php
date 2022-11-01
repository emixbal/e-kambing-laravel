<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBreedingRequest;
use App\Http\Requests\UpdateBreedingRequest;
use App\Models\Breeding;

class BreedingController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBreedingRequest  $request
     * @return \Illuminate\Http\Response
     */
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
