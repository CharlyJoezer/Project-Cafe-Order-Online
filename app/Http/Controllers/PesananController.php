<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function pesananView(){
        $data = Keranjang::where('user_id',auth()->user()->id)->get('total_harga');
        $total = 0;
        foreach($data as $item){
            $total += $item->total_harga;
        }
        return view('pesanan.index', [
            'title' => "List Pesanan | Coffee Latte",
            'css'   => "pesanan",
            'data'  => Keranjang::where('user_id', auth()->user()->id)->get(),
            'total_harga' => $total
        ]);
    }
    public function tambah_keranjang(Request $request){
        try{
            $checkAlready = Keranjang::where('user_id', auth()->user()->id)->where('menu_id', $request->menu);
            if($checkAlready->first('id')){
                $checkAlready->update(['jumlah_dipesan' => $checkAlready->value('jumlah_dipesan') + $request->jumlah]);
                $checkAlready->update(['total_harga' => $checkAlready->value('total_harga') + $request->total]);
                return 'ok';
            }
            $finaldata = [
                'user_id' => auth()->user()->id,
                'menu_id' => $request->menu,
                'nama_menu' => $request->nama,
                'jumlah_dipesan' => $request->jumlah,
                'total_harga' => $request->total
            ];
            Keranjang::create($finaldata);
    
            return 'Success';
        }catch(Exception $e){
            return 'fail';
        }
    }
    public function deletekeranjang(Request $request){
        try{
            $checkdata1 = Keranjang::where('id', $request->id)->first();
            if($checkdata1->user_id === auth()->user()->id){
                Keranjang::where('id', $request->id)->delete();
                $data = Keranjang::where('user_id',auth()->user()->id)->get('total_harga');
                $total = 0;
                foreach($data as $item){
                    $total += $item->total_harga;
                }
                return [
                    'data' => $total
                ];
            }
        }catch(Exception $e){
            return 'FAIL';
        }
    }
}
