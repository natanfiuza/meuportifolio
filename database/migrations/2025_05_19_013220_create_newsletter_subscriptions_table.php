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
        Schema::create('newsletter_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Nome do assinante, se necessário
            $table->string('email')->unique();
            $table->boolean('is_subscribed')->default(true); // true para inscrito, false para não inscrito
            $table->timestamp('unsubscribed_at')->nullable(); // Data e hora do cancelamento da inscrição
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscriptions');
    }
};
