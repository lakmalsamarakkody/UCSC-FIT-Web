<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('permissions')->insert(
            array (
                [
                    'permission'=>'add user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'permission'=>'edit user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'permission'=>'delete user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'permission'=>'view dashboard',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'permission'=>'view exams',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'permission'=>'view students',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'permission'=>'view results',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'permission'=>'view users',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'permission'=>'view system',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
            )
        );

    }
}
