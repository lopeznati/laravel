<?php

use Illuminate\Database\Seeder;

class TicketTableSeeder extends \Styde\Seeder\Seeder
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
        return new \App\Entities\Ticket();
    }

    public function getData(\Faker\Generator $faker, array $custonValues = array())
    {
        return [
            'titulo'=>$faker->sentence(),
            'status'=>$faker->randomElement(['open','open','closed']),
            'user_id'=>rand(1,51)

            //'user_id'=>createFrom('UserTableSeeder')->id
        ];
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        // TODO: Implement getDummyData() method.

        return [
            'titulo'=>$faker->sentence(),
            'status'=>$faker->randomElement(['open','open','closed']),
            'user_id'=>$this->random('User')->id,

            //'user_id'=>createFrom('UserTableSeeder')->id
        ];
    }
}
