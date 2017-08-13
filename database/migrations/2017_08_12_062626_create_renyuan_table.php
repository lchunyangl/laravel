<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenyuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renyuan', function (Blueprint $table) {
            $table->increments('renyuan_id');
            $table->unsignedInteger('bumen_id');
            $table->string('bh', 20)->unique()->comment('编号');
            $table->string('renyuan_name', 20);
            $table->string('zjm', 20);
            $table->unsignedTinyInteger('type')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('renyuan');
    }
}
