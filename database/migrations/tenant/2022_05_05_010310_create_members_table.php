<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('global_id');
            $table->string('name');
            $table->string('email');
            $table->string('role');
            $table->timestamps();
        });

        Schema::table('members', function (Blueprint $table) {
            $table->foreignUuid('invited_by')->nullable()->references('id')->on('members');
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
};
