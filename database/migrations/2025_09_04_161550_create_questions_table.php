<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->text('text');
            $table->string('type')->default('scale'); // scale, yesno, text, multiple
            $table->json('options')->nullable(); // para preguntas tipo multiple/choices
            $table->integer('order')->default(0);
            $table->boolean('required')->default(true);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
