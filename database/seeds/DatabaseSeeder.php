<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
}
