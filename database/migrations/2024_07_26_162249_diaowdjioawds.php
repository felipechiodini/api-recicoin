<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_collects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('collect_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collect_id')->references('id')->on('user_collects');
            $table->string('type');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('collect_id')->references('id')->on('user_collects');
            $table->string('type');
            $table->integer('value');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('cep');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};