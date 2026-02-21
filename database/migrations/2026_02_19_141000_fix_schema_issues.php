<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->string('serial_code')->change();
        });

        Schema::table('supporter_orgs', function (Blueprint $table) {
            if (!Schema::hasColumn('supporter_orgs', 'phone')) {
                $table->string('phone')->nullable()->after('name');
            }
            if (!Schema::hasColumn('supporter_orgs', 'address')) {
                $table->string('address')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('supporter_orgs', 'donation_time')) {
                $table->string('donation_time')->nullable()->after('assistance_time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->integer('serial_code')->change();
        });

        Schema::table('supporter_orgs', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'donation_time']);
        });
    }
};
