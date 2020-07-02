<?php   
  
  <div class="form-group">
      <label for="no_telp">Data</label>
      <select type="text" class="cari form-control" id="no_telp" name="cari" style="width:500px;" ></select>
  </div>


<script>

 $('.cari').select2({
        placeholder: 'Cari...',
        type : 'get',
        ajax: {
        url: '{{route('nombok-transaksi-cari')}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
                return {
                text: item.nama_file,
                id: item.id
                }
            })
            };
        },
        cache: true
        }
    }); //tutup cari
</script>

//route
    Route::get('cari','data_karyawan\nombokController@cari')->name('nombok-transaksi-cari');


//controller

 public function cari(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = transaksi::select('id', 'nama_file')
                     ->where('nama_file', 'like', '%' .$cari. '%')->get();
            return response()->json($data);
        }
       
    }
  
  //kelemahan nya adalah cuma 2 data aja yaitu id dan nama file, belum lagi jika ada proses query lainnya


