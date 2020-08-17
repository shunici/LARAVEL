<?php
use Illuminate\Support\Facades\DB;
use DataTables;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use App\user;
use Auth;

//controller

   public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('siswas')->latest()->get();
            return DataTables::of($data)
                    ->addColumn('aksi', function($data){                                                                                                             
                       $button = ' <label class="radio-inline">';
                       $button .= '   <input class="lulus" type="radio" name="'.$data->id.'" data-id="'.$data->id.'" value="Aktif">Lulus';
                        $button .= '  </label> ';
                        $button .= ' <label class="radio-inline">';
                        $button .= '   <input class="lulus" type="radio" name="'.$data->id.'" data-id="'.$data->id.'" value="Gagal">Gagal';
                         $button .= '  </label> ';                       
                        return $button;
                    })                                
                   
                    ->rawColumns(['aksi'])                   
                    ->make(true);
        }      
        return view ('data_sekolah.laporan_penerimaan.index');
    }


public function status (Request $request)
    {      
        $siswa = siswa::find($request->id);
        if($siswa){
            $siswa->status = $request->value;
            $siswa->save();
        }
    }
    
    //blade view
    
     $(document).ready(function(){
                    $('#users-table').DataTable({                      
                            processing : true,
                            serverside : true,
                            ajax : "{{route('penerimaan-index')}}",
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian-Alternative.json"
                            },
                            columns : [
                          
                    {data : 'id', name : 'id'},
                    { data : 'nama', name : 'nama'},                 
                    {data : 'agama', name: 'agama'},  
                    { data : 'alamat', name : 'alamat'},                        
                    { data : 'jenis_kelamin', name : 'jenis_kelamin'},                                       
                    { data : 'foto', name : 'foto'},                             
                    {data : 'aksi', name : 'aksi', orderable : false, searchable:false, printable:false}
                
                ],                                                               
                
            });  //tutup users tabel                      


                 }); //tutup dokumen ready

         
                 $(document).on('click', '.lulus', function(){  
                    // e.preventDefault();                          
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });                                                                
                        var value = $(this).val();                      
                        var data_id = $(this).prop('name');                                            
                            $.ajax({
                                    type : 'post',
                                    url : "{{route('penerimaan-status')}}",
                                    data: {
                                        id:data_id,
                                        value : value,
                                        
                                    },
                                    success : function(data){
                                        //text
                                    }
                                })                
                      
                 }); //tutup dokumen gagal
                 
                 
