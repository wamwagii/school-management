<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guardians');
    }
};