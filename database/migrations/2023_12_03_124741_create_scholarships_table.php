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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->text("sponsor");
            $table->double("amount")->nullable();
            $table->integer("number_of_awards")->default(1);
            $table->timestamp("deadline")->nullable();
            $table->text("url");
            $table->string("academic_level");
            $table->text("cover_image")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
