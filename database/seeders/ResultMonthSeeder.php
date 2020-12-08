<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=\Faker\Factory::create();
        for($i=0;$i<10;$i++):
            DB::table('result_months')->insert(
                array (
                    [
                        'year'=>$faker->year(),
                        'month'=>$faker->randomElement($array = array ('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')),
                        'created_at'=> '2020-11-25 10:13:53',
                        'updated_at'=> '2020-11-25 10:13:53'
                    ]
                    
                )
            );
        endfor;
    }
}
