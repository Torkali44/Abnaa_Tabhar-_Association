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
        if (Schema::hasTable('beneficiaries')) {
            Schema::table('beneficiaries', function (Blueprint $table) {
                if (Schema::hasColumn('beneficiaries', 'serial_code')) {
                    $table->renameColumn('serial_code', 'old_serial_code');
                }
            });

            Schema::table('beneficiaries', function (Blueprint $table) {
                $table->string('serial_code')->nullable()->after('id');
            });

            \DB::table('beneficiaries')->update(['serial_code' => \DB::raw('old_serial_code')]);

            Schema::table('beneficiaries', function (Blueprint $table) {
                $table->dropColumn('old_serial_code');
            });
        }

        if (Schema::hasTable('supporter_orgs')) {
            Schema::table('supporter_orgs', function (Blueprint $table) {
                if (!Schema::hasColumn('supporter_orgs', 'phone')) {
                    $table->string('phone')->nullable()->after('name');
                }
                if (!Schema::hasColumn('supporter_orgs', 'address')) {
                    $table->string('address')->nullable()->after('phone');
                }
            });
        }
    }

    public function down(): void
    {
    
    }
};
