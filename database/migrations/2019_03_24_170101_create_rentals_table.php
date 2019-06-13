<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('record_id')->index()->unsigned();
            $table->foreign('record_id')->references('id')->on('records');

            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamp('date_in');
            $table->timestamp('date_out');

            $table->timestamp('date_returned')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
