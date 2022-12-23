<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('label')->nullable();
            $table->string('tagline')->nullable();
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('websites');
    }
};
