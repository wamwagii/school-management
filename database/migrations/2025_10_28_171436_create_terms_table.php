<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('term_start');
            $table->date('term_end');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('terms');
    }
};