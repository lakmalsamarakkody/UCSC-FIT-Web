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
    public function run(){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_permissions')->truncate();

        for($i=2; $i<=2; $i++){
            for($j=1; $j<=150; $j++){
                DB::table('role_permissions')->insert(
                    array (
                        [
                            'role_id'=>$i,
                            'permission_id'=>$j,
                            'created_at'=> '2020-11-25 10:13:53',
                            'updated_at'=> '2020-11-25 10:13:53'
                        ],
                    )
                );
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
