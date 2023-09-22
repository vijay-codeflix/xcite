<?php

namespace Database\Seeders;

use App\Models\branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branch = [
            [
                'branch_name' => 'Branch 1',
                'address' => 'Branch 1 Address',
                'phone_no' => '9985654125',
                'opening_time' => '2023-09-21 10:41:38',
                'closing_time' => '2023-09-21 12:41:38'
            ],
            [
                'branch_name' => 'Branch 2',
                'address' => 'Branch 2 Address',
                'phone_no' => '0865854125',
                'opening_time' => '2023-09-21 10:41:38',
                'closing_time' => '2023-09-21 12:41:38'
            ],
            [
                'branch_name' => 'Branch 3',
                'address' => 'Branch 3 Address',
                'phone_no' => '7633654925',
                'opening_time' => '2023-09-21 04:41:38',
                'closing_time' => '2023-09-21 09:41:38'
            ],
        ];

        branch::insert($branch);
    }
}
