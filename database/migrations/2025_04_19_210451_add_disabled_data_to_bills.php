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
        \App\Classes\Helpmate::dropConstrainedForeignIdIfExist('bills', 'disabled_client_id');
        \App\Classes\Helpmate::dropConstrainedForeignIdIfExist('archives', 'disabled_client_id');
        Schema::table('bills', function (Blueprint $table) {
            $table->after('client_id', function (Blueprint $table) {
                $table->string('disabled_name')->nullable();
                $table->string('disabled_national_id')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('disabled_name');
            $table->dropColumn('disabled_national_id');
        });
    }
};
