<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('sl_districts')->truncate();
    DB::table('sl_districts')->insert(
            array(

                [ 'province_id' => '6', 'name' => 'Ampara', 'name_si' => 'අම්පාර', 'name_ta' => 'அம்பாறை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '8', 'name' => 'Anuradhapura', 'name_si' => 'අනුරාධපුරය', 'name_ta' => 'அனுராதபுரம்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '7', 'name' => 'Badulla', 'name_si' => 'බදුල්ල', 'name_ta' => 'பதுளை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '6', 'name' => 'Batticaloa', 'name_si' => 'මඩකලපුව', 'name_ta' => 'மட்டக்களப்பு', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '1', 'name' => 'Colombo', 'name_si' => 'කොළඹ', 'name_ta' => 'கொழும்பு', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '3', 'name' => 'Galle', 'name_si' => 'ගාල්ල', 'name_ta' => 'காலி', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '1', 'name' => 'Gampaha', 'name_si' => 'ගම්පහ', 'name_ta' => 'கம்பஹா', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '3', 'name' => 'Hambantota', 'name_si' => 'හම්බන්තොට', 'name_ta' => 'அம்பாந்தோட்டை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '9', 'name' => 'Jaffna', 'name_si' => 'යාපනය', 'name_ta' => 'யாழ்ப்பாணம்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '1', 'name' => 'Kalutara', 'name_si' => 'කළුතර', 'name_ta' => 'களுத்துறை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '2', 'name' => 'Kandy', 'name_si' => 'මහනුවර', 'name_ta' => 'கண்டி', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '5', 'name' => 'Kegalle', 'name_si' => 'කෑගල්ල', 'name_ta' => 'கேகாலை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '9', 'name' => 'Kilinochchi', 'name_si' => 'කිලිනොච්චිය', 'name_ta' => 'கிளிநொச்சி', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '4', 'name' => 'Kurunegala', 'name_si' => 'කුරුණෑගල', 'name_ta' => 'குருணாகல்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '9', 'name' => 'Mannar', 'name_si' => 'මන්නාරම', 'name_ta' => 'மன்னார்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '2', 'name' => 'Matale', 'name_si' => 'මාතලේ', 'name_ta' =>  'மாத்தளை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '3', 'name' => 'Matara', 'name_si' => 'මාතර', 'name_ta' => 'மாத்தறை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '7', 'name' => 'Monaragala', 'name_si' => 'මොණරාගල', 'name_ta' => 'மொணராகலை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '9', 'name' => 'Mullaitivu', 'name_si' => 'මුලතිව්', 'name_ta' =>  'முல்லைத்தீவு', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '2', 'name' => 'Nuwara Eliya', 'name_si' => 'නුවර එළිය', 'name_ta' => 'நுவரேலியா', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '8', 'name' => 'Polonnaruwa', 'name_si' => 'පොළොන්නරුව', 'name_ta' => 'பொலன்னறுவை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '4', 'name' => 'Puttalam', 'name_si' => 'පුත්තලම', 'name_ta' => 'புத்தளம்', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '5', 'name' => 'Ratnapura', 'name_si' => 'රත්නපුර', 'name_ta' => 'இரத்தினபுரி', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '6', 'name' => 'Trincomalee', 'name_si' => 'ත්‍රිකුණාමලය', 'name_ta' => 'திருகோணமலை', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53'],
                [ 'province_id' => '9', 'name' => 'Vavuniya', 'name_si' => 'වව්නියාව', 'name_ta' => 'வவுனியா', 'created_at' => '2020-11-25 10:13:53', 'updated_at' => '2020-11-25 10:13:53']
            )
        );
        
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
