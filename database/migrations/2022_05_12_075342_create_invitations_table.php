<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sender_id')->references('id')->on('users');
            $table->string('email');
            $table->string('tenant_id');
            $table->string('token')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['email', 'tenant_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('invitations');
    }
};
