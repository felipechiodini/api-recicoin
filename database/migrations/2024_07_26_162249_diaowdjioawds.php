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

        Schema::create('collect_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collect_id')->references('id')->on('user_collects');
            $table->string('cep');
            $table->string('street');
            $table->string('number');
            $table->string('city');
            $table->string('state');
            $table->string('complement')->nullable();
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
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('cep');
            $table->string('street');
            $table->string('number');
            $table->string('complement');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
        });

        Schema::create('user_withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('value');
            $table->string('status');
            $table->timestamps();
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
