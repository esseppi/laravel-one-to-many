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
            $table->unsignedBigInteger('coin_id');
            $table->unsignedBigInteger('user_id');

            $table->float('price');
            $table->float('amount');
            $table->boolean('tradeDir');
            $table->string('slug', 100)->unique();
            $table->text('comments');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('coin_id')->references('id')->on('coins')
            ->onDelete('SET NULL');
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
