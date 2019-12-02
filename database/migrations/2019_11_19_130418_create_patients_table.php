<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // data tambahan untuk pasien ada di table meta
        // contoh data tambahan alergi
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("address");
            $table->date("date_of_birth")->nullable();
            $table->string("place_of_birth")->nullable();
            $table->enum("gender", ['m', 'f']);
            $table->enum("blood", ['a', 'b', 'ab', 'o'])->nullable();
            $table->string('phone')->nullable();
            $table->string('parent');
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
        Schema::dropIfExists('patients');
    }
}
