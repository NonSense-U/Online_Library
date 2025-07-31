<?php

use App\Models\Author;
use App\Models\Publisher;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('isbn');
            $table->foreignIdFor(Author::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Publisher::class)->constrained()->cascadeOnDelete();
            $table->integer('release_year');
            $table->decimal('price');
            //TODO LANGUAGEs
            $table->integer('stock');
            $table->string('cover_image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
