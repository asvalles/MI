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
        //var_dump($imagen);
        //var_dump($puntuacion);
        //die();
        if(preg_match('/^data:image\/(\w+);base64,/', $imagen)){
            $image_full =  substr($imagen, strpos($imagen, ',') + 1);
            $image_full = base64_decode($image_full);
            Storage::disk('public')->put("screen.png",($image_full));
            return view('segundo',[
            'imagen' => $image_full, 
            'puntuacion' => $puntuacion
            ]);
        }
    }

    public function GuardarImg_2(Request $request){
        $imagen = $request->input('idscreen_2');
        $puntuacion = $request->input('puntuacionUsuario_2');
        //var_dump($imagen);
        //var_dump($puntuacion);
        //die();
        if(preg_match('/^data:image\/(\w+);base64,/', $imagen)){
            $image_full =  substr($imagen, strpos($imagen, ',') + 1);
            $image_full = base64_decode($image_full);
            Storage::disk('public')->put("screen.png",($image_full));
            return view('segundo',[
            'imagen' => $image_full, 
            'puntuacion' => $puntuacion
            ]);
        }
    }

    public function GuardarImg_3(Request $request){
        $imagen = $request->input('idscreen_3');
        $puntuacion = $request->input('puntuacionUsuario_3');
        //var_dump($imagen);
        //var_dump($puntuacion);
        //die();
        if(preg_match('/^data:image\/(\w+);base64,/', $imagen)){
            $image_full =  substr($imagen, strpos($imagen, ',') + 1);
            $image_full = base64_decode($image_full);
            Storage::disk('public')->put("screen.png",($image_full));
            return view('segundo',[
            'imagen' => $image_full, 
            'puntuacion' => $puntuacion
            ]);
        }
    }

    public function GuardarImg_4(Request $request){
        $imagen = $request->input('idscreen_4');
        $puntuacion = $request->input('puntuacionUsuario_4');
        //var_dump($imagen);
        //var_dump($puntuacion);
        //die();
        if(preg_match('/^data:image\/(\w+);base64,/', $imagen)){
            $image_full =  substr($imagen, strpos($imagen, ',') + 1);
            $image_full = base64_decode($image_full);
            Storage::disk('public')->put("screen.png",($image_full));
            return view('segundo',[
            'imagen' => $image_full, 
            'puntuacion' => $puntuacion
            ]);
        }
    }

    public function GuardarImg_5(Request $request){
        $imagen = $request->input('idscreen_5');
        $puntuacion = $request->input('puntuacionUsuario_5');
        //var_dump($imagen);
        //var_dump($puntuacion);
        //die();
        if(preg_match('/^data:image\/(\w+);base64,/', $imagen)){
            $image_full =  substr($imagen, strpos($imagen, ',') + 1);
            $image_full = base64_decode($image_full);
            Storage::disk('public')->put("screen.png",($image_full));
            return view('segundo',[
            'imagen' => $image_full, 
            'puntuacion' => $puntuacion
            ]);
        }
    }

    public function GuardarImg_6(Request $request){
        $imagen = $request->input('idscreen_6');
        $puntuacion = $request->input('puntuacionUsuario_6');
        //var_dump($imagen);
        //var_dump($puntuacion);
        //die();
        if(preg_match('/^data:image\/(\w+);base64,/', $imagen)){
            $image_full =  substr($imagen, strpos($imagen, ',') + 1);
            $image_full = base64_decode($image_full);
            Storage::disk('public')->put("screen.png",($image_full));
            return view('segundo',[
            'imagen' => $image_full, 
            'puntuacion' => $puntuacion
            ]);
        }
    }
}
