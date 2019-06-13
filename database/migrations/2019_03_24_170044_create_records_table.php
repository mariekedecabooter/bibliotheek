<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titel');

            $table->integer('auteur_id')->unsigned()->nullable()->index();
            $table->foreign('auteur_id')->references('id')->on('authors');

            $table->string('isbn');
            $table->year('jaartal')->nullable();
            $table->string('uitgave');
            $table->text('beschrijving');
            $table->integer('aantal');

            $table->integer('photo_id')->unsigned()->nullable()->index();
            $table->foreign('photo_id')->references('id')->on('photos');

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
        Schema::dropIfExists('records');
    }
}
