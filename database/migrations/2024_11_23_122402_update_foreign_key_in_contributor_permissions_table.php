<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DELETE FROM contributor_permissions WHERE contributor_id IS NOT NULL AND contributor_id NOT IN (SELECT id FROM contributors)');

        Schema::table('contributor_permissions', function (Blueprint $table) {
            $foreignKey = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_NAME', 'contributor_permissions')
                ->where('COLUMN_NAME', 'contributor_id')
                ->whereNotNull('CONSTRAINT_NAME')
                ->value('CONSTRAINT_NAME');

            if ($foreignKey) {
                $table->dropForeign($foreignKey);
            }

            $table->unsignedBigInteger('contributor_id')->nullable()->change();

            $table->foreign('contributor_id')
                ->references('id')
                ->on('contributors')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contributor_permissions', function (Blueprint $table) {
            $foreignKey = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_NAME', 'contributor_permissions')
                ->where('COLUMN_NAME', 'contributor_id')
                ->whereNotNull('CONSTRAINT_NAME')
                ->value('CONSTRAINT_NAME');

            if ($foreignKey) {
                $table->dropForeign($foreignKey);
            }

            $table->unsignedBigInteger('contributor_id')->nullable(false)->change();

            $table->foreign('contributor_id')
                ->references('id')
                ->on('contributors')
                ->onDelete('CASCADE');
        });
    }
};
