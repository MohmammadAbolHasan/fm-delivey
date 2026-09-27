<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {

            $table->id();

            $table->string('invoice_number')->unique();

            $table->foreignId('client_id')->constrained()->cascadeOnDelete();

            $table->foreignId('driver_id')->constrained()->cascadeOnDelete();

            $table->string('receiver_name');

            $table->string('receiver_phone')->nullable();

            $table->text('receiver_address');

            $table->decimal('amount',10,2)->default(0);

            $table->date('invoice_date');

            $table->enum('status',[
                'Pending',
                'Done',
                'Rejected',
                'Delayed'
            ])->default('Pending');

            $table->text('notes')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};