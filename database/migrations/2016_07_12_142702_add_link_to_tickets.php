<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkToTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        \Illuminate\Support\Facades\Schema::table('tickets',function (Blueprint $table){
            $table->string('link');

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

        \Illuminate\Support\Facades\Schema::drop('tickets',function (Blueprint $table){
            $table->dropColumn('link');

        });
    }
}
