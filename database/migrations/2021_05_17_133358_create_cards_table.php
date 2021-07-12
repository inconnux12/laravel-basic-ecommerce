<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('willaya');
            $table->string('ville');
            $table->integer('zip_code');
            $table->string('card_name');
            $table->bigInteger('card_number');
            $table->integer('card_exp_mm');
            $table->integer('card_exp_yy');
            $table->integer('card_cvc');
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
        Schema::dropIfExists('cards');
    }
}
