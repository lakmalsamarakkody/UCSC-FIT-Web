<?php

namespace Database\Seeders;

use App\Mail\StudentRegistration;
use App\Models\Student;
use App\Models\Student\Registration;
use Illuminate\Database\Seeder;

class SetDownloadVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Registration::where('created_at', '<', '2021-08-09')->update(['download_version'=> 716]);
    }
}
