<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use function redirect;
use function response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('images.index');
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
     * Save the image to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the incomming file
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'There is no image present'], 400);
        }

        $request->validate([
            'image' => 'file|image|required'
        ]);


        // process the upload and save the file in storage
        // returns false if image does not save
        $path = $request->file('image')->store('public/images');

        // 500 error if not saved
        if (!path) {
            return response()->json(['error', 'The file could not be saved'], 500);
        }

        $uploadedFile = $request->file('image');


        // create image model
        $image = Image::create([
            'name' => $uploadedFile->hashName(),
            'extension' => $uploadedFile->extension(),
            'size' => $uploadedFile->getSize()
        ]);


        // return that image model back to the frontend
        return $image;
    }

    /**
     * Display the specified resource.
     * Return all images.
     *
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
