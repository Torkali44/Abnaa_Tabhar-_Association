<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('supporter_orgs', function (Blueprint $table) {
            if (!Schema::hasColumn('supporter_orgs', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('supporter_orgs', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('supporter_orgs', 'donation_amount')) {
                $table->decimal('donation_amount', 15, 2)->nullable();
            }
        });

        if (Schema::hasTable('beneficiaries')) {
            
            try {
                Schema::table('beneficiaries', function (Blueprint $table) {
                    $table->string('serial_code')->nullable()->change();
                });
            } catch (\Exception $e) {
                Schema::table('beneficiaries', function (Blueprint $table) {
                    if (Schema::hasColumn('beneficiaries', 'serial_code')) {
                        $table->renameColumn('serial_code', 'temp_sc');
                    }
                });
                Schema::table('beneficiaries', function (Blueprint $table) {
                    $table->string('serial_code')->nullable()->after('id');
                });
                \DB::statement('UPDATE beneficiaries SET serial_code = CAST(temp_sc AS CHAR) WHERE temp_sc IS NOT NULL');
                Schema::table('beneficiaries', function (Blueprint $table) {
                    if (Schema::hasColumn('beneficiaries', 'temp_sc')) {
                        $table->dropColumn('temp_sc');
                    }
                });
            }
            
            Schema::table('beneficiaries', function (Blueprint $table) {
                if (!Schema::hasColumn('beneficiaries', 'need_level')) {
                    $table->string('need_level')->nullable();
                }
                if (!Schema::hasColumn('beneficiaries', 'monthly_income')) {
                    $table->decimal('monthly_income', 10, 2)->nullable();
                }
            });
        }
    }

    public function down(): void {}
};
