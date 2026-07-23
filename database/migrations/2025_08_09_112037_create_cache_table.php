<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->longText('value');
            $table->unsignedInteger('expiration')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cache');
    }
};
