<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('notes', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('updated_by');
            $table->integer('character_id');
            $table->boolean('private');
            $table->text('title');
            $table->text('details');

            $table->index(['character_id', 'updated_by']);
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

        Schema::drop('notes');
    }
}
