<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    public function test_create_ticket()
    {

        $user=seed('User');
        $this->actingAs($user)
            ->visit(route('tickets.create'))
        ->type('Curso de VueJs','titulo')
        ->press('Enviar Solicitud');
        
        
        $this->see('curso de VueJs');
        
        $this->seeInDatabase('tickets', [
            'titulo'=>'Curso de VueJs',
            'status'=>'open'
        ]);




    }
}
