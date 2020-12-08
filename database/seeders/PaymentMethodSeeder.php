<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert(
            array (
                [
                    'method'=>'online',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'method'=>'bank slip',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ]
                
            )
        );
    }
}
