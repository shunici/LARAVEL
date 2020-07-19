<?php 
model//
transaksi
 protected $fillable = ['pelanggan_id', 'nota_id', 'nama_file', 'produk_id', 'bahan_id',
 'uk_pjg', 'uk_lebar','satuan_uk', 'jumlah', 'ket_cetakan', 'kategori_cetakan', 'total',
 'keterangan', 'status_cetakan',  'foto_desain'];
 
 //nota
   protected $fillable = ['pelanggan_id', 'nama_pelanggan', 'no_hp', 'status_pelanggan',
   'total_lunas', 'lunas', 'total_dp', 'total_bayar_cetakan', 'dp', 'estimasi_desain', 'estimasi_ambil', 'status_cetakan', 'bentuk_file'];
    public function transaksis()
    {
        return $this->hasMany('App\transaksi', 'nota_id', 'id');
    }
    
    
  //blade
  @extends('layouts.master')
@section('content')
<section class="content-header">
    <a href="{{ URL::previous() }}" class="btn btn-success"><i class="fa fa-arrow-circle-left "></i>  Kembali</a>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user-secret"></i> Tambah Outlet</a></li>
            
        </ol>
    </section>
    <section class="content">
  
            @component('components.box_primary')
            @slot('header')
            Master details
            @endslot
            @slot('body')            
                <div class="panel-body">
                    <table class="table table-bordered" id="users-table">
                        <thead>
                        <tr>
                            <th><i class="fa fa-file"></i> </th>
                            <th>Id</th>
                            <th>Pelanggan</th>
                            <th>HP</th>
                            <th>Status</th>
                            <th>Estimasi</th>
                            <th>DP</th>                             
                            <th>Total</th> 
                            <th>Status Cetakan</th>      
                        </tr>
                        </thead>
                    </table>
                </div>
            @endslot
            @endcomponent
        </section>

@endsection




@section('javascript_dt')
<script id="ditel-table" type="text/x-handlebars-template">
    @verbatim
    <div class="label label-info">Rincian Cetakan {{ nama_pelanggan }}'</div>
    <table class="table details-table" id="nama-{{id}}">
        <thead>
        <tr>
            <th>Id</th>
              <th>Nama File</th>
              <th>Kategori Cetakan</th> 
              <th>Bahan</th>
              <th>Detil</th>
        </tr>
        </thead>
    </table>
    @endverbatim
</script>

<script>
    var template = Handlebars.compile($("#ditel-table").html());
    var table = $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route('laporan_cetakan-data') }}',
      "language": {
                                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian-Alternative.json"
                             },
      columns: [
        {
          "className":      'details-control',
          "orderable":      false,
          "searchable":     false,
          "data":           null,
          "defaultContent": ''
        },
        {data : 'id', name : 'id'},
             { data : 'nama_pelanggan', name : 'nama_pelanggan'},
             {data : 'no_hp', name: 'no_hp'},
             {data : 'status_pelanggan', name: 'status_pelanggan'},
             {data : 'estimasi_ambil', name: 'estimasi_ambil'},
             {data : 'dp', name: 'dp'},                                                                                                
             {data : 'total_bayar_cetakan', name: 'total_bayar_cetakan'},
             {data : 'status_cetakan',  name : 'status_cetakan'}      
      ],
      order: [[1, 'asc']],
      dom: 'Bfrtip',
    }); //tutup datatable

     // Add event listener for opening and closing details
     $('#users-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'nama-' + row.data().id;

        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
        } else {
          // Open this row
          row.child(template(row.data())).show();
          initTable(tableId, row.data());
          console.log(row.data());
          tr.addClass('shown');
          tr.next().find('td').addClass('no-padding bg-gray');
        }
      });

      function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            "searching": false,
            "paging":   false,
        "ordering": false,
        "info":     false,
          processing: true,
          serverSide: true,
          ajax: data.ditel_urls,
          columns: [
            { data: 'id', name: 'id' },
            { data: 'nama_file', name: 'nama_file' },
            { data: 'kategori_cetakan', name: 'kategori_cetakan'},
            { data: 'bahan_id', name: 'bahan_id'},
            { data: 'detil', name: 'detil'},

          ]
        })
      }
 
  </script>
@endsection

//route
Route::group(['prefix' => 'laporan'], function(){
    Route::get('/', 'data_cetakan\laporanController@index')->name('laporan_cetakan-index');
    Route::get('/data', 'data_cetakan\laporanController@data')->name('laporan_cetakan-data');
    Route::get('/data/{id}', 'data_cetakan\laporanController@ditel')->name('laporan_cetakan_ambil');         
});

//controller
<?php

namespace App\Http\Controllers\data_cetakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Image;
use App\produk;
use App\bahan;
use App\pelanggan;
use App\user;
use App\transaksi;
use Yajra\Datatables\Datatables;
use App\nota;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class laporanController extends Controller
{
    public function index ()
    {
       

        return view ('data_cetakan.laporan_cetakan.index');
    }
    public function data ()
    {
        $datas = nota::select( ['id', 'pelanggan_id', 'nama_pelanggan', 'no_hp', 'status_pelanggan', 'total_lunas', 'lunas', 'total_dp', 'total_bayar_cetakan', 'dp', 'estimasi_desain', 'estimasi_ambil', 'status_cetakan', 'bentuk_file']);
        return Datatables::of($datas)
        ->addColumn('ditel_urls', function($data){
            return route('laporan_cetakan_ambil', $data->id);
        })->make(true);
       
    }

    public function ditel($id)
    {

        $bahans = bahan::all();
        $transaksi = nota::findOrFail($id)->transaksis;
        return Datatables::of($transaksi)
        ->editColumn('bahan_id', function($transaksi){
           $kolom = transaksi::with('bahan')->where('id', $transaksi->id)->first();
            return $kolom->bahan->nama;
        })
        ->editColumn('detil', function($transaksi){
            $kolom = $transaksi->uk_pjg;
            $kolom .= ' x ';
            $kolom .= $transaksi->uk_lebar;
            $kolom .= ' ';
            $kolom .= $transaksi->satuan_uk;
            $kolom .= ' ';
            $kolom .= $transaksi->jumlah;
            $kolom .= ' pcs';
            return $kolom;
        })
        ->rawColumns(['bahan_id', 'detil'])->make(true);
    }
}
