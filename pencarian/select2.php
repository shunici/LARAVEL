semua tentang select2 dan pembahasan yang lengkap
https://www.it-swarm.dev/id/jquery-select2/
<?php   
// bower
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
<script src="{{asset('bower_components/select2/dist/js/select2.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.min.js')}}"></script>
  
  
  
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


//jika pada tahap pencarian dengan akal akalan supaya bahasa indonesia bisa membuat seperti ini
// https://www.it-swarm.dev/id/jquery-select2-4/bagaimana-anda-memodifikasi-bahasa-tidak-ada-hasil-di-select2-v4.0/1052504967/

<script>
   $('.cari').select2({
                        "language": {
                        "noResults": function(){
                            return "<a href='#' class='btn btn-danger'>Belum ada data yang cocok</a>";
                        }
                         },
                        escapeMarkup: function (markup) {
                            return markup;
                        },
                  
                    placeholder: 'Cari...',
                    type : 'get',
                    ajax: {
                    url: '{{route('mutasi-cari')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                        results:  $.map(data, function (item) {
                            return {
                            text: item.nama,
                            id: item.id
                            }
                        })
                        };
                    },
                    cache: true
                    }
                }); //tutup cari
</script>
