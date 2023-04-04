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
        Schema::create('tunnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('server_id');
            $table->string('username')->unique();
            $table->string('auto_renew')->default('aktif');
            $table->string('password');
            $table->string('ip_server');
            $table->string('server');
            $table->string('ip_tunnel');
            $table->string('local_addrss');
            $table->string('domain');
            $table->string('status')->default('aktif');
            $table->string('api')->unique();
            $table->string('to_ports_api')->nullable();
            $table->string('winbox')->unique();
            $table->string('to_ports_winbox')->nullable();
            $table->string('web')->unique();
            $table->string('to_ports_web')->nullable();
            $table->dateTime('expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tunnels');
    }
};
