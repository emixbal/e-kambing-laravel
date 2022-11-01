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
        Schema::create('kambings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number')->unique();
            $table->boolean('is_active')->default(true);
            $table->date('birth_date');
            $table->string('image')->nullable();
            $table->string('sex');
            $table->unsignedBigInteger('kandang_id');
            $table->foreign('kandang_id')->references('id')->on('kandangs');
            $table->unsignedBigInteger('kambing_type_id');
            $table->foreign('kambing_type_id')->references('id')->on('kambing_types');
            $table->unsignedBigInteger('blood_type_id');
            $table->foreign('blood_type_id')->references('id')->on('blood_types');
            $table->bigInteger('induk_jantan_id')->unsigned()->nullable();
            $table->foreign('induk_jantan_id')->references('id')->on('kambings');
            $table->bigInteger('induk_betina_id')->unsigned()->nullable();
            $table->foreign('induk_betina_id')->references('id')->on('kambings');
            $table->text('description');
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
        Schema::dropIfExists('kambings');
    }
};
