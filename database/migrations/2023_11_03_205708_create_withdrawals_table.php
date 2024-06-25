<?php

use App\Enums\WithdrawalStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid('id')->primary();
            $table->string('order_no')->unique();
            $table->foreignId('event_id')->constrained()->unique();
            $table->string('status')->default(WithdrawalStatus::PENDING->value);
            $table->string('method');
            $table->json('details');
            $table->integer('commission');
            $table->double('amount', 15, 2);
            $table->double('actual_amount', 15, 2);
            $table->date('ended_at');
            $table->foreignId('status_id')->constrained();
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
