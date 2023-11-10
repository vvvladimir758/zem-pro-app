<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function store(Request $request)
    {
        $imagePath = $request->file('image')->store('public/images');
        $imagePath = substr($imagePath, 7);
        $image = new Image([
            'title' => $request->get('title'),
            'image_path' => $imagePath
        ]);

        $image->save();

        return [
            'imagePath' => $imagePath,
            'image_id'  => $image->id
        ]; 
    }
}