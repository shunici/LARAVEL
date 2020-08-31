<?php
//route
Route::get('penilaian', 'data_dinas\laporanController@penilaian')->name('penilaian');  
//controller
 public function penilaian (Request $request)
    {
       
        $tahun = Carbon::parse($request->date_picker)->format('Y');   
 
        $sekolahs = sekolah::all();
        $matpel = mata_pelajaran::all();
        $penilaian = tabel_penilaian::whereYear('created_at', $tahun)->get();
        $siswa = siswa::whereYear('created_at', $tahun)->get();
        return view('dinas.laporan.tabel_penilaian', compact(
            'sekolahs',
            'matpel',
            'penilaian',
            'siswa'
        ));
    }
    
 //blade form
 <form action="{{route('penilaian')}}" method="GET">         
      <label for="">Filter Berdasarkan Tahun</label>    
      <div class="input-group date">
        <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
        <input type="text" class="form-control pull-right" name="date_picker" id="datepicker">
      </div> 
      <input name="_token" type="hidden" value="{!! csrf_token() !!}">
      <button class="btn btn-info" type="submit"  name="filter" id="proses_filter"> Proses</button> 
      
      </button>    
  </form>
  
  //perhatian pencarian pada tabel yang didalamnya terdapat count (Division by zero ) tidak akan berfungsi untuk mengatasinya, maka dibuat pengkondisian if
  
  //contoh
       $nilai = $penilaian->where('mata_pelajaran_id', $mp->id)->where('sekolah_id', $sekolah->id);
          $jumlah_siswa = $siswa->where('sekolah_id', $sekolah->id)->where('status', 'Aktif')->count();
          //untuk mengatasi Division by zero 
          if($jumlah_siswa != 0){
              $rata2 = $nilai->sum('nilai')/$jumlah_siswa; 
          }else {
              $rata2 = 0;
          }
          
              <td>{{$rata2}}</td> 
              
              //dalam hal ini jika tidak ada pengkondisian maka hasil akan error..karena data yang dicari dengan filter perbulan tidak ada..maka buat lah pengkondisian seperti itu
 
 
    
    
