<?php

use Illuminate\Database\Seeder;

class TicketTableSeeder extends BaseSeeder
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
}
