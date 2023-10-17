<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');
            $table->string('type');
            $table->text('description');
            $table->string('banner')->nullable();
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->string('venue');
            $table->string('address')->nullable();
            $table->double('address_latitude')->nullable();
            $table->double('address_longitude')->nullable();
            $table->enum('status', ['pending', 'published', 'cancelled', 'ended'])->default('pending');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('author');
            $table->rememberToken();
            $table->timestamps();
            $table->index('user_id');

            $table->foreign('author')->references('username')->on('users')->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
