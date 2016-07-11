<?php
/**
 * Created by PhpStorm.
 * User: 09-MAPPLICS
 * Date: 11/7/2016
 * Time: 11:19 AM
 */

namespace App\Repository;


abstract class BaseRepository
{
    abstract public function  getModel();

    public function find($id){
        return $this->getModel()->find($id);
    }





}