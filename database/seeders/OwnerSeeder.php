<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_casa = array(
            array('id' => '1','user_id' => '1','casa_id' => '21'),
            array('id' => '2','user_id' => '1','casa_id' => '30'),
            array('id' => '3','user_id' => '2','casa_id' => '14'),
            array('id' => '4','user_id' => '3','casa_id' => '20'),
            array('id' => '5','user_id' => '4','casa_id' => '19'),
            array('id' => '6','user_id' => '5','casa_id' => '14'),
            array('id' => '7','user_id' => '6','casa_id' => '10'),
            array('id' => '8','user_id' => '7','casa_id' => '10'),
            array('id' => '9','user_id' => '9','casa_id' => '21'),
            array('id' => '10','user_id' => '10','casa_id' => '28'),
            array('id' => '12','user_id' => '11','casa_id' => '15')
          );
          
       foreach ($user_casa as $item) {
            $user_id = $item['user_id'];
            $casa_id = $item['casa_id'];
            $user = User::find($user_id);
            $user->casas()->attach($casa_id);

       }   
    }
}
