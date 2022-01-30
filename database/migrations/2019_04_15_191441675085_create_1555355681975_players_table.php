<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create1555355681975PlayersTable extends Migration{
    public function up(){
        Schema::create('players', function(Blueprint $table){
            $table->increments('id')->primary();
            $table->string('full_name', 20)->nullable();
            $table->string('father_name', 20)->nullable();
            $table->string('mother_name', 20)->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('dob')->format('d/m/Y')->nullable();
            $table->string('category')->nullable();
            $table->string('district', 20)->nullable();
            $table->longText('address')->nullable();
            $table->string('pincode', 20)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 20)->nullable();
            $table->string('tshirt_size', 20)->nullable();
            $table->string('short_size', 20)->nullable();
            $table->string('tracksuite_size', 20)->nullable();
            $table->string('shoe_size', 20)->nullable();
            $table->tinyInteger('is_paid')->default(0);
            $table->string('player_img', 20)->nullable();
            $table->string('dob_crt', 20)->nullable();
            $table->string('district_approval', 20)->nullable();
            $table->string('state_approval', 20)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(){
        Schema::dropIfExists('players');
    }
}
