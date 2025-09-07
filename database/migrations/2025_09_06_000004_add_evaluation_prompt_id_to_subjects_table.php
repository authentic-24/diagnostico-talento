<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('evaluation_prompt_id')->nullable()->constrained('evaluation_prompts')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['evaluation_prompt_id']);
            $table->dropColumn('evaluation_prompt_id');
        });
    }
};
