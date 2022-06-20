<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Menu;
use App\Models\Riwayat;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function buatriwayat(Request $request){
        try{
            $finaldata = [
                'user_id' => auth()->user()->id,
                'nama_pesanan' => 'null',
                'list_pesanan' => [],
                'jumlah_pesanan' => [],
                'nama_pemesan' => auth()->user()->username,
                'harga_pesanan' => 0,
                'status' => 'Diproses'
            ]; 
            $data = Keranjang::where('user_id', auth()->user()->id)->get();
            $i =  0;
            foreach($data as $data2){                
                $finaldata['harga_pesanan'] = $finaldata['harga_pesanan'] + $data2->total_harga;
                array_push($finaldata['list_pesanan'], $data2->menu_id);
                array_push($finaldata['jumlah_pesanan'], $data2->jumlah_dipesan);
                $i++;
            }

            Riwayat::create($finaldata);
            Keranjang::where('user_id', auth()->user()->id)->delete();
            return ['status'=>'200'];
        }catch(Exception $e){
            return ['status'=>'fail'];
        }
    }

    protected function getriwayatloop($arraylength, $data, $jumlahpesanan){
        $final=[];
        for($i=0; $i < $arraylength; $i++){
            array_push($final, Menu::where('id', $data[$i])->first(['nama', 'kategori', 'harga', 'gambar']));
        }
        return $final;
    }
    protected function inputjumlah2($data, $jumlah){
        $finaldata = $data;
        for($k=0; $k < count($data); $k++){
            $finaldata[$k]['jumlah'] =  $jumlah[$k];
            $finaldata[$k]['harga'] *=  $jumlah[$k];
        }
        return $finaldata;
    }
    protected function inputjumlah($data, $jumlah){
        $finaldata = $data;
        for($i=0; $i < count($finaldata); $i++){
            $finaldata[$i] = $this->inputjumlah2($finaldata[$i], $jumlah[$i]);
        }
        return $finaldata;
    }
    public function getriwayat(Request $request){
        try{
            if(!auth()){
                return ['status'=>'FAIL'];
            }
            $finaldata = [];
            $datapesanan = Riwayat::where([
                ['user_id', auth()->user()->id],
                ['status', $request->status]
                ])->get();
            $listpesanan = [];
            $jumlahpesanan = [];
            foreach($datapesanan as $item){
                array_push($listpesanan, $item->list_pesanan);
                array_push($jumlahpesanan, $item->jumlah_pesanan);
            }
            $finaldata = [];
            foreach($listpesanan as $item2){
                array_push($finaldata, $this->getriwayatloop(count($item2), $item2, $jumlahpesanan));
            }
            $finaldata2 = $this->inputjumlah($finaldata, $jumlahpesanan);
            return $finaldata2;

        }catch(Exception){
            return ['status' => '500'];
        }
        
    }
}
