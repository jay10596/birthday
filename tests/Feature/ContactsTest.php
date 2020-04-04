<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Model\Contact;
use Carbon\Carbon;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    private function data()
    {
        return [
            'name' => 'User',
            'email' => 'user@test.com',
            'birthday' => '05/10/1996',
            'company' => 'Telecom '
        ];
    }

    /** @test */
    public function contactCreatedCount()
    {
        $this->withoutExceptionHandling();

        $this->post('/api/contacts', $this->data());

        $this->assertCount(1, Contact::all());
    }
                    
    /** @test */
    public function contactCreatedEquals()
    {
        $this->withoutExceptionHandling();

        $this->post('/api/contacts', $this->data());

        $contact = Contact::first();
        
        $this->assertEquals('User', $contact->name);
        $this->assertEquals('user@test.com', $contact->email);
        $this->assertEquals('Telecom', $contact->company);
    }

    /** @test */
    public function nameRequiredSessionErrors()
    {
        $response = $this->post('/api/contacts', array_merge($this->data(), ['name' => '']));

        $contact = Contact::first();
        
        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Contact::all());
    } 

    /** @test */
    public function fieldsRequiredSessionErrors()
    {
        collect(['name', 'email', 'birthday', 'company'])
            ->each(function($field){
                $response = $this->post('/api/contacts', array_merge($this->data(), [$field => '']));

                $contact = Contact::first();
                
                $response->assertSessionHasErrors($field);
                $this->assertCount(0, Contact::all());
            });
    }

    /** @test */
    public function validEmailSessionErrors()
    {
        collect(['name', 'email', 'birthday', 'company'])
            ->each(function($field){
                $response = $this->post('/api/contacts', array_merge($this->data(), ['email' => 'not an email format']));

                $contact = Contact::first();
                
                $response->assertSessionHasErrors('email');
                $this->assertCount(0, Contact::all());
            });
    }

    /** @test */
    public function validBirthdayInstanceOf()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/contacts', array_merge($this->data()));
        
        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('05-10-1996', Contact::first()->birthday->format('m-d-Y'));
    }

    /** @test */
    public function singleContactJson()
    {
        $contact = factory('App\Model\Contact')->create();
        //dd($contact);
        $response = $this->get('api/contacts/' . $contact->id);
    
        $response->assertJson([
            'name' => $contact->name,
            'email' => $contact->email,
            'birthday' => '1996-05-10T00:00:00.000000Z',
            'company' => $contact->company,
        ]);
    }

    /** @test */
    public function editContactEquals()
    {
        $contact = factory('App\Model\Contact')->create();

        $response = $this->put('api/contacts/' . $contact->id, $this->data());
    
        $contact = $contact->fresh();

        $this->assertEquals('User', $contact->name);
        $this->assertEquals('user@test.com', $contact->email);
        $this->assertEquals('05/10/1996', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('Telecom', $contact->company);
    }

    /** @test */
    public function deleteContactCount()
    {
        $contact = factory('App\Model\Contact')->create();

        $response = $this->delete('api/contacts/' . $contact->id);
    
        $this->assertCount(0, Contact::all());
    }
}
