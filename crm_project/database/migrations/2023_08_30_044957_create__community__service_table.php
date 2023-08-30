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
        Schema::create('community_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ser_id');
            $table->foreign('ser_id')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('com_id');
            $table->foreign('com_id')->references('id')->on('community')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_service');
    }
};
