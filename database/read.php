<?php
//read paling akhir
 $stok_records = DB::table('record_stoks')->where('bahan_id', 2)->latest()->first();
 
//read data paling baru
database::orderBy('created_at', 'DESC')->get(); 
 
 //pilih nama tertentu berdasarkan id foreignkey (berarrti ada array yang dimiliki id foreign key)
 $data = DB::table('record_stoks')->select('input')->where('bahan_id', $id)->get();
 dd($data);

// query data berdasarkan id atau value
   $aktivitas = aktivitas::where('karyawan_id', 1)->get();
       dd($aktivitas);
//maka query hasilnya mencari data (array) pada semua field yang mempunyai karyawan_id 1, akan tetapi array dihasilkan berdasarkan nilai index
//jika ingin menampilkan datanya berdasarkan value bisa melalu foreach atau seperti dibawah ini
dd($aktivitas[0]['jabatan']);
//ini berarti dd mencari data jabatan pada field jabatan pada tabel aktivitas
//bisa melakukan pengembalian dengan cara ini
 $aktivitas = aktivitas::where('karyawan_id', $karyawan->id)->get();
       $nota_id = array();
        foreach($aktivitas as $aksi){
            $nota_id[] = $aksi->karyawan->id;
        }        
        dd($nota_id);



//cth mencari user_id pada tabel karyawan
 $user_id =  Auth::user()->id;
$karyawan = karyawan::where('user_id', $user_id)->first();
echo $karyawan;
 
metode first() berfungsi untuk mencatat record pertama
 
 // akses dengan id foreign tertentu dengan array
$data = DB::table('record_stoks')->where('bahan_id', $id);
akses $data dengan foreach sesuai nama yang ingin ditampilkan berdasarkan field database
 
 //sort dengan urutan
   $data = DB::table('bahans')->orderBy('kategori', 'desc')->get();
 

//read query berdasarkan tahun dan bulan dan lain lain
  $database = kehadiran::whereYear('created_at', '=', $tahun)->whereMonth('created_at', '=', $bulan)






















 //datatable 1 kolom tabel 2 data field database query, cth 2 roll (2 adalah field angka, roll adalah field satuan dari DB yang sama
 public function show (Request $request, $id)
    {        
        if($request->ajax())
        {
            $data = record_stok::with('bahan')->where('bahan_id', $id)->orderBy('created_at', 'DESC')->latest()->get();;
            return DataTables::of($data)
                    ->addColumn('aksi', function($data){          
                        $button = ' <a href="#" data-name="'.$data->stok.'"  class="hapus btn btn-danger btn-sm"  data-id="'.$data->id.'"><i class="fa fa-trash"></i> Hapus</a>';
                        return $button;
                    })
                    ->rawColumns(['aksi'])
                   ->editColumn('input', function($tes)use($id) {
                            $satuan = bahan::find($id);
                            $input = $tes->input;
                            $input .= ' ';
                            $input .= $satuan->satuan;
                        return $input;
                    })            
                    ->make(true);
        }   
        $nama_bahan_id = $id;
        $nama_bahan = bahan::find($id)->nama;
        return view ('bahan_area.record_stok.show',compact('nama_bahan_id', 'nama_bahan') );
    }
 
 collumns di view blade table
    { data : 'input', name : 'input.satuan'},
 
 
 
 
 
 
 />
