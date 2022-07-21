<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Second task
        Schema::create('near_earth_objects', function (Blueprint $table) {
            $table->id();
            $table->string('referenced')->nullable();
            $table->string('name');
            $table->integer('speed'); // per hour
            $table->boolean('is_hazardous');
            $table->date('Date');
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
        Schema::dropIfExists('near_earth_objects');
    }
};
