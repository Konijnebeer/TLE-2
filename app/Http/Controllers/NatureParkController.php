<?php

namespace App\Http\Controllers;

use App\Models\NaturePark;
use App\Http\Requests\StoreNatureParkRequest;
use App\Http\Requests\UpdateNatureParkRequest;

class NatureParkController extends Controller
{
    public function slideshow()
    {
        $photos = glob(public_path('public/images/*.png'));

        $photos = array_map(function ($path) {
            return str_replace(public_path(), '', $path);
        }, $photos);

        return view('slideshow', compact('photos'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNatureParkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NaturePark $naturePark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NaturePark $naturePark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNatureParkRequest $request, NaturePark $naturePark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NaturePark $naturePark)
    {
        //
    }
}
