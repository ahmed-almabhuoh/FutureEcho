<?php

use App\Models\Legacy;
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
        Schema::create('legacies', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->enum('status', Legacy::STATUS);

            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legacies');
    }
};
