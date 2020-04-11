<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\ContactResource;

class BirthdayController extends Controller
{
    public function index()
    {
        $contacts = request()->user()->contacts()->birthdays()->get();
        return ContactResource::collection($contacts);
    }
}
