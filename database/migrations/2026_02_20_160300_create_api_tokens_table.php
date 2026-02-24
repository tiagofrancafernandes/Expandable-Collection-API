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
        Schema::create('api_tokens', function (Blueprint $table): void {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('token_hash', 128)->unique();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['project_id', 'id']);
        });

        Schema::create('api_token_permissions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('api_token_id')->constrained('api_tokens')->cascadeOnDelete();
            $table->foreignId('collection_id')->constrained()->cascadeOnDelete();
            $table->boolean('can_create')->default(false);
            $table->boolean('can_read')->default(false);
            $table->boolean('can_update')->default(false);
            $table->boolean('can_delete')->default(false);
            $table->boolean('is_full_access')->default(false);
            $table->timestamps();

            $table->unique(['api_token_id', 'collection_id']);
            $table->index(['collection_id', 'api_token_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_token_permissions');
        Schema::dropIfExists('api_tokens');
    }
};
