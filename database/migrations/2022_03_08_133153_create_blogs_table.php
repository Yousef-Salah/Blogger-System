<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id');
            $table->string('title');
            $table->longText('text');
            $table->unsignedInteger('total_comments')->default(0);
            $table->unsignedInteger('total_likes')->default(0);
            $table->unsignedInteger('total_dislikes')->default(0);
            $table->json('tags')->nullable();
            $table->string('image')->nullable(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
