<?php

use Illuminate\Database\Seeder;

use App\Entities\User;

use Faker\Factory as Faker;
use Faker\Generator;


class UserTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function getModel(){
        return new User();
    }


    public function getData(Generator $faker, array $custonValues=array()){
        return [
            'name'=>$faker->name,
            'email'=>$faker->email,
            'password'=>bcrypt('secret')
        ];
    }
     public function run()
     {
         //
         /*
         $faker=Faker::create();
         for ($i=1; $i <=50; $i++) {
           # code...
           User::create([
             'name'=>$faker->name,
             'email'=>$faker->email,
             'password'=>bcrypt('secret')
           ]);
         }*/
         $this->createAdmin();
         $this->createMultiple(50);
     }

     private function createAdmin(){
       User::create([
         'name'=>'natali',
         'email'=>'nati@gmail.com',
         'password'=>bcrypt('admin')

       ]);
     }
}
