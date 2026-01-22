<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendances', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('event_date_id')->constrained("event_dates");// Foreign key referencing event_dates
            $table->foreignId('participant_id')->constrained("event_participants"); // Foreign key referencing participants (assuming you have a participants table)
            $table->dateTime('date_time_arrive'); // Column for arrival date and time
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_attendances');
    }
}
