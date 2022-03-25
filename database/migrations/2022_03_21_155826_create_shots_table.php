<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shots', function (Blueprint $table) {
            $table->id();

            $table->integer('dice1');
            $table->integer('dice2');
            $table->boolean('result');
            $table->integer('total');
            $table->unsignedBigInteger('player_id')->nullable();
            $table->foreign('player_id')
                ->references('id')->on('players')
                ->onDelete('set null');
                
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
        Schema::dropIfExists('shots');
    }
}
