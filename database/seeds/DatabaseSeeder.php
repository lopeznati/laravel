<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Styde\Seeder\BaseSeeder;

class DatabaseSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected  $truncate=array(

        'users',
        'password_resets',
        'tickets',
        'ticket_votes',
        'ticket_comments'

    );

    protected  $seeders=array(
        'User',
        'Ticket',
        'TicketVotes',
        'TicketComments'

    );

    /*
    public function run()
    {
        Model::unguard();


        $this->truncateTables(array(
            'users',
            'password_resetd',
            'tickets',
            'ticket_votes',
            'ticket_comments'

        ));

        $this->call(UserTableSeeder::class);
        $this->call(TicketTableSeeder::class);
        $this->call(TicketVotesTableSeeder::class);
        $this->call(TicketCommentsTableSeeder::class);

        Model::reguard();
    }

    public function truncateTables(array $tables)
    {
        //para eliminar los datos cargados
        DB::statement('SET FOREIGN_KEY_CHECKS =0');

        $tables = array('users');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::table('users')->truncate();


        //lo activo para evitar q se agreguen mal

        DB::statement('SET FOREIGN_KEY_CHECKS =1');
    }

    */
}
