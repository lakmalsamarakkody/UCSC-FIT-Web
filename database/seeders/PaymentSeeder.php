<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=\Faker\Factory::create();
        for($i=0;$i<50;$i++):
            DB::table('payments')->insert(
                array (
                    [
                        'student_id'=>$faker->numberBetween($min = 1, $max = 30),
                        'method_id'=>$faker->numberBetween($min = 1, $max = 2),
                        'type_id'=>$faker->numberBetween($min = 1, $max = 3),
                        'amount'=>$faker->numerify('#####.##'),
                        'created_at'=> '2020-11-25 10:13:53',
                        'updated_at'=> '2020-11-25 10:13:53'
                    ]
                    
                )
            );
        endfor;
    }
}
