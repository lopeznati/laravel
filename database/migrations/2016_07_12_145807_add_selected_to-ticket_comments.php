<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSelectedToTicketComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        \Illuminate\Support\Facades\Schema::table('ticket_comments',function (Blueprint $table){
            $table->boolean('selected')->default(null)->after('link');

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
        \Illuminate\Support\Facades\Schema::drop('ticket_comments',function (Blueprint $table){
            $table->dropColumn('selected');

        });
    }
}
