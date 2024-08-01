<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('activity_name');
            $table->string('description')->nullable();
            $table->boolean('season');
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_event')->nullable();
            $table->integer('max_concurrent_people')->nullable();
            $table->json('weekly_schedule');
            $table->json('ticket_types');
            $table->string('contribution');
            $table->integer('clicks')->default(0);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
