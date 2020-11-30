<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AnnouncementSeeder::class,
            ExamSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            SubjectSeeder::class
        ]);
    }
}
