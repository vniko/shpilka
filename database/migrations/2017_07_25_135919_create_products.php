<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('category_id');
            $table->double('price');
            $table->boolean('is_abonement')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon_class');
            $table->string('product_class');
            $table->integer('parent_id');
            $table->integer('sort_order')->default(100);
        });

        Schema::create('abonement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('product_id');
            $table->integer('order_line_id');
            $table->integer('order_id');
            $table->integer('visits')->default(0);
            $table->integer('visits_left')->default(0);
            $table->integer('valid_from')->default(0);
            $table->integer('valid_to')->default(0);
            $table->timestamps();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('seller_id');
            $table->double('total');
            $table->double('total_discount');
            $table->timestamps();
        });

        Schema::create('order_line', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->double('price');
            $table->integer('qty');
            $table->double('total');
            $table->double('total_discount');
            $table->integer('discount_perc')->default(0);
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
    }
}
