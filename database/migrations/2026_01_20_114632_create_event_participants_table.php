<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID column
            $table->uuid('uuid'); // UUID column for unique identification
            $table->foreignId('employee_id')->nullable()->constrained('employees');;// Nullable foreign key for employee_id
            $table->foreignId('event_id')->constrained('events');; // Foreign key for event_id
            $table->string('name'); // Column for participant's name
            $table->string('position'); // Column for participant's position
            $table->string('office'); // Column for participant's office
            $table->timestamps(); // Created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_participants'); // Drop the event_participants table
    }
}
