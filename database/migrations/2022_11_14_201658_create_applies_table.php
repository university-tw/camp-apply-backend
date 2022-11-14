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
        Schema::create('applies', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignId('camp_time_id');
            $table->foreignId('offer_id');
            $table->foreignId("user_id");
            $table->foreignUlid('group_id')->nullable();

            $table->string('bank_code')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('bank_comment')->nullable();

            $table->dateTime('paid_at')->nullable();

            $table->json('data');

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
        Schema::dropIfExists('applies');
    }
};
