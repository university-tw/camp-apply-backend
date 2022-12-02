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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_id');

            $table->string('name');
            $table->integer('price');
            $table->text('description')->nullable();
            $table->dateTime('priceValidUntil')->nullable();
            $table->integer('limit')->nullable(); // 限制報名人數

            $table->boolean('group')->default(false); // 是否為團體報名

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
        Schema::dropIfExists('offers');
    }
};
