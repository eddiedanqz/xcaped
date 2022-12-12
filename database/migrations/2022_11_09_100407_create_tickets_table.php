<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')->unsignedBigInteger();
            $table->string('title');
            $table->integer('capacity')->unsigned();
            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();
            $table->double('price', 15, 2);

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
