<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('akun_staff', function (Blueprint $table) {
            $table->id();
            $table->string('username', 55)->unique();
            $table->string('password', 255);
            $table->string('firstName', 55);
            $table->string('lastName', 55);
            $table->string('email', 255);
            $table->string('file')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('akun_staff');
    }
};
