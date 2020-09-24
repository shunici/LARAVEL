• di command prompt
php artisan make:seeder transaksi_seeder

• lihat folder seeds ada file transaksi_seeder.php kemudian taruh syntax ini
<?php
//jika ingin satu insert
 \App\nota::insert([
                "pelanggan_id" => 1,
                "nama_pelanggan" => 'CMC',
                "no_hp" => '081562589',
                'status_pelanggan' => 'Reseller',
                'total_lunas' => 54000,
                'status_bayar' => 'Lunas',
                'total_dp' => null,
                'total_bayar_cetakan' => 54000,
                'dp' => null,
                'estimasi_desain' => null,
                'estimasi_ambil' => null,
                'status_cetakan' => 'Selesai',
                'bentuk_file' => null,
                'keterangan' => null,
                'created_at' => "2020-08-01 00:14:13",
                'updated_at' =>   "2020-08-01 00:14:15",           
             ]);

// jika ingin banyak
for($i = 1; $i<90; $i++) {
  $digit_2 = sprintf("%02d", $i);
\App\nota::insert([
                "pelanggan_id" => 1,
                "nama_pelanggan" => 'CMC',
                "no_hp" => '081562589',
                'status_pelanggan' => 'Reseller',
                'total_lunas' => 54000,
                'status_bayar' => 'Lunas',
                'total_dp' => null,
                'total_bayar_cetakan' => 54000,
                'dp' => null,
                'estimasi_desain' => null,
                'estimasi_ambil' => null,
                'status_cetakan' => 'Selesai',
                'bentuk_file' => null,
                'keterangan' => null,
                'created_at' => "2020-08-$digit_2 00:14:13",
                'updated_at' =>   "2020-08-$digit_2 00:14:15",           
             ]);

}

// •  kemudian lihat file DatabaseSeeder dan taruh syntax ini

  $this->call(transaksi_seeder::class);
  
  // •  jika sudah kembali ke command prompt kemudian ketik  php artisan db:seed --class=transaksi_seeder
  // • lihat database sudah terkumpul banyak, akan tetapi nama pada file mempunyai nama yang sama yaitu CMC nama pelanggannya, jika ingin mengubah secara zebra atau dengan hitungan genap, maka buat seeder lagi dan taruh sintax ini
  
   for($bil = 60; $bil <= 84; $bil++){
            if( ($bil % 2) == 0){               
                $edit = \App\nota::find($bil);
                if($edit){
                    $edit->pelanggan_id = 2;
                    $edit->nama_pelanggan = 'Amaco';
                    $edit->status_pelanggan = 'Umum';
                    
                    $edit->save();
                }            
            }
        }
        
        //seketika kemudian berubah jika belangan genap namanya berubah jadi amaco
