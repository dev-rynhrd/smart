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
        $connection = 'SMART';

        // 1. Table: users
        if (!Schema::connection($connection)->hasTable('users')) {
            Schema::connection($connection)->create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('username')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // 2. Table: sessions
        if (!Schema::connection($connection)->hasTable('sessions')) {
            Schema::connection($connection)->create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $connection = 'SMART';
        
        Schema::connection($connection)->dropIfExists('sessions');
        Schema::connection($connection)->dropIfExists('users');
    }
};
