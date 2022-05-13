<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create('tenant_user', function (Blueprint $table) {
            $table->string('tenant_id');
            $table->foreignUuid('user_id')->constrained();

            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenant_user');
    }
};
