<?php

//model purchases
 public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('bank_acc_number');
            $table->string('company');
            $table->timestamps();
        });
    }

//model customer table
 Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->timestamps();
        });
        
  // model relasi

//customer
class Customer extends Model
{
    protected $fillable = ['first_name','last_name','email'];
    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'customer_id', 'id');
    }
}

//purchase
class Purchase extends Model
{
    protected $fillable = [
        'bank_acc_number',
        'customer_id',
        'company'
    ];
}



//route
Route::get('tampilkan', 'tampilController@index')->name('tampil');
Route::get('/tampilkan_master', 'tampilController@data')->name('tampil_master');
Route::get('/tampilkan_master/{id}', 'tampilController@data_tampil')->name('tampil_master_detil');

//controller

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Yajra\Datatables\Datatables;


class tampilController extends Controller
{
    public function index ()
    {
        return view ('ditel.index');
    }

    public function data (Request $request)
    {
        $datas = Customer::select();
        return Datatables::of($datas)
        ->addColumn('ditel_url', function($data){
            return route('tampil_master_detil', $data->id);
        })->make(true);
    }

    public function data_tampil($id)
    {
        $purchases = Customer::findOrFail($id)->purchases;
        return Datatables::of($purchases)->make(true);
    }
    
}

//blade disini asumsinya sudah dibuat master blade untuk link datatable dan jquery atau yang lainnya


@extends('layouts.app')
@section('content')
<div class="panel-heading">Master details</div>
<div class="panel-body">
    <table class="table table-bordered" id="customers-table">
        <thead>
        <tr>
            <th></th>
            <th>Id</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
    </table>
</div>
@endsection

@section('javascript')
<script id="ditel-table" type="text/x-handlebars-template">
    @verbatim
    <div class="label label-info">Customer {{ first_name }}'s Purchases</div>
    <table class="table details-table" id="purchases-{{id}}">
        <thead>
        <tr>
            <th>Id</th>
            <th>Bank account number</th>
            <th>Company</th>
        </tr>
        </thead>
    </table>
    @endverbatim
</script>

<script>
    var template = Handlebars.compile($("#ditel-table").html());
    var table = $('#customers-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route('tampil_master') }}',
      columns: [
        {
          "className":      'details-control',
          "orderable":      false,
          "searchable":     false,
          "data":           null,
          "defaultContent": ''
        },
        { data: 'id', name: 'id' },
        { data: 'first_name', name: 'first_name' },
        { data: 'last_name', name: 'last_name' },
        { data: 'email', name: 'email' },
        { data: 'created_at', name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' },
      ],
      order: [[1, 'asc']]
    }); //tutup datatable

     // Add event listener for opening and closing details
     $('#customers-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'purchases-' + row.data().id;

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
          processing: true,
          serverSide: true,
          ajax: data.ditel_urls,
          columns: [
            { data: 'id', name: 'id' },
            { data: 'bank_acc_number', name: 'bank_acc_number' },
            { data: 'company', name: 'company'}
          ]
        })
      }
 
  </script>
@endsection

