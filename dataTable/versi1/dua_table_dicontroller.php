 public function index(Request $request)
    {
        if($request->ajax())
        {
            $kehadiran = kehadiran::with('karyawan')->get();
            $data = record_gajih::with('karyawan')->get();
            return DataTables::of($data)
                    ->addColumn('aksi', function($data){                      
                        $button = '<a href=" bahan/show/'.$data->id.' " class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';  
                        $button .= '&nbsp;<a href="bahan/edit/ '.$data->id.' " class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';                         
                        $button .= ' <a href="#" data-name="'.$data->nama.'"  class="hapus btn btn-danger btn-sm"  data-id="'.$data->id.'"><i class="fa fa-trash"></i></a>';
                        return $button;
                    })    
                    ->addColumn('karyawan_id', function($data){
                        return $data->karyawan->nama_lengkap;
                    })    
                    ->addColumn('jabatan', function($data){
                        return $data->karyawan->jabatan;
                    })   
                    ->addColumn('lemburan', function($data)use($kehadiran){
                        $lemburan =array();
                      foreach($kehadiran as $hadir){
                          if($data->karyawan_id == $hadir->karyawan_id) {
                             $lemburan [] = $hadir->lemburan;
                          }
                       
                      }
                     return $lemburan;
                    })        
                    ->rawColumns(['aksi', 'karyawan_id', 'jabatan', 'lemburan'])                 
                    ->make(true);
        }     
        return view ('data_karyawan.record_gajih.index');
    }
