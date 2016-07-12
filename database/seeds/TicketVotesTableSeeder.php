<?php

use Illuminate\Database\Seeder;

class TicketVotesTableSeeder extends \Styde\Seeder\Seeder
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

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        // TODO: Implement getDummyData() method.

        return [
            'user_id'=>$this->random('User')->id,
            'ticket_id'=>$this->random('Ticket')->id,

            //'user_id'=>createFrom('UserTableSeeder')->id
        ];
    }
}
