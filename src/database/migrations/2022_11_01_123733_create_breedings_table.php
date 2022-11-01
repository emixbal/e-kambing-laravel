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
        Schema::create('breedings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('induk_jantan_id');
            $table->foreign('induk_jantan_id')->references('id')->on('kambings');
            $table->unsignedBigInteger('induk_betina_id');
            $table->foreign('induk_betina_id')->references('id')->on('kambings');
            $table->text('description');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('breedings');
    }
};
