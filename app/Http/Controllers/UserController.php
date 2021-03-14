<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;//importar la clase usuario
use \Firebase\JWT\JWT;

class UserController extends Controller
{
  public function crear_usuario(Request $request)
  {
      $key = "djidjifisdidsisdeddcsww348332feUUGGyugtyrr33r6";
      $payload = array(
          "nombreusuario" => $request->nombreusuario,
          "contraseña" => $request->contraseña,
      );

      $data = $request->getContent();
      $data = json_decode($data);
      $response = "";
      //es esto valido? si se cumple la condicion
      if($data){

			//creo el objeto usuario vacio
      	  $usuario = new User();
      		$usuario->nombreusuario = $data->nombreusuario;
      		$usuario->contraseña = Hash::make( $data->contraseña);
      		$usuario->email = $data->email;
      		$usuario->rol = $data->rol;

      		$usuario->save();

          $jwt = JWT::encode($payload, $key);

          $response = array('token' => $jwt); 
			    

      }
      else
      {
      	  $response = "el usuario no ha sido creado";
      }
      //para recibir en postman
      return response($response);

  }
  public function logear_usuario(Request $request){

   

    $data =$request->getContent();
    $data = json_decode($data);
    $response = "";

    if($data){
      if(isset($data->nombreusuario)&&isset($data->contraseña))
      {

//comprobar que el nombre usuario de la base de datos coincide con el nombre del data que yo le estoy metiendo
           $usuario = User::where("nombreusuario",$data->nombreusuario)->get()->first();

        if($usuario){


             if(Hash::check($data->contraseña,$usuario->contraseña)){


              
                $key = "djidjifisdidsisdeddcsww348332feUUGGyugtyrr33r6";

                $payload = array(
                "nombreusuario" => $request->nombreusuario,
                "rol" => $usuario->rol,
            );
              $jwt = JWT::encode($payload, $key);

              
              $response = array('token' => $jwt); 

               // $response = $token;
              
            
              $usuario->save();
           } else{
              $response = "Contraseña incorrecta";
            }

       } else{
          $response ="usuario no encontrado";
        }
      }else{
        $response ="faltan datos";
      }
    }else{
      $response = "datos incorrectos";
    }

 return $response;
}
}
