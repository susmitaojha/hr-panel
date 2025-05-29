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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname')->nullable()->default(null);
            $table->string('lname');
            $table->string('email');
            $table->string('gender');
            $table->string('designation');
            $table->string('state');
            $table->text('skills');
            $table->string('fixedsalary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managers');
    }
};
