<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\User;
use \Firebase\JWT\JWT;

class VentaController extends Controller
{
 
	public function crear_venta(Request $request){

		$response = "";
		$data =$request->getContent();


		$data = json_decode($data);
		if($data){


			$venta = new Venta();
			$usuario = User::where('nombreusuario', $data->nombreusuario)->get()->first();
			$venta->nombre_venta = $data->nombre_venta;
			$venta->precio_total = $data->precio_total;
			$venta->cantidad = $data->cantidad;
			$venta->carta_id = $data->carta_id;
			$venta->user_id = $usuario->id;
			try{
				$venta->save();
				$response = "OK, la venta se ha crado";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}
		}
		return $response;

	}

	public function ventas_lista($nombre){

		$venta = Venta::where('nombre_venta','=',$nombre)->get();

		$data = [];


		foreach ($venta as $ventas){

			$data[] = [

				'nombre' => $ventas->nombre_venta,
				'cantidad' => $ventas->cantidad,
				'precio' => $ventas->precio_total,
				'Id' =>  $ventas->carta_id


			];
		}

		return $data;

	}
	public function lista_compra($nombre){
		
		$compra = Venta::where('nombre_venta','=',$nombre)->orderBy('precio_total','asc')->get();
		
		$headers = getallheaders();//cojo header de la peticion
		$key = "djidjifisdidsisdeddcsww348332feUUGGyugtyrr33r6";

		$decode = JWT::decode($headers["Authorization"],$key,array('HS256'));
		

		$nombreusuario = User::find($decode->id);
		
		$data = [];

		foreach ($compra as $compras){

			$data[] = [

			'nombre' => $compras->nombre_venta,
			'cantidad'=> $compras->cantidad,
			'precio'=> $compras->precio,
			'nombreusuario'=>$nombreusuario->nombre_venta

		];
	}

		return $data;




	}

}
