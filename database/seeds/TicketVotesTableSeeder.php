<?php

use Illuminate\Database\Seeder;

class TicketVotesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createMultiple(50);
    }

    public function getModel()
    {
        return new \App\Entities\TicketVote();
    }

    public function getData(\Faker\Generator $faker, array $custonValues = array())
    {
        return [
            'user_id'=>rand(1,51),
            'ticket_id'=>rand(1,51)

            //'user_id'=>createFrom('UserTableSeeder')->id
        ];
    }
}
