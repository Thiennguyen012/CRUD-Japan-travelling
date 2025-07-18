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
        Schema::create('table_menu', function (Blueprint $table) {
            $table->id('menu_id')->autoIncrement();
            $table->integer('restaurant_id');
            $table->string('dish_name');
            $table->decimal('price', 4, 2);
            $table->string('description');
            $table->timestamps();
            // tạo fk với bảng restaurant
            $table->foreign('restaurant_id')->references('restaurant_id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_menu');
    }
};
