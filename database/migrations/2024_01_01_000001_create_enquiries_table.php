<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100);
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('country', 50)->nullable();
            $table->string('qualification', 50)->nullable();
            $table->text('message')->nullable();
            $table->string('status', 20)->default('new'); // new, read, contacted, enrolled, rejected
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
