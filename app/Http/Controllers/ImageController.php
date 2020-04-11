<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;


class ImageController extends Controller
{
    public function upload(ImageRequest $request)
    {
        $request->user()->avatar = $request->image;
        $request->user()->save();

        return response(null, 200);
    }
}
