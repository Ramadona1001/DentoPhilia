<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemSecondCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_second_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('first_cat');
            $table->foreign('first_cat')
                ->references('id')
                ->on('item_first_category')
                ->onDelete('cascade');
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
        Schema::dropIfExists('item_second_category');
    }
}
