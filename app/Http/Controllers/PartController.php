<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Models\Quest;

class PartController extends Controller
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
    public function store(StorePartRequest $request, Quest $quest)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quest $quest, Part $part)
    {
        return view('quest.task', compact('quest', 'part'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quest $quest, Part $part)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartRequest $request, Quest $quest, Parts $parts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quest $quest, Part $part)
    {
        //
    }
}
