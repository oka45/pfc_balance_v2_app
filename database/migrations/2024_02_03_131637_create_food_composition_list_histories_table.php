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
        Schema::create('food_composition_list_histories', function (Blueprint $table) {
            $table->comment('食品構成表履歴');
            $table->id();
            $table->string('file_name')->comment('ファイル名');
            $table->string('version')->comment('食品構成表のバージョン');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_composition_list_histories');
    }
};
