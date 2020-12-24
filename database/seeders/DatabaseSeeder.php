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
            //ExamSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            //StudentSeeder::class,
            SubjectSeeder::class,
            StudentPhaseSeeder::class,
            ExamTypeSeeder::class,
            //ExamScheduleSeeder::class,
            //StudentRegistrationSeeder::class,
            //StudentFlagSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            PaymentTypeSeeder::class,
            PaymentMethodSeeder::class,
            PaymentSeeder::class,
            //StudentExamSeeder::class,
            TitleSeeder::class,
            SlProvinceSeeder::class,
            SlDistrictSeeder::class,
            SlCitiesSeeder::class,
            WorldContinentsTableSeeder::class,
            WorldCountriesTableSeeder::class,
            WorldDivisionsTableSeeder::class,
            WorldCitiesTableSeeder::class,
        ]);
    }
}
