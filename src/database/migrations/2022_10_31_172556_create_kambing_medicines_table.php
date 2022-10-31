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
        Schema::create('kambing_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kambing_id');
            $table->foreign('kambing_id')->references('id')->on('kambings');
            $table->unsignedBigInteger('medicine_id');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kambing_medicines');
    }
};
