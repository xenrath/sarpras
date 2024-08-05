<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telp')->unique();
            $table->string('password');
            $table->string('password_text');
            $table->string('nipy')->nullable();
            $table->string('ttd')->nullable();
            $table->enum('role', array('dev', 'sarpras', 'bauk', 'sarana', 'prasarana'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
