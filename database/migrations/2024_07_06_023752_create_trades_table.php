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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string("symbol");
            $table->enum("type",["BUY","SELL","BUY_LIMIT","SELL_LIMIT","BUY_STOP","SELL_STOP"]);
            $table->string("timeframe");
            $table->double("entry_vol");
            $table->double("entry_price");
            $table->double("sl")->nullable();
            $table->dateTime("entry_date")->default(DB::raw("CURRENT_TIMESTAMP"))->nullable();
            $table->string("description")->nullable();
            $table->unsignedBigInteger("strategy_id")->nullable();
            $table->foreign("strategy_id")->references("id")->on("strategies")->onDelete("set null")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
