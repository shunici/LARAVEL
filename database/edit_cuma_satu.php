
edit database cuma satu kolom
dalam field tabel ada kolom kehadiran, teliti, kerajinan dan lain2..ketika kita ingin mengupdate satu saja tanpa mengurai satu-satu diperlukan koding dibawah ini

 $kinerja = kinerja::whereYear('created_at', '=', $tahun)->whereMonth('created_at', '=', $bulan)->first();
$kinerja->where('karyawan_id', $karyawan->id)->take(1)->update([
               'kehadiran' => 'tess'
           ]);
