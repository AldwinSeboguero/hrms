<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport; // Create this import class
use App\Models\Employee;
class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Import data from the Excel or CSV file
        $data = Excel::toArray(new EmployeesImport, 'database\seeders\email.csv'); // or .csv
        // dd($data);
        foreach ($data[0] as $row) {
            // Assuming the first row is the header
            if (!isset($row[0], $row[2])) {
                continue; // Skip if required fields are not present
            }

            // Find the employee by ID and update the email_address
            $employee = Employee::find($row[0]);
            if ($employee) {
                $employee->email_address = $row[2];
                $employee->save();
            }
        }
    }
}
