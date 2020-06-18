<?php
//read paling akhir
 $stok_records = DB::table('record_stoks')->where('bahan_id', 2)->latest()->first();
 
 
 //pilih nama tertentu berdasarkan id foreignkey (berarrti ada array yang dimiliki id foreign key)
 $data = DB::table('record_stoks')->select('input')->where('bahan_id', $id)->get();
 dd($data);

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
