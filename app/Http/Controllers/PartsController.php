<?php

namespace App\Http\Controllers;

use App\Models\Parts;
use App\Http\Requests\StorePartsRequest;
use App\Http\Requests\UpdatePartsRequest;
use App\Models\Quest;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Quest $quest)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Quest $quest)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartsRequest $request, Quest $quest)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quest $quest, Parts $parts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quest $quest, Parts $parts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartsRequest $request, Quest $quest, Parts $parts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quest $quest, Parts $parts)
    {
        //
    }
}
