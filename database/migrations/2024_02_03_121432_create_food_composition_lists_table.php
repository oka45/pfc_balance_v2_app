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
        Schema::create('food_composition_lists', function (Blueprint $table) {
            $table->comment('食品成分表');
            $table->id();
            $table->string('food_name')->comment('食品名');
            $table->decimal('protein', $precision = 6, $scale = 1)->comment('プロテイン');
            $table->decimal('carbohydrate', $precision = 6, $scale = 1)->comment('炭水化物');
            $table->decimal('fat', $precision = 6, $scale = 1)->comment('脂質');
            $table->decimal('salt_equivalents', $precision = 6, $scale = 1)->comment('食塩');
            $table->decimal('calorie', $precision = 6, $scale = 1)->comment('100gあたりのカロリー');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_composition_lists');
    }
};
