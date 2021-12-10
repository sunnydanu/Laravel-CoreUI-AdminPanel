<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentDrawsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tournament_draws', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('tournament_id', '20');
            $table->string('gender', '20');
            $table->string('category_id', '20');
            $table->string('name', '50');
            $table->string('code', '50');
            $table->longText('bracket');
            $table->longText('result');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('tournament_draws');
    }
}
