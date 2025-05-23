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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('desc');
            $table->boolean('comment_able')->default(1);
            $table->bigInteger('num_of_views')->default(0);
            $table->boolean('status')->default(1);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');//اول طريقة
            $table->foreignId('category_id')->references('id')->on
            ('categories')->onDelete('cascade'); //تاني طريقة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
