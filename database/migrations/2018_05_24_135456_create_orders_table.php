<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamp('date');
            $table->string('description');
            $table->integer('client_id_fk')->nullable();
            $table->unsignedInteger('user_id_fk')->nullable();
            $table->timestamps();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('client_id_fk')->references('id')->on('clients');
            $table->foreign('user_id_fk')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
