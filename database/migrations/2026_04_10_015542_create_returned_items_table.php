<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('returned_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('borrowed_item_id')->constrained('borrowed_items')->onDelete('cascade');
        $table->dateTime('return_date');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returned_items');
    }
};
