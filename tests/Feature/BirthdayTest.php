<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Model\Contact;
use App\User;
use Carbon\Carbon;

class BirthdayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function birthdaysCurrentMonth()
    {
        $this->withoutExceptionHandling();

        $user = factory('App\User')->create();

        $contact1 = factory('App\Model\Contact')->create([
            'user_id' => $user->id, 
            'birthday' => now()->subYear()
        ]);

        $contact2 = factory('App\Model\Contact')->create([
            'user_id' => $user->id, 
            'birthday' => now()->subMonth()
        ]);

        $this->get('/api/birthdays?api_token=' . $user->api_token)
            ->assertJsonCount(1)->assertJson([
            'data' => [
                [
                    'data' => [
                        'id' => $contact1->id
                    ]
                ]
            ] 
        ]);
    }
}
