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
            $table->string('pname');
            $table->string('hours');
            $table->string('status');
            $table->string('priority');
            $table->unsignedBigInteger('managerid')->nullable();
            $table->foreign('managerid')->references('id')->on('managers')->onDelete('cascade');
            $table->string('assign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
