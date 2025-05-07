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
        Schema::table('employee_leaves', function (Blueprint $table) {
            
            $table->decimal('days_with_pay', 8, 3)->nullable(); // Example of precision (5, 3)
            $table->decimal('days_without_pay', 8, 3)->nullable()->after('days_with_pay'); // Example of precision (5, 3) // Adding after 'days_with_pay'
            $table->string('position')->nullable()->after('days_without_pay'); // Adding position column
            $table->decimal('salary', 10, 2)->nullable()->after('position'); // Adding salary column
            $table->string('credit_to')->nullable()->after('salary');
            $table->decimal('vearned', 10, 2)->nullable()->after('credit_to'); // Adding salary column
            $table->decimal('searned', 10, 2)->nullable()->after('vearned'); // Adding salary column
            $table->decimal('vless', 10, 2)->nullable()->after('searned'); // Adding salary column
            $table->decimal('sless', 10, 2)->nullable()->after('vless'); // Adding salary column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->dropColumn('days_with_pay');
            $table->dropColumn('days_without_pay');
            $table->dropColumn('position');
            $table->dropColumn('salary');
            $table->dropColumn('vearned');
            $table->dropColumn('searned');
            $table->dropColumn('vless');
            $table->dropColumn('sless');
            //
        });
    }
};
