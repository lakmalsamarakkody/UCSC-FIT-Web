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
            RoleSeeder::class,
            UserSeeder::class,
            TitleSeeder::class,
            SubjectSeeder::class,
            StudentPhaseSeeder::class,
            ExamTypeSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            BankSeeder::class,
            BankBranchSeeder::class,
            PaymentTypeSeeder::class,
            PaymentMethodSeeder::class,
            SlProvinceSeeder::class,
            SlDistrictSeeder::class,
            WorldContinentsTableSeeder::class,
            WorldCountriesTableSeeder::class,
            WorldDivisionsTableSeeder::class,
            WorldCitiesTableSeeder::class,
            FeeSeeder::class,
            DurationSeeder::class,
        ]);
    }
}
