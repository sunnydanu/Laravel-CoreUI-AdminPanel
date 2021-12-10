<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentPlayersTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tournament_players', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('user_id', '20');
            $table->string('tournament_id', '20');
            $table->string('player_id', '20');
            $table->string('gender', '20');
            $table->string('category_id', '20');
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
        Schema::dropIfExists('tournament_players');
    }
}
