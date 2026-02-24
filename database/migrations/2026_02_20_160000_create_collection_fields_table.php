<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collection_fields', function (Blueprint $table): void {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('collection_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reference_collection_id')->nullable()->constrained('collections')->nullOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->boolean('is_nullable')->default(false);
            $table->boolean('is_indexed')->default(false);
            $table->json('default_value')->nullable();
            $table->json('validation_rules')->nullable();
            $table->string('generator_expression')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->unique(['collection_id', 'slug']);
            $table->index(['project_id', 'collection_id']);
            $table->index(['collection_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_fields');
    }
};
