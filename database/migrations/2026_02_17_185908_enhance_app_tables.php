<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->decimal('monthly_income', 10, 2)->default(0)->after('phone');
            $table->string('need_level')->default('متوسط')->after('monthly_income'); 
        });

       
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('supporter_id');
            $table->string('supporter_type');
            $table->uuid('beneficiary_id')->nullable(); 
            $table->decimal('amount', 10, 2);
            $table->string('category')->default('عام'); 
            $table->date('date');
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->integer('cases_handled_count')->default(0);
            $table->integer('assistance_disbursed_count')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropColumn(['monthly_income', 'need_level']);
        });
        Schema::dropIfExists('donations');
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['cases_handled_count', 'assistance_disbursed_count']);
        });
    }
};
