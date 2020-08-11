<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(true);
            $table->string('symbol');
            $table->string('icon_url')->nullable(true);
            $table->enum('trending', ['true', 'false'])->nullable(true);
            $table->string('price')->nullable(true);
            $table->string('market_cap')->nullable(true);
            $table->string('volume_24h')->nullable(true);
            $table->string('change_24h')->nullable(true);
            $table->string('supply')->nullable(true);
            $table->longText('description')->nullable();
            $table->enum('type', ['live', 'local'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
