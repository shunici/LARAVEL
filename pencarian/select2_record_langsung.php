
<?php

//route
 Route::get('cari', 'data_sekolah\ajarController@cari_pegawai')->name('ajar-cari');
 
//controller
 public function cari_pegawai(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = pegawai_sekolah::select('id', 'nama')
                     ->where('nama', 'like', '%' .$cari. '%')->get();
            return response()->json($data);
        }
    }

//blade view
  <select class="cari form-control" name="pegawai_sekolah">                              
      @foreach ($pegawai as $tag)
          <option value="{{ $tag->id }}" selected="selected">{{ $tag->nama }}</option>
      @endforeach                             
</select>


//js
<script>
 //cari
                    $('.cari').select2({
                        "language": {
                        "noResults": function(){
                            return "Belum ada data yang cocok";
                        }
                         },
                        escapeMarkup: function (markup) {
                            return markup;
                        },                   
                    tokenSeparators: [','],

                    placeholder: 'Cari...',
                    type : 'get',
                    ajax: {
                    url: '{{route('ajar-cari')}}',
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
