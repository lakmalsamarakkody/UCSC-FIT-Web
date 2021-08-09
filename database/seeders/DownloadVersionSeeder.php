<?php

namespace Database\Seeders;

use App\Models\DownloadVersion;
use Illuminate\Database\Seeder;

class DownloadVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 717; $i++) { 
            DownloadVersion::insert(                
                array(
                    [
                        'id'=>$i,
                        'created_at'=> date('Y-m-d H:i:s'),
                        'updated_at'=> date('Y-m-d H:i:s')
                    ]
                )
            );
        }
    }
}
