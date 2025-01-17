<?php
//route
 Route::get('/', 'data_karyawan\controller@index')->name('record-gajih-index');
 
 //blade
<form action="#" method="GET"> 
        
    <label for="">Filter Berdasarkan Bulan</label>    
    <div class="input-group date">
      <div class="input-group-addon"> <i class="fa fa-calendar"></i></div>
      <input type="text" class="form-control pull-right" name="date_picker" id="datepicker">
    </div> 
    {{-- <input name="_token" type="hidden" value="{!! csrf_token() !!}"> --}}
    <button class="btn btn-info" type="submit"  name="filter" id="proses_filter"> Proses</button> 
 
    </button>    
</form>

//dibagian sini blade tabel

     
 //controller
     
   public function index(Request $request)
    {

        if($request->ajax())
        {    
            if(!empty($request->filter)){
                $tahun = Carbon::parse($request->filter)->format('Y');
                $bulan = Carbon::parse($request->filter)->format('m');   
                 $waktu = \Date::parse(Date::now())->format('l, j F Y');
                 $data = record_gajih::with('karyawan')->whereYear('created_at', '=', $tahun)
            ->whereMonth('created_at', '=', $bulan)->get();  
            }else{
                $waktu = \Date::parse(Date::now())->format('l, j F Y');
                $data = record_gajih::with('karyawan')->get();  
            }                                
            return DataTables::of($data)->make(true);
        }   //tutup if  
        return view ('data_karyawan.record_gajih.index', compact('waktu'));
    } //tutup function index  
     
     
     
     
<script> $('.input-group.date').datetimepicker({
        locale: 'id',
        format: 'YYYY-MM'    
        });  
        
           load_data();
            function load_data (filter){
            //datatable
            $('#users-table').DataTable({
             processing : true,
             serverside : true,
             ajax : {
                url : "{{route('record-gajih-index')}}",
                data : { filter : filter },
             },
            }); //tutup datatab;e
} //tutup fungsi
 $('#proses_filter').click(function(e){
    e.preventDefault();
    var filter = $('#datepicker').val(); 
    if(filter != '')
        {
        $('#users-table').DataTable().destroy();
        load_data(filter);
        }
        else
        {
        alert('Anda Harus memilih bulan');
    }
}); //tutup proses filter
  </script>
  
  
//lebih disempelkan pada bagian controller
   public function index(Request $request)
    {
        if($request->ajax()){
          $tahun = date('Y');
            if(!empty($request->filter)){
            $tahun = Carbon::parse($request->filter)->format('Y');                                
            }   
            $data = kinerja::with('karyawan')->whereYear('created_at', '=', $tahun)->get();
            return DataTables::of($data)                                                    
                    ->make(true);
        }          
        return view ('data_karyawan.kinerja.index');
    }


?>

