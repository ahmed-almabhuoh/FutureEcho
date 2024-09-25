<?php

use App\Models\Contributor;
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
        Schema::create('contributor_permissions', function (Blueprint $table) {
            $table->id();
            $table->enum('permission', Contributor::Permissions);

            $table->foreignId('contributor_id')->constrained('contributors', 'user_id')->cascadeOnDelete();
            $table->foreignId('capsule_id')->constrained('capsules', 'id')->cascadeOnDelete();

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributor_permissions');
    }
};
