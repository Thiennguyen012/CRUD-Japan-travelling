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
        Schema::create('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->autoIncrement();
            $table->unsignedBigInteger('hotel_id')->comment('hotel');
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->timestamp('checkin_time');
            $table->timestamp('checkout_time');
            $table->timestamps();
            $table->foreign('hotel_id')->references('hotel_id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
