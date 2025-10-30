<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('year_start');
            $table->date('year_end');
            $table->boolean('is_current')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_years');
    }
};
