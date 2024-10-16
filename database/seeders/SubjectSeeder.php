<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming you have some users already in the database
        $users = User::all();

        // Create 10 subjects and associate them with random users
        foreach ($users as $user) {
            for ($i=0; $i < 15; $i++) { 
                # code...
                $rnd_num = rand(1, 100);
                Subject::create([
                    'user_id' => $user->id,
                    'first_name' => 'FirstName' . $rnd_num,
                    'last_name' => 'LastName' . $rnd_num,
                    'dob' => now()->subYears(rand(18, 30)), // Random date of birth
                    'gender' => rand(0, 1) ? 'Male' : 'Female', // Random gender
                ]);
            }
        }
    }
}
