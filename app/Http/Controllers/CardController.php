<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Card;

use App\Models\User;
use \Firebase\JWT\JWT;

class CardController extends Controller
{
     public function crear_carta(Request $request){

    	$response="";


    	$data = $request->getContent();

    	$data = json_decode($data);


    	if($data){

        

               
              //$decoded = JWT::decode($key);

              
             
        //Si el rol del  usuario es admin
    
            //crear carta

        

        $carta = new Card();

        $carta->nombre = $data->nombre;
        $carta->descripcion = $data->descripcion;
        $carta->coleccion = $data->coleccion;
        $nombrecoleccion = $data->coleccion;
        if(Collection::where('nombre', $data->coleccion)->get()->first()){
            $carta->save();
            echo "carta añadida a la coleccion";
            try{
                $carta->save();
                $response ="OK";
            }catch(\Exceptiom $error){

            $response = $error->getMessage();
        }

        }else{

            $coleccion = new Collection();
            $coleccion->nombre = $data->coleccion;
         
            $coleccion->simbolo = 'default';
            $coleccion->admin_id = $decoded->


            $carta->nombre = $data->nombre;
            $carta->descripcion = $data->descripcion;
            $carta->coleccion = $data->coleccion;
            $coleccion->save();
            $carta->save();

            return response()->json(['success', 'Creado']);

        }

    }
    return response($response);
        }
}
