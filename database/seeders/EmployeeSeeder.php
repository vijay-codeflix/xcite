<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'employee_id' => 'EMP1',
            'name' => 'codeflix emp',
            'phone_no' => 1234567890,
            'password' => bcrypt('12345678'),
        ];

        Employee::create($data);
        Employee::factory(10)->create();
    }
}
