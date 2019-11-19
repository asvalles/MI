<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use RealRashid\SweetAlert\Facades\Alert;

class ImagenController extends Controller
{
    public function GuardarImg(Request $request){
        $imagen = $request->input('idscreen');
        $puntuacion = $request->input('puntuacionUsuario');
        //if(preg_match('/^data:image/(\w+);base64,/', $imagen)){
            $image_full =  substr($imagen, strpos($imagen, ',') + 1);
            $image_full = base64_decode($image_full);
            Storage::disk('public')->put("screen.png",($image_full));
            return view('publicar',[
            'imagen' => $image_full, 
            'puntuacion' => $puntuacion
            ]);
        //}
    }
}
