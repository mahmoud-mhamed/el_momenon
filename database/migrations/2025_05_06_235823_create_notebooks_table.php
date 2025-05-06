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
        Schema::dropIfExists('notebooks');
        Schema::create('notebooks', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained()->nullOnDelete();
            $table->double('currency_amount')->nullable();
            $table->double('eg_currency_amount')->nullable();
            $table->string('statement')->nullable();
            $table->string('sender')->nullable();
            $table->string('recipient')->nullable();

            $table->nullableMorphs('created_by','notebook_created_by',50);
            $table->nullableMorphs('updated_by','notebook_updated_by',50);
            $table->nullableMorphs('deleted_by','notebook_deleted_by',50);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notebooks');
    }
};
