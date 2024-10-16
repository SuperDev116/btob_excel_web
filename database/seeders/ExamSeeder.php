<?php

namespace Database\Seeders;

use App\Models\Exam;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 30; $i++) { 
            # code...
            Exam::create([
                'subject_id' => $i,
                'date' => '2024-10-' . $i,
                'result' => $i * 3,
            ]);
        }
    }
}
