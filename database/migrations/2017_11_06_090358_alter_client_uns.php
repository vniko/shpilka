<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientUns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE client CHANGE `id` `id` INT(10) NOT NULL AUTO_INCREMENT");
        \DB::statement("INSERT INTO client` (`id`, `name`) VALUES ('-1', 'Нет клиента')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
