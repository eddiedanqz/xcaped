<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id')->index();

            $table->string('full_name');
            $table->string('user_email');

            $table->foreignId('status_id')->constrained();
            $table->float('grand_total');
            $table->integer('quantity');

            $table->boolean('isPaid')->default(false);
            $table->enum('payment_method', ['mobile_money', 'card'])->default('mobile_money');
            $table->string('message')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('orders');
    }
}
