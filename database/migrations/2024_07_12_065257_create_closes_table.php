<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('closes', function (Blueprint $table) {
            $table->id();
            $table->string("price");
            $table->dateTime('date')->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->unsignedBigInteger("trade_id");
            $table->foreign("trade_id")->references("id")->on("trades");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('closes');
    }
};
