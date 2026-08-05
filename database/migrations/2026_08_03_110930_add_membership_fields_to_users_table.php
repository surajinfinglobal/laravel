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
    Schema::table('users', function (Blueprint $table) {

        $table->string('plan')->default('free')->after('status');

        $table->boolean('membership_status')->default(0)->after('plan');

        $table->date('membership_expiry')->nullable()->after('membership_status');

    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->dropColumn([
            'plan',
            'membership_status',
            'membership_expiry'
        ]);

    });
}
};
