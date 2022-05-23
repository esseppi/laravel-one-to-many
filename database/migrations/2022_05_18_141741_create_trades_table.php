<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('baseCoin_id');
            $table->unsignedBigInteger('foreignCoin_id');
            $table->string('slug', 100)->unique();

            $table->float('basePrice');
            $table->float('foreignPrice');
            $table->float('baseAmount');
            $table->float('foreignAmount');
            $table->date('date');
            $table->boolean('tradeDir');
            $table->text('comments')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('baseCoin_id')->references('id')->on('coins');
            $table->foreign('foreignCoin_id')->references('id')->on('coins');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
