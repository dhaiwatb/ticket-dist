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
        Schema::create('ticket_dists', function (Blueprint $table) {
            $table->id();
            $table->text('ticket_title')->nullable();
            $table->text('ticket_number')->nullable();
            $table->text('status')->default('pending')->comment('pending, in-progress, close');
            $table->text('ticket_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_dist');
    }
};
