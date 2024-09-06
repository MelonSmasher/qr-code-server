<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ppsk_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppsk_id')->constrained()->onDelete('cascade');
            $table->string('qr_code_path')->nullable();
            $table->string('ssid');
            $table->string('security');
            $table->string('identity')->nullable();
            $table->boolean('hidden')->default(false);
            $table->string('passphrase')->nullable();
            $table->string('eap_method')->nullable();
            $table->string('phase_two_auth')->nullable();
            $table->boolean('anonymous_outer_identity')->default(false);
            $table->string('created_for');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ppsk_settings');
    }
};
