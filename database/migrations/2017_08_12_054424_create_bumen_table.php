<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bumen', function (Blueprint $table) {
            $table->increments('bumen_id');
            $table->string('bh', 20)->unique()->comment('编号');
            $table->string('bumen_name', 40);
            $table->string('zjm', 20);
            $table->unsignedTinyInteger('enabled');
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
        Schema::dropIfExists('bumen');
    }
}
