<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->increments('id');
            $table->date('visit_date');
            $table->string('visit_time');
            $table->integer('client_id');
            $table->integer('master_id');
            $table->integer('department_id');
            $table->tinyInteger('status');
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_action_id')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
