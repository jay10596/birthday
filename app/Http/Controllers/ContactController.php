<?php

namespace App\Http\Controllers;

use App\Model\Contact;
use Illuminate\Http\Request;

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
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Contact::create($this->validateData());
    }

    public function show(Contact $contact)
    {
        return $contact;
    }

    public function edit(Contact $contact)
    {
        //
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($this->validateData()); 
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
