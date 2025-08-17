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
        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->dropColumn('changed_at'); // eliminamos la columna antigua
            $table->timestamps(); // crea created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_status_logs', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->timestamp('changed_at')->useCurrent();
        });
    }
};
