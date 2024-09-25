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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('before')->default(1);
            $table->string('message');

            $table->foreignId('memory_id')->nullable()->constrained('memories', 'id')->cascadeOnDelete();
            $table->foreignId('capsule_id')->nullable()->constrained('capsules', 'id')->cascadeOnDelete();

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
