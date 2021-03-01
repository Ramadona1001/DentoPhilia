<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemThirdCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_third_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('second_cat');
            $table->foreign('second_cat')
                ->references('id')
                ->on('item_second_category')
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
        Schema::dropIfExists('item_third_category');
    }
}
