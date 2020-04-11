<?php

namespace App\Http\Controllers;

use App\Model\Contact;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\ContactResource;

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
        return ContactResource::collection(request()->user()->contacts);
    }

    public function store(Request $request)
    {
        $contact = request()->user()->contacts()->create($this->validateData());
        
        return (new ContactResource($contact))->response()->setStatusCode(201);
    }

    public function show(Contact $contact)
    {
        if(request()->user()->isNot($contact->user))
        {
            return response([], 403);
        }

        return new ContactResource($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        if(request()->user()->isNot($contact->user))
        {
            return response([], 403);
        }

        $contact->update($this->validateData());

        return (new ContactResource($contact))->response()->setStatusCode(200); 
    }

    public function destroy(Contact $contact)
    {
        if(request()->user()->isNot($contact->user))
        {
            return response([], 403);
        }
        
        $contact->delete();

        return response([], 204);
    }
}
