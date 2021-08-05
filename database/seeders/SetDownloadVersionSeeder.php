<?php

namespace Database\Seeders;

use App\Models\Student;
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
        Student::where('id', '!=', Null)->update(['download_version'=> 1]);
    }
}
