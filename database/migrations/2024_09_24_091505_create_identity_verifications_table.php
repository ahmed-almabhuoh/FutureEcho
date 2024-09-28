<?php

use App\Models\IdentityVerification;
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
        Schema::create('identity_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->enum('status', IdentityVerification::STATUS);
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity_verifications');
    }
};
