<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Payment;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->date('payment_date')->nullable();
            $table->decimal('payment_amount', total: 8, places: 2)->default('0');
            $table->timestamps();
        });

        $payment = new Payment;
        $payment->payment_date = '2024/01/01';
        $payment->payment_amount = '10';
        $payment->save();

        $payment = new Payment;
        $payment->payment_date = '2024/04/01';
        $payment->payment_amount = '20';
        $payment->save();

        $payment = new Payment;
        $payment->payment_date = '2024/10/01';
        $payment->payment_amount = '30';
        $payment->save();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};