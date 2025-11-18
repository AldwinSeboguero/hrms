<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryIpcrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_ipcr', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('employee_id'); // Foreign key reference 
            $table->year('year');
            $table->decimal('numerical_rating', 5, 2); // Numerical rating
            $table->string('adjectival_rating'); // Adjectival rating
            $table->text('comment_and_recommendation')->nullable(); // Comments and recommendations
                 $table->enum('type', ['ipcr', 'opcr']); // Type column
            $table->timestamps(); // Created at and updated at timestamps
            
            // Foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summary_ipcr', function (Blueprint $table) {
            $table->dropForeign(['employee_id']); // Drop foreign key constraint
        });

        Schema::dropIfExists('summary_ipcr'); // Drop the table
    }
}