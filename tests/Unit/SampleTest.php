<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SampleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $this->assertTrue(true);

        //test route
        //$this->get("/api/second")->assertStatus(200);

        $value = [
            "fullname" => "Kunto 1",
            "username" => "kunto3",
            "password" => Hash::make("123456"),
            "type" => "reguler",

        ];
        $respon = ['code', 'status', 'data'];

        $this->post(route('api.users'), $value)->assertStatus(201)->assertJsonStructure($respon);
    }

    public function testGetUser()
    {
        // $this->assertTrue(true);

        //test route
        //$this->get("/api/second")->assertStatus(200);


        $respon = ['code', 'status', 'data'];

        $this->get(route('business/search'))->assertStatus(200)->assertJsonStructure($respon);
    }

    
}
