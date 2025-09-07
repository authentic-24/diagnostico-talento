<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');        // persona evaluada
            $table->unsignedBigInteger('evaluator_id')->nullable(); // quien evalúa (user) o null si anónimo
            $table->string('status')->default('draft'); // draft | completed
            $table->decimal('total_score', 5, 2)->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
