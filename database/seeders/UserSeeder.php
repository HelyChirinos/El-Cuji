<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = array(
            array('id' => '1','nombre' => 'Hely Antonio','apellido' => 'Chirinos Herrera','cedula' => '7222809','email' => 'helychirinos@gmail.com','password' => '$2y$10$F1Y/id.0zWreVIdwnn6pou9KBVXiEt8FaUeWh9QGejTznWbRzuI7S','telefono' => '0414-5331332','fecha_nac' => '1963-12-07 00:00:00','two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => 'qBON9pVFizwDcuqnbF87FLKxMJCfy6B2yFoYO1B9SBhKUiCcdQfBc14Yf0hd','created_at' => '2022-12-15 21:21:56','updated_at' => '2022-12-20 16:31:50'),
            array('id' => '2','nombre' => 'Rafael Guillermo','apellido' => 'Cabrera Perdomo','cedula' => '11234567','email' => 'rafacabrera@gmail.com','password' => '$2y$10$OG.TVdSN.MVUu0u0AQjXF.BmoxuwX90u1pSG8d7o2cYoYHYN/5eMO','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-15 21:25:25','updated_at' => '2022-12-15 21:25:25'),
            array('id' => '3','nombre' => 'Gabriel','apellido' => 'Cardosi','cedula' => '3245623','email' => 'gabicardosi@gmail.com','password' => '$2y$10$hrO4/KqOBSJW7yqAQGRTf.MuNCPBMSV5uu2LDUnmEKswzD4sWRWBO','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-15 21:27:23','updated_at' => '2022-12-15 21:27:23'),
            array('id' => '4','nombre' => 'Nedo','apellido' => 'Cardosi','cedula' => '4433557','email' => 'nedocardosi@gmail.com','password' => '$2y$10$PjGqsgwdBQ58Fw57anSKEeGrmxfpPlHoD1ktEE6t0ZCQjwy3QQY22','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-15 21:29:36','updated_at' => '2022-12-15 21:29:36'),
            array('id' => '5','nombre' => 'Silvia','apellido' => 'Pacheco','cedula' => '3243242','email' => 'silvis@gmail.com','password' => '$2y$10$Kb.T5/QM.Kgd5ZrasX/Tle6XxpNk48689o2d1wj/qZVUgpukpy0Qu','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-15 21:31:09','updated_at' => '2022-12-15 21:31:09'),
            array('id' => '6','nombre' => 'Karla','apellido' => 'Zambrano','cedula' => '32223199','email' => 'karlaz@gmail.com','password' => '$2y$10$MG63/57OrEqWh7EiZcCmN.Yt6N1hh4SN7/4JRCB8dXglS2Gi8E6KS','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-15 21:44:49','updated_at' => '2022-12-15 21:44:49'),
            array('id' => '7','nombre' => 'Wilkys','apellido' => 'Riera','cedula' => '4334452','email' => 'wilkysr@gmail.com','password' => '$2y$10$kbd.H.Zj03talaH5O3k8F.cUpgbwMWupA.OhiZT.7fK3Ks0dYTV12','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-15 21:48:49','updated_at' => '2022-12-15 21:48:49'),
            array('id' => '9','nombre' => 'Helyana Del Valle','apellido' => 'Chirinos Franco','cedula' => '21333444','email' => 'helyana28@hotmail.com','password' => '$2y$10$AZjBY404ryEbrM7FXaVAkeBBsuMnuws6/MNfH/Mhr9oqekgSL4oPW','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '0','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-16 00:37:47','updated_at' => '2022-12-16 00:37:47'),
            array('id' => '10','nombre' => 'Luis','apellido' => 'Franco Alfonzo','cedula' => '7233445','email' => 'luisf@gmail.com','password' => '$2y$10$W3RBd/7/bQlMds248UmdUOKzuGxj6lpURqJ3wbZlRR9.86TXKq2yO','telefono' => NULL,'fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-18 20:01:57','updated_at' => '2022-12-18 20:01:57'),
            array('id' => '11','nombre' => 'Raul','apellido' => 'Escalona','cedula' => '2999888','email' => 'raulE@gmail.com','password' => '$2y$10$yzDBLrzhXJkNKg4TiQF6..L47Z/ZJJF5ocz67qIL5gtEe9ucDstXC','telefono' => '0416-288432','fecha_nac' => NULL,'two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'rol_id' => '1','propietario' => '1','status' => '1','profile_photo_path' => NULL,'email_verified_at' => NULL,'remember_token' => NULL,'created_at' => '2022-12-19 21:56:42','updated_at' => '2022-12-19 21:57:15')
          );
          
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        foreach ($users as $item) {
            User::create([
                'id' => $item['id'],
                'nombre' => $item['nombre'],
                'apellido' => $item['apellido'],
                'cedula' => $item['cedula'],
                'email' => $item['email'],
                'password' => $item['password'],
                'propietario' => $item['propietario'],
                'telefono' => $item['telefono'],
                'fecha_nac' => $item['fecha_nac'],
            ]);
        }
        
    }
}
