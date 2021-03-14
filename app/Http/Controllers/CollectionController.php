<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\User;

class CollectionController extends Controller
{

public function crear_coleccion(Request $request){

    	$response = "";
   
        $data = $request->getContent();

        $coleccion = new Collection();



        $data = json_decode($data);
        $usuario = User::find($data->admin_id);

      if($data){


        $coleccion->nombre = (isset($data->nombre) ? $data->nombre : $coleccion->nombre);
        $coleccion->simbolo = (isset($data->simbolo) ? $data->simbolo : $coleccion->simbolo);
         $coleccion->admin_id = (isset($data->admin_id) ? $data->admin_id : $coleccion->admin_id);

      

            try{
                  $coleccion->save();
                  $response = "OK";
                }catch(\Exception $error){
                  $response = $error ->getMessage();
                }

        }
     
    
    return response($response);

   }
}