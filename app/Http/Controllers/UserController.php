<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function storeDataLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('/');
        }

        return back()->with('failed', 'Email Atau Password Salah');
    }

    public function storeDataRegister(Request $request){
        $finaldata = $request->validate([
            'username' => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8' 
        ]);
       try{
            $finaldata['password'] = Hash::make($finaldata['password']);
            User::create($finaldata);
            return redirect('/');
            
       }catch(Exception $e){
            return back()->with('Terjadi Kesalahan');
       }
    }
}
