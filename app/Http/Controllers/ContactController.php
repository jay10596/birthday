<?php

namespace App\Http\Controllers;

use App\Model\Contact;
use Illuminate\Http\Request;
use App\User;

class ContactController extends Controller
{
    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'company' => 'required'
        ]);
    }

    public function index()
    {
        return request()->user()->contacts;
    }

    public function store(Request $request)
    {
        request()->user()->contacts()->create($this->validateData());
    }

    public function show(Contact $contact)
    {
        if(request()->user()->isNot($contact->user))
        {
            return response([], 403);
        }

        return $contact;
    }

    public function update(Request $request, Contact $contact)
    {
        if(request()->user()->isNot($contact->user))
        {
            return response([], 403);
        }

        $contact->update($this->validateData()); 
    }

    public function destroy(Contact $contact)
    {
        if(request()->user()->isNot($contact->user))
        {
            return response([], 403);
        }
        
        $contact->delete();
    }
}
