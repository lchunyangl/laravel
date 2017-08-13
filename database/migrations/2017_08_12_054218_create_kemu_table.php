<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKemuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemu', function (Blueprint $table) {
            $table->increments('kemu_id');
            $table->unsignedInteger('parent_id');
            $table->string('bh', 40)->unique()->comment('编号');
            $table->string('kemu_name', 40);
            $table->string('zjm', 20);
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
        Schema::dropIfExists('kemu');
    }
}
