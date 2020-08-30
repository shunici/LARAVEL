<?php

class mata_pelajaran extends Model
{
    protected $fillable = ['nama', 'nilai_kelulusan', 'tahun_ajaran'];
}

//==================
//sekolah model bla bla bla
// tabel penilaian
  protected $fillable = ['sekolah_id', 'siswa_id','kelas_id', 'mata_pelajaran_id', 'nilai', 'tahun_ajaran'];
  
  

  
  
  
  
  
  
  
  
  
  
  <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">                           
                          <tbody>  
                        <tr>
                                <th>No</th>
                                <th>Nama Sekolah</th>
                               @foreach ($matpel as $mp)
                               <th>{{$mp->nama}}</th> 
                               @endforeach                                                             
                        </tr>

                            <?php  $i=1;?>
                            @foreach ($sekolahs as $sekolah)                                             
                          <tr>       
                                <td>{{$i++}}</td>                                                                              
                                <td>{{$sekolah->nama_sekolah}}</td>

                                @foreach ($matpel as $mp)
                               @php $nilai = $penilaian->where('mata_pelajaran_id', $mp->id)->where('sekolah_id', $sekolah->id); @endphp
                                <td>{{$nilai->sum('nilai')}}</td> 
                                @endforeach                                                                                            
                                
                          </tr>   
                          @endforeach                        
                        </tbody>
                    </table>
                      </div>
                      
                      //controller
                       public function penilaian ()
    {
        $sekolahs = sekolah::all();
        $matpel = mata_pelajaran::all();
        $penilaian = tabel_penilaian::all();
        return view('dinas.laporan.tabel_penilaian', compact(
            'sekolahs',
            'matpel',
            'penilaian'
        ));
    }
      
