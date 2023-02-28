<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Casa;

class CasasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $casas = array(
            array('id' => '1','casa_no' => '1','observacion' => NULL),
            array('id' => '2','casa_no' => '2','observacion' => NULL),
            array('id' => '3','casa_no' => '3','observacion' => NULL),
            array('id' => '4','casa_no' => '4','observacion' => NULL),
            array('id' => '5','casa_no' => '5','observacion' => NULL),
            array('id' => '6','casa_no' => '6','observacion' => NULL),
            array('id' => '7','casa_no' => '7','observacion' => NULL),
            array('id' => '8','casa_no' => '8','observacion' => NULL),
            array('id' => '9','casa_no' => '9','observacion' => NULL),
            array('id' => '10','casa_no' => '10','observacion' => NULL),
            array('id' => '11','casa_no' => '11','observacion' => NULL),
            array('id' => '12','casa_no' => '12','observacion' => NULL),
            array('id' => '13','casa_no' => '13','observacion' => NULL),
            array('id' => '14','casa_no' => '14','observacion' => NULL),
            array('id' => '15','casa_no' => '15','observacion' => NULL),
            array('id' => '16','casa_no' => '16','observacion' => NULL),
            array('id' => '17','casa_no' => '17','observacion' => NULL),
            array('id' => '18','casa_no' => '18','observacion' => NULL),
            array('id' => '19','casa_no' => '19','observacion' => NULL),
            array('id' => '20','casa_no' => '20','observacion' => NULL),
            array('id' => '21','casa_no' => '21','observacion' => NULL),
            array('id' => '22','casa_no' => '22','observacion' => NULL),
            array('id' => '23','casa_no' => '23','observacion' => NULL),
            array('id' => '24','casa_no' => '24','observacion' => NULL),
            array('id' => '25','casa_no' => '25','observacion' => NULL),
            array('id' => '26','casa_no' => '26','observacion' => NULL),
            array('id' => '27','casa_no' => '27','observacion' => NULL),
            array('id' => '28','casa_no' => '28','observacion' => NULL),
            array('id' => '29','casa_no' => '29','observacion' => NULL),
            array('id' => '30','casa_no' => '30','observacion' => NULL)
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('casas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        foreach ($casas as $item) {
            Casa::create([
                'id' => $item['id'],
                'casa_no' => $item['casa_no'],
                'observacion' => NULL,
            ]);
        }


          
    }
}
