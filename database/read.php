<?php
//read paling akhir
 $stok_records = DB::table('record_stoks')->where('bahan_id', 2)->latest()->first();
 
 
 //pilih nama tertentu berdasarkan id foreignkey (berarrti ada array yang dimiliki id foreign key)
 $data = DB::table('record_stoks')->select('input')->where('bahan_id', $id)->get();
 dd($data);
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 />
