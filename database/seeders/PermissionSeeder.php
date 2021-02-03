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
        
    DB::table('permissions')->truncate();
    DB::table('permissions')->insert(
            array (
                [
                    'name'=>'add user',
                    'description'=>'can add an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'edit user',
                    'description'=>'can edit an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],

                [
                    'name'=>'delete user',
                    'description'=>'can delete an user',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'name'=>'view dashboard',
                    'description'=>'can view the dashboard page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'name'=>'view exams',
                    'description'=>'can view the exams page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'name'=>'view students',
                    'description'=>'can view the students page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'name'=>'view results',
                    'description'=>'can view the results page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'name'=>'view user page',
                    'description'=>'can view the user page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'name'=>'view system',
                    'description'=>'can view the system page',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
            )
        );

    }
}
