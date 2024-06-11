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
        Schema::create('seat', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('seat_class_id');
            $table->integer('seat_position_row');
            $table->integer('seat_position_column');
            $table->boolean('available')->default(true);

            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('buyer')->onDelete('cascade');
            $table->foreign('seat_class_id')->references('id')->on('seatclass')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat');
    }
};
