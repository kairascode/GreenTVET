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
        Schema::create('tree_plantings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('tree_species_id')->constrained()->onDelete('cascade');
            $table->integer('quantity_planted');
            $table->date('planting_date');
            $table->enum('growth_stage', ['seedling', 'sapling', 'mature', 'harvested'])->default('seedling');
            $table->string('pictorial_evidence')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tree_plantings');
    }
};
