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
        Schema::create('search_log_person_publics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('search_log_id')->constrained();
            $table->foreignId('person_public_id')->constrained();
            $table->decimal('percent_match', 6, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_log_person_publics');
    }
};
