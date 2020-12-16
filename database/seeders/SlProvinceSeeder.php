<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sl_provinces')->insert(
            array(
                ['name' => 'Western', 'name_si' => 'බස්නාහිර', 'name_ta' => 'மேல்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'Central', 'name_si' => 'මධ්‍යම', 'name_ta' => 'மத்திய', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'Southern', 'name_si' => 'දකුණු', 'name_ta' => 'தென்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'North Western', 'name_si' => 'වයඹ', 'name_ta' => 'வட மேல்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'Sabaragamuwa', 'name_si' => 'සබරගමුව', 'name_ta' => 'சபரகமுவ', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'Eastern', 'name_si' => 'නැගෙනහිර', 'name_ta' => 'கிழக்கு', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'Uva', 'name_si' => 'ඌව', 'name_ta' => 'ஊவா', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'North Central', 'name_si' => 'උතුරු මැද', 'name_ta' => 'வட மத்திய', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                ['name' => 'Northern', 'name_si' => 'උතුරු', 'name_ta' => 'வட', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53']
            )
        );
    }
}
