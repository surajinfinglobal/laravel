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
    Schema::create('projects', function (Blueprint $table) {

        $table->id();

        $table->string('title');

        $table->string('category');

        $table->string('image');

        $table->string('github')->nullable();

        $table->string('demo')->nullable();

        $table->string('technology');

        $table->longText('description');

        $table->string('status');

        $table->timestamps();

    });
}
};
