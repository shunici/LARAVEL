<?php

 $karyawans = karyawan::all();
 $kinerjas = kinerja::with('karyawan')->whereYear('created_at', '=', $tahun)
        ->whereMonth('created_at', '=', $bulan);
        foreach($karyawans as $karyawan){
           foreach ($kinerjas as $kinerja){
              eksekusi 
           }          
        }
        
 koding  diatas tak bisa dieksekusi karna kinerja mempunyai waktu
