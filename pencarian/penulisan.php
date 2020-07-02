<?php

use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date; //untuk

 public function cari(Request $request)
    {

        \Date::setLocale('id');
        $time =   Date::now();
        $cari = $request->cari;
 
        $tabel = transaksi::where('nama_file', 'like', '%' .$cari. '%')
        ->orwhere('keterangan', 'like', '%' .$cari. '%')
        ->orwhere('id', 'like', '%' .$cari. '%')
        ->orwhere('status_cetakan', 'like', '%' .$cari. '%')
        ->orwhere('created_at', 'like', '%' .$cari. '%')

        ->orwhereHas('kostumer', function ($ambil_kostumer) use ($cari) {
        $ambil_kostumer->where('nama', 'like', '%' . $cari . '%')
        ->orwhere('kategori', 'like', '%' . $cari . '%'); })

       ->orwhereHas('produk', function ($ambil_produk) use ($cari) {
        $ambil_produk->where('nama', 'like', '%' . $cari . '%');})

        ->orwhereHas('bahan', function ($ambil_bahan) use ($cari) {
            $ambil_bahan->where('nama', 'like', '%' . $cari . '%');})        
        ->paginate(10);
       
    return view('transaksi.index',compact('tabel', 'time'));
    }
