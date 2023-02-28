<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileValidation;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Fondo;
Use Illuminate\Support\Carbon;
Use App\Models\Fondo_Detalle;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GlobalController extends Controller
{

    public function comienzo() {
        if ( is_admin()) {
            return view('admin.admin');
        }		
	    else 
        {
        	if ((no_de_casas() == 1) and (session()->has('casa_no'))) {
                $casa_id = session('casa_no');
                return redirect()->route('casa', ['casa' => session('casa_no')]);

            } else {
			    if (session()->has('casa_no')) {
                    return redirect()->route('casa', ['casa' => session('casa_no')]);
                } else {
                    return view('admin.user.main_casa');
                }    
            }
        }    


    }

    public function facturas()
    {
        $factura = Factura::all();
        if ($factura->count()) {
            return view('admin.condominio.facturas.index');
        } else {
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $anos = array(2022,2023,2024,2025);
            $obs='<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>';
            return view('admin.condominio.facturas.primera_factura', compact('meses','anos','obs'));
        }
        
    }    

    public function save_first_fact(Request $request) {

        $newFact = Factura::create([
            'mes' => $request->mes,
            'ano' => $request->ano,
            'publicado' => 0,
            'observacion' => $request->observa,
        ]);

        $fondos = Fondo::where('activo',1)->get();

        foreach ($fondos as $fondo) {
            Fondo_Detalle::create([
                'factura_id' => $newFact->id,
                'fondo_id' => $fondo->id,
                'tarifa' => $fondo->monto,
                'factor' => $fondo->tipo,
                'activo' => 1,
             ]);
        }

        return redirect()->route('facturas');

    }

    public function showCasa (Request $request) {
        $casa_id = $request->casa;

        return view('admin.user.casa.index', compact('casa_id'));
    }


    public function showResidentes () {

        return view('admin.user.residente.index');
    }

    
    public function showVehiculos () {

        return view('admin.user.vehiculos.index');
    }



    public function showPerfil () {

        $user = Auth::user();
        return view('admin.user.profile.profile',compact('user'));
        
    }

    public function showPassword () {

        $user = Auth::user();
        return view('admin.user.profile.update_password',compact('user'));
        
    }

    public function savePerfil (ProfileValidation $request, User $user) {

        $user->update($request->validated());
        if ($foto = $request->foto) {
            $user->updateProfilePhoto($foto);
        }
        return redirect()->route('admin')->with('mensaje','se actualizo el Perfil correctamente');
        
    }

    public function updatePassword(Request $request, User $user ) {

        $request->validateWithBag('updatePass', [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'confirmed', 'min:6'],
            [
                'current_password.current_password' => __('Este password no es igual a su password actual.'),
            ]          

        ]);

        // Validator::make($request, [
        //     'current_password' => ['required', 'string', 'current_password:web'],
        //     'password' => ['required', 'confirmed', 'min:6'],
        // ], [
        //     'current_password.current_password' => __('Este password no es igual a su password actual.'),
        // ])->validateWithBag('updatePassword');


        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
        return redirect()->route('admin')->with('mensaje','se actualizo el Perfil correctamente');    
    }

}
