<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScannedByToEventAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_attendances', function (Blueprint $table) {
            $table->foreignId('scanned_by')->nullable()->constrained('users')->onDelete('set null'); // Add scanned_by column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_attendances', function (Blueprint $table) {
            $table->dropForeign(['scanned_by']); // Drop foreign key constraint
            $table->dropColumn('scanned_by'); // Drop the column
        });
    }
}
