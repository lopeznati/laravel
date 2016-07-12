<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        \Illuminate\Support\Facades\Schema::table('users',function (Blueprint $table){
            $table->enum('role',['user','admin'])->default('user')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        \Illuminate\Support\Facades\Schema::drop('users',function (Blueprint $table){
            $table->dropColumn('role');

        });
    }
}
