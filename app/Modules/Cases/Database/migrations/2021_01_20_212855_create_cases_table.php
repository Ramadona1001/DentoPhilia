<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->text('preoperative_title');
            $table->text('preoperative_image');

            $table->text('processingoperative_title');
            $table->text('processingoperative_image');

            $table->text('postoperative_title');
            $table->text('postoperative_image');

            $table->text('patient_name')->nullable();
            $table->string('patient_age')->nullable();
            $table->text('patient_dental_history')->nullable();
            $table->text('patient_medical_history')->nullable();

            $table->string('type');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('cases');
    }
}
