<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('contacts')->truncate();
        DB::table('contacts')->insert(
            array (
                [
                    'type'=>'elc-email',
                    'name'=>null,
                    'email'=>'elc@ucsc.cmb.ac.lk',
                    'telephone1'=>null,
                    'telephone2'=>null,
                    'occupation'=>null,
                    'address_1'=>null,
                    'address_2'=>null,
                    'address_3'=>null,
                    'address_4'=>null,
                    'address_5'=>null,
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
                [
                    'type'=>'admin',
                    'name'=>null,
                    'email'=>'admin@fit.bit.lk',
                    'telephone1'=>null,
                    'telephone2'=>null,
                    'occupation'=>null,
                    'address_1'=>null,
                    'address_2'=>null,
                    'address_3'=>null,
                    'address_4'=>null,
                    'address_5'=>null,
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
                [
                    'type'=>'coordinator',
                    'name'=>'Dr. T. A. Weerasinghe',
                    'email'=>'taw@ucsc.cmb.ac.lk',
                    'telephone1'=>'+94 11 2591080',
                    'telephone2'=>null,
                    'occupation'=>'Coordinator (FIT) and Coordinator (e-LC)',
                    'address_1'=>null,
                    'address_2'=>null,
                    'address_3'=>null,
                    'address_4'=>null,
                    'address_5'=>null,
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
                [
                    'type'=>'director',
                    'name'=>'Prof. K. P. Hewagamage',
                    'email'=>'kph@ucsc.cmb.ac.lk',
                    'telephone1'=>'+94 11 2158950',
                    'telephone2'=>null,
                    'occupation'=>'Director (UCSC)',
                    'address_1'=>null,
                    'address_2'=>null,
                    'address_3'=>null,
                    'address_4'=>null,
                    'address_5'=>null,
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
                [
                    'type'=>'elc-telephone',
                    'name'=>null,
                    'email'=>null,
                    'telephone1'=>'+94 11 2158950',
                    'telephone2'=>null,
                    'occupation'=>null,
                    'address_1'=>null,
                    'address_2'=>null,
                    'address_3'=>null,
                    'address_4'=>null,
                    'address_5'=>null,
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
                [
                    'type'=>'elc-address',
                    'name'=>null,
                    'email'=>'elc@ucsc.cmb.ac.lk',
                    'telephone1'=>null,
                    'telephone2'=>null,
                    'occupation'=>null,
                    'address_1'=>'e-Learning Centre',
                    'address_2'=>'University of Colombo School of Computing',
                    'address_3'=>'No. 35, Reid Avenue',
                    'address_4'=>'Colombo 07',
                    'address_5'=>'Sri Lanka',
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
                [
                    'type'=>'ucsc-address',
                    'name'=>null,
                    'email'=>null,
                    'telephone1'=>null,
                    'telephone2'=>null,
                    'occupation'=>null,
                    'address_1'=>null,
                    'address_2'=>'University of Colombo School of Computing',
                    'address_3'=>'No. 35, Reid Avenue',
                    'address_4'=>'Colombo 07',
                    'address_5'=>'Sri Lanka',
                    'created_at' => '2021-01-05 09:32:41',
                    'updated_at' => '2021-01-05 09:32:41'
                ],
            )
        );
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
