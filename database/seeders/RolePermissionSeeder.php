<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('role_permissions')->truncate();
    DB::table('role_permissions')->insert(
            array (
                [
                    'role_id'=>'1',
                    'permission_id'=>'7',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'1',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'2',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'3',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'4',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'5',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'6',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'7',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'8',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ],
                
                [
                    'role_id'=>'2',
                    'permission_id'=>'9',
                    'created_at'=> '2020-11-25 10:13:53',
                    'updated_at'=> '2020-11-25 10:13:53'
                ]
            )
        );
        
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
