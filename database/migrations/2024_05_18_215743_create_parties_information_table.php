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
        Schema::create('parties_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parties_type_id');
            $table->foreign('parties_type_id')->references('id')->on('parties');
            $table->string("full_name", 100)->default('null')->nullable();
            $table->string("contact", 15)->default('null')->nullable();
            $table->text("address")->default('null')->nullable();
            $table->string("account_holder_name")->default('null')->nullable();
            $table->string("account_no")->default('null')->nullable();
            $table->string("bank_name")->default('null')->nullable();
            $table->string("ifsc_code")->default('null')->nullable();
            $table->text("branch_address")->default('null')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties_information');
    }
};
