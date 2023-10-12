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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('dealer_name');
            $table->string('dealer_contact_name');
            $table->float('credit_amount', 8, 2, true);
            $table->integer('credit_term');
            $table->float('loan_interest_rate', 8, 8, true);
            $table->text('loan_motivation');
            $table->unsignedTinyInteger('status');
            $table->integer('bank_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
