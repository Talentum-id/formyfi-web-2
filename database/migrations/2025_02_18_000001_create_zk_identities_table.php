<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zk_identities', function (Blueprint $table) {
            $table->id();
            $table->string('provider');
            $table->string('provider_id');
            $table->string('salt');
            $table->string('private_key');
            $table->string('max_epoch');
            $table->string('randomness');
            $table->string('audience');
            $table->json('zero_knowledge_proof')->nullable();
            $table->timestamp('zero_knowledge_proof_expired')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zk_identities');
    }
};
