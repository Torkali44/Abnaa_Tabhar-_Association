<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('serial_code')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('social_status')->nullable();
            $table->string('address')->nullable();
            $table->string('national_id')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('has_children')->default(false);
            $table->json('children')->nullable();
            $table->json('family_status')->nullable();
            $table->json('needs')->nullable();
            $table->json('supporting_entity')->nullable();
            $table->json('attachments')->nullable();
            $table->json('assistance_history')->nullable();
            $table->timestamps();
        });

        Schema::create('supporter_orgs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->json('support_type')->nullable();
            $table->string('assistance_time')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });

        Schema::create('supporter_individuals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('national_id')->nullable();
            $table->string('donation_type')->nullable();
            $table->string('donation_amount')->nullable();
            $table->string('donation_time')->nullable();
            $table->string('donation_date')->nullable();
            $table->string('contact_method')->nullable();
            $table->string('payment_method')->nullable();
            $table->json('donation_goal')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('job_type')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('monthly_salary', 10, 2)->nullable();
            $table->json('vacations')->nullable();
            $table->json('absences')->nullable();
            $table->json('late_records')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
        Schema::dropIfExists('supporter_orgs');
        Schema::dropIfExists('supporter_individuals');
        Schema::dropIfExists('employees');
    }
};
