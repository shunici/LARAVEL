   $database = kehadiran::whereYear('created_at', '=', $tahun)
              ->whereMonth('created_at', '=', $bulan)
              ->get();
 $ada = $database->where('status', 'H')->where('user_id', $hadir->user_id)
 ->count();
 
 hitung status H pada field
 digunakan untuk menghitung keterangan tulisan pada database
 $database ini berasal dari

 
