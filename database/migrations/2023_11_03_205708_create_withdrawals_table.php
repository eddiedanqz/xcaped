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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique();
            $table->string('organizer');
            $table->foreignId('event_id')->constrained()->unique();
            $table->foreignId('status_id')->constrained();
            $table->string('method');
            $table->string('details');
            $table->string('account_no');
            $table->integer('commission');
            $table->double('amount', 15, 2);
            $table->double('actual_amount', 15, 2);
            $table->date('ended_at');
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
        Schema::dropIfExists('withdrawals');
    }
};
