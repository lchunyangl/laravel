<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaoxiaolxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baoxiaolx', function (Blueprint $table) {
            $table->increments('baoxiaolx_id');
            $table->string('bh', 20)->unique()->comment('编号');
            $table->string('baoxiaolx_name', 40);
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
        Schema::dropIfExists('baoxiaolx');
    }
}
