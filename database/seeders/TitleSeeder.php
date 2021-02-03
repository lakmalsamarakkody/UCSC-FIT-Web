<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('titles')->truncate();
    $titles = ["Rev", "Dr", "Master", "Mr", "Miss", "Mrs"];
    foreach( $titles as $key => $element):
      DB::table('titles')->insert(
      array(
        [
          'title'=>$element,
          'created_at'=> '2020-11-25 10:13:53',
          'updated_at'=> '2020-11-26 10:13:53',
        ]
      ));
    endforeach;
    
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

}
