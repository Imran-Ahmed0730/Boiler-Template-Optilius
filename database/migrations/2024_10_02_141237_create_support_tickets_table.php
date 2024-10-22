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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('subject');
            $table->bigInteger('user_id')->nullable();
            $table->string('email');
            $table->bigInteger('assigned_to')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=>Open, 0=>Close');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
