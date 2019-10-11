<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        Alert::error('Error Title', 'ErrorMessage');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


    //public function prueba(Request $request)
    //{
    //    return "FUNCIONA".$request->name.$request->pas;
    //}

    public function logear(Request $request)
    {
        $info = ['name'=>$request->name, 'password'=>$request->pas];

        if(Auth::attempt($info))
        {
            Alert::success('Bienvenido', 'Has iniciado sesion');
            return redirect("/");
        }
        else{
            Alert::error('Error', 'Error al Iniciar Sesion');
            //return redirect("/")->back()->with('error', 'Something went wrong.');
            //return redirect()->action('LoginController@index');
            //return view('/principal',['else'=>$info]);
            return redirect("/");
        }
    }

    public function salir()
    {
        Auth::logout();
        return redirect("/");
    }
}
