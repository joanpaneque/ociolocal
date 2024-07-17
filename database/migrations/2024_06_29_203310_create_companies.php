<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name')->unique();
            $table->string('company_email');
            $table->string('company_phone');
            $table->string('company_address');
            $table->string('company_nif');
            $table->string('legal_representative_name');
            $table->string('legal_representative_email');
            $table->string('legal_representative_phone');
            $table->string('iban');
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
