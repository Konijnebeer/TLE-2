<?php

namespace App\Http\Controllers;

use App\Models\NaturePark;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreNatureParkRequest;
use App\Http\Requests\UpdateNatureParkRequest;

class NatureParkController extends Controller
{
    public function slideshow()
    {
        // gebruik de map carousel als variabel $files om de images in te laden
        $files = File::files(public_path('carousel'));
        $images = [];
        // for loop om alle fotos op te halen uit de map carousel
        foreach ($files as $file) {
            $images[] = $file->getFilename();
        }
        return view('home')->with('images', $images);    }

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
