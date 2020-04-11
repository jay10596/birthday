<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;
use App\Model\Contact;

class SearchController extends Controller
{
    public function index()
    {
        $data = request()->validate([
            'searchTerm' => 'required'
        ]);

        $searchResult = Contact::search($data['searchTerm'])->where('user_id', request()->user()->id)->get();
    
        return ContactResource::collection($searchResult);
    }
}
