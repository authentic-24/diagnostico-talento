<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('evaluation_analysis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
            $table->text('prompt');
            $table->longText('analysis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluation_analysis');
    }
};
