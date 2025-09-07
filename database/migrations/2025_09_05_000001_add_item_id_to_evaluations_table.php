<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable()->after('subject_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropColumn('item_id');
        });
    }
};
