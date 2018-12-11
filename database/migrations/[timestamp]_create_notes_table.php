<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Note', function (Blueprint $table) {
            $table->increments('noteid');
            $table->integer('uid')->index();
            $table->text('notetext');
            $table->integer('permission');
            $table->varchar('geohash');
            $table->double('longitude');
            $table->double('latitude');
            $table->double('radius');
            $table->dateTime(['created_time']);
            $table->dateTime('modified_time');
            $table->date('begin_date');
            $table->time('begin_time');
            $table->date('end_date');
            $table->time('end_time');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Note');
    }
}