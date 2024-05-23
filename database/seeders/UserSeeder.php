<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('email', [
                config('app.moderator_user.email'),
                config('app.job_seeker_user.email')
            ])
            ->get();

        $moderator = $users->firstWhere('email', config('app.moderator_user.email'));
        $jobSeeker = $users->firstWhere('email', config('app.job_seeker_user.email'));

        if (!$moderator) {
            User::factory()->moderator()->create([
                'email' => config('app.moderator_user.email'),
                'password' => config('app.moderator_user.password'),
            ]);
        }

        if (!$jobSeeker) {
            User::factory()->jobSeeker()->create([
                'email' => config('app.job_seeker_user.email'),
                'password' => config('app.job_seeker_user.password'),
            ]);
        }
    }
}
