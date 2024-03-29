<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Puntuacion;


class PuntuacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $punto = Puntuacion::where('activo', 1)->take(20)->get();
        $punto->user_id = 1;
        $usu = User::find($punto->user_id);
        
        return view('principal',['punto'=>$punto, 'usu'=>$usu]);
        //return "FUNCIONA".$punto->id.$punto->puntos.$punto->activo.$punto->user_id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$punto = new Puntuacion();
        //$punto->puntos = $request->pun;
        //$punto->user_id = $request->idUsuario;
        //$punto->save();
       
    }

    //function connect() {
	//	$databasehost = "vhw3t8e71xdz9k14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
	//	$databasename = "c8vyri3wplgqr1k6";
	//	$databaseuser = "mqfo6xclpuxa1g0j";
	//	$databasepass = "x0gffr4wnwn1mhn1";

	//	$mysqli = new mysqli($databasehost, $databaseuser, $databasepass, $databasename);
	//	if ($mysqli->connect_errno) {
	//		echo "Problema con la conexion a la base de datos";
	//	}
	//	return $mysqli;
	//}

	//function disconnect() {
	//	mysqli_close();
	//}

	function addScore(Request $request) {
	//	$score = $_POST["puntuacions"];
	//	$mysqli = connect();

	//	$result = $mysqli->query("call sp_addScore(".$score.");");	
	//	
	//	if (!$result) {
	//		echo "Problema al hacer un query: " . $mysqli->error;								
	//	} else {
	//		echo "Todo salio bien";		
	//	}
        $punto = new Puntuacion();
        $punto->puntos = $request->puntos;
        $punto->activo = 1;
        $punto->user_id = $request->user_id;
        $punto->save();
        //	mysqli_close($mysqli);
        return '{ "score": "Se guardo la puntuacion" }';
        //return Puntuacion::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
