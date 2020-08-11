<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exchange_id');
            $table->string('name');
            $table->string('logo_url')->nullable();
            $table->string('centralization_type')->nullable();
            $table->string('grade_points')->nullable();
            $table->string('grade')->nullable();
            $table->string('market_quality')->nullable();
            $table->string('avg_rating')->nullable();
            $table->string('country')->nullable();
            $table->longText('description')->nullable();
            $table->longText('full_address')->nullable();
            $table->longText('fees')->nullable();
            $table->longText('deposit_methods')->nullable();
            $table->longText('withdrawal_methods')->nullable();
            $table->string('affiliate_url')->nullable();
            $table->string('sponsored')->nullable();
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
        Schema::dropIfExists('exchanges');
    }
}
