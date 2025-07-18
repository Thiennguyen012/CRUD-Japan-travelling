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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id('restaurant_id')->autoIncrement();
            $table->string('restaurant_name');
            $table->string('description');
            $table->string('address');
            $table->integer('prefecture_id');
            $table->string('contact');
            $table->decimal('price', 3, 2);
            $table->timestamps();
            // tạo foreign key với bảng perfecture
            $table->foreign('prefecture_id')->references('prefecture_id')->on('prefectures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
