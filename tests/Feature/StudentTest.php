<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStudent()
    {
        $response = $this->get('/students');

        $response->assertStatus(200);

        $response->assertSeeText('List of students');
    }

    public function testStudentNotFund()
    {
        $response = $this->get('/students/edit/28');

        $response->assertStatus(200);
        

        
    }

    public function testStudentCreate()
    {
        $response = $this->post('/students', [
            'name' => 'Loic',
            'lastName' => 'Hounkpatin',
            'sex' => 'M',
            'birthdate' => '2000-01-01',
            'height' => 1.80,
            'year' => 3,
            'filiere' => 3
        ]);

        $response->assertStatus(200);
        $response->assertHeader('Location','http://localhost/inscription');
    }

    public function testStudentCreateWithFalseSex()
    {
        $response = $this->post('/students', [
            'name' => 'Loic',
            'lastName' => 'Hounkpatin',
            'sex' => 'M',
            'birthdate' => '2000-01-01',
            'height' => 1.80,
            'year' => 3,
            'filiere' => 3
        ]);

        $response->assertStatus(200);
        
    }

    
}
