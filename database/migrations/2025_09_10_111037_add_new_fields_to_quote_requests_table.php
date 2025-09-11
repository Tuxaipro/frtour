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
        Schema::table('quote_requests', function (Blueprint $table) {
            $table->json('destinations')->nullable()->after('number_of_travelers');
            $table->json('services')->nullable()->after('destinations');
            $table->string('travel_style')->nullable()->after('services');
            $table->string('travel_dates')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote_requests', function (Blueprint $table) {
            $table->dropColumn(['destinations', 'services', 'travel_style']);
            $table->date('travel_dates')->nullable()->change();
        });
    }
};
