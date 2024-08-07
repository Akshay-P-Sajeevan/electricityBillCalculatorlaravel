<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffRangesTable extends Migration
{
    public function up()
    {
        Schema::create('tariff_ranges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tariff_id')->constrained()->onDelete('cascade');
            $table->integer('start_units');
            $table->integer('end_units')->nullable();
            $table->decimal('rate', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tariff_ranges');
    }
}
