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
        Schema::create('support_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('support_ticket_id');
            $table->text('message')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1=>Message, 2=>Image, 3=>File');
            $table->tinyInteger('sent_by')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_contents');
    }
};
