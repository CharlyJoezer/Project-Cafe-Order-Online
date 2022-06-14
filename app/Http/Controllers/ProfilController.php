<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function profilView(){
        return view('login.profil',[
            'title' => 'Profil | Coffee Latte',
            'css'   => 'profil'
        ]);
    }
}
