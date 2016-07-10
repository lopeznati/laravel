<?php

use Faker\Factory as Faker;
use Faker\Generator;
/**
 * Created by PhpStorm.
 * User: NATALI
 * Date: 7/8/2016
 * Time: 8:37 p.m.
 */
abstract class BaseSeeder extends \Illuminate\Database\Seeder
{
    abstract  public function getModel();
    abstract public function getData(Generator $faker, array $custonValues=array());

protected function createMultiple($total,array $custonValues=array() ){
        $faker=Faker::create();
        for ($i=1; $i <=$total; $i++) {
            # code...
            $this->create($custonValues);
             }

    }

    protected  function create(array $custonValues=array()){

        $values=$this->getData(Faker::create(), $custonValues);
        $values=array_merge($values, $custonValues);
       return  $this->getModel()->create($values);

    }
    /**
     * @param $faker
     * @return array
     */

    protected  function  createFrom($seeder,array $custonValues=array()){
        $seeder=new $seeder;
       return  $seeder->create($custonValues);

    }



}