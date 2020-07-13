pastikan settingan css dan javascript mengikuti settingan sebelumnya..
<?php 
//route
Route::group(['prefix' => 'agenda'], function(){
    Route::get('/', 'data_cetakan\agendaController@index')->name('agenda-index');
    Route::post('/create', 'data_cetakan\agendaController@create')->name('agenda-create');
    Route::post('/', 'data_cetakan\agendaController@delete')->name('agenda-delete');
   
});

////////controller

use App\agenda_kerja; //tabelnya
use Calendar;
use Jenssegers\Date\Date;
use carbon;
use Validator;
 public function index()
      {
    	$agenda = agenda_kerja::get();
    	$agenda_list = [];
    	foreach ($agenda as $key => $event) {
    		$agenda_list[] = Calendar::event(
                $event->judul,                
                true,
                new \DateTime($event->mulai_tgl),
                new \DateTime($event->akhir_tgl.' +1 day'),
                $event->id,
                [
                    'color' => $event->warna,
                ]
            );
    	}
    	$kalender_detail = Calendar::addEvents($agenda_list)->setOptions(['lang' => 'id']); 
 
        return view('agenda_kerja.index', compact('kalender_detail', 'agenda'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'warna' => 'required',
            'mulai_tgl' => 'required'            
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Masukkan Data Yang Valid');
            return Redirect('/agenda')->withInput()->withErrors($validator);
        }
 
        $event = new agenda_kerja;
        $event->judul = $request['judul'];
        $event->warna = $request['warna'];
        $event->mulai_tgl = $request['mulai_tgl'];
        $event->akhir_tgl = $request['akhir_tgl'];
        $event->save();
 
        \Session::flash('success','Agenda Berhasil Ditambahkan');
        return Redirect('/agenda');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $data = agenda_kerja::find($id); 
        $data->delete();
        \Session::flash('success','Berhasil dihapus');         
    }

///di bladenya

//menampilkan kalendernya di blade

 <div class="panel panel-primary">
      <div class="panel-heading">Agenda Kerja</div>
      <div class="panel-body" >
        {!! $kalender_detail->calendar() !!}
        {!! $kalender_detail->script() !!}
      
      </div>
    </div>
    
//form create di blade
<form role="form" action="{{route('agenda-create')}}" method="post" enctype="multipart/form-data">      
  {{@csrf_field()}}
        <div class="box-body">   
            <div class="form-group">
                <label for="judul">Nama Agenda</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan nama Kegiatan">
            </div>
            <div class="form-group">
                <label for="warna">Pilih Warna</label>
                <input type="color" class="form-control" id="warna" name="warna" placeholder="Masukkan nama Kegiatan">
            </div>
          <div class="form-group">
            <label>Mulai Tanggal</label>      
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="mulai_tgl">
            </div>
          </div>
          <div class="form-group">
            <label>Akhir Tanggal</label>      
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="akhir_tgl">
            </div>
          </div>    
          
        </div>
        <!-- /.box-body --> 
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Proses</button>
        </div>
    </form>        
 <script>
 //tambahkan link datepicker untuk memfungsikan sintax ini
     $(document).ready(function(){
        $('.input-group.date').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD'
            });
     })

 </script>
 
 
