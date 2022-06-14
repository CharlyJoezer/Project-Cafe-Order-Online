<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    public function home(){
        return view('home',[
            'title' => 'Coffee Latte',
            'css' => 'home',
        ]);
    }

    public function getMenu(Request $request){
        $data = Menu::where('kategori', $request->kategori)->get(['id', 'nama', 'kategori', 'harga', 'gambar']);
        return $data;
    }
}
