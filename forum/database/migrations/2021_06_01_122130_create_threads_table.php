<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('threads');
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('user_id');
            // Does not work...
//            $table->foreignId('channel_id')
//                ->constrained()
//                ->onDelete('cascade');
//            $table->foreignId('user_id')
//                ->constrained()
//                ->onDelete('cascade');

            // Best Answer ID
            $table->unsignedBigInteger('best_answer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
