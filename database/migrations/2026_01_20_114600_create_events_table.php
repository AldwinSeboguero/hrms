<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing ID column
            $table->string('name'); // Creates a string column for the event name
            $table->string('venue'); // Creates a string column for the event venue
            $table->string('when'); // Creates a date-time column for when the event occurs
            $table->timestamps(); // Creates created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events'); // Drops the events table
    }
}
