<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    protected  $title='Curso de VueJs';
    protected  $link='https://styde.net';
    use DatabaseTransactions;
    public function test_create_ResourceTest()
    {

        $user=seed('User');
        $this->actingAs($user)
            ->visit(route('tickets.create'))
        ->type($this->title,'titulo')
            ->type($this->link,'link')
        ->press('Enviar Solicitud');
        
        
        $this->see($this->title)
            ->seeLink('Ver recurso',$this->link);
        
        $this->seeInDatabase('tickets', [
            'titulo'=>$this->title,
            'link'=>$this->link,
            'status'=>'open',
        ]);




    }

    public function test_select_resource()
    {
        // Having
        $user = seed('User');

        $ticket = seed('Ticket', [
            'titulo' => $this->title,
            'user_id' => $user->id,
            'status' => 'open',
        ]);

        $comment = seed('TicketComments', [
            'ticket_id' => $ticket->id,
            'link' => $this->link,
        ]);

        // When
        $this->actingAs($user)
            ->visit(route('tickets.details', $ticket))
            ->press('Seleccionar tutorial');

        // Then
        $this->seeInDatabase('tickets', [
            'id' => $ticket->id,
            'status' => 'closed',
            'link' => $this->link,
        ]);

        $this->seeInDatabase('ticket_comments', [
            'id' => $comment->id,
            'selected' => true,
        ]);

        $this->seePageIs(route('tickets.details', $ticket));

        $this->seeLink('Ver recurso', $this->link);
    }
}
