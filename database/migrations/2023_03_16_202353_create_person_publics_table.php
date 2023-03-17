<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('person_publics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('municipality_id')->nullable()->constrained();
            $table->foreignId('location_id')->nullable()->constrained();
            $table->foreignId('type_person_id')->nullable()->constrained();
            $table->foreignId('type_position_id')->nullable()->constrained();
            $table->string('name')->unique();
            $table->bigInteger('active_years');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_publics');
    }
};
