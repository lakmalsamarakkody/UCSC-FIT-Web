<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert(
            array (
                [
                    'name'=>'Peoples Bank',
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
                [
                    'name'=>'Sampath Bank',
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
            )
        );
    }
}
