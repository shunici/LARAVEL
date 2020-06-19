<?php 
perlu diperhatikan ketika menggunakan waktu harus disetting dahulu waktu local timezonenya
  controller
  use Jenssegers\Date\Date;
use Carbon\Carbon;
  =========

$waktu = Date::now();  
tampilkan waktu sekarang  
  
  Date::parse($data->created_at)->format('l, j F Y');
 \Date::parse($waktu)->format('l, j F Y');
tampinya Senin, 8 Juni 2020 
  
  menggunakan waktu bahasa indonesia data parse laravel
  
  =====================================  
$waktu = Date::parse($data->created_at)->diffForHumans();
dd($waktu);
// hasil 30 detik yang lalu, sampai 1 jam yang lalu
=====================================================
$waktu = Date::parse($data->created_at)->diffInSeconds();
dd($waktu);
//hasilnya mulai dari 1 detik dan seterusnya mewakili dari detik pertama sejak data dibuat
fungsi lainnya ::
 diffInSeconds();  
diffInMinutes(); 
diffInHours();  
diffInDays(); 
  
  ===========================
 misalnya data dibuat jam 5, kemudian ditambah menitnya 60 menit. saat itu jam 5:30 berrati tinggal 30 menit lagi
$tampil = Date::parse($cek_absen->created_at)->addMinutes(60)->diffForHumans();  
dd($tampil);
hasil 30  menit dari sekarang 
  //artinya 30 menit lagi menuju jam 6

 
  
?>  



