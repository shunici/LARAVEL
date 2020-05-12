//model
chat_admin.php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat_admin extends Model
{
    protected $fillable = ['id','pesan', 'foto', 'user_id', 'created_at'];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    // public function user()
    // {
    //     return $this->belongsTo('App\user');
    // }
}

//controller
dataController.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chat_admin;
use App\user;

use Yajra\Datatables\Datatables;
use Jenssegers\Date\Date;

use Carbon\Carbon;
class dataController extends Controller
{
    public function index (Request $request)
   
    {
     Date::setLocale('id');
     if ($request->ajax()){
         $data_base = chat_admin::with('user');
         
         return Datatables::of($data_base)
             ->addColumn('action', function ($data_base) {
                 return '<a href="shun/'.$data_base->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
             })           
 
             ->editColumn('created_at', function ($data_base) {
                 return  Date::parse($data_base->created_at)->format('l, j F Y');
             }) 
             //jika kolom pesan kosong tambahi madahi mujahid
             ->editColumn('pesan', function($data_base){
                 if($data_base->pesan == ''){
                     return 'madani mujahid';
                 }else{
                    return $data_base->pesan;
                 }
             })
             
             ->addColumn ('foto', function($data_base){
                return '<img style="width: 140px;" src="/chat/'.$data_base->foto.'">';
            
             })
             
             ->addColumn('user', function(chat_admin $tes) {
                return $tes->user->name;
            })
            ->rawColumns(['foto', 'action'])
             ->toJson();
             
     }
    
     return view ('data');
    }

}
//route
Route::get('/', 'dataController@index')->name('data-index');

Route::get('shun/{id}', function(){
    return 'tesss';
});

//view blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            background-color: grey;
        }
    </style>
    <title>datatable from shuni</title>


   <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">

   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">


</head>
<body>
    <h1 class="text-center">Data Profil Muhammad Noviyanur</h1>
    
   <div class="container">
       <div class="row">
           <div class="col-md-12">
            <table class="table table-bordered" id="users-table">
                <thead>               
                 <tr>
                    <th>id</th>
                    <th>pesan</th>
                    <th>foto</th>
                    <th>user</th>  
                    <th>created at</th>               
                    <th>aksi</th>
                </tr>
                </thead>
                <tbody>
        
                </tbody>
            </table>
        
           </div>
       </div>
   </div>

   
   <script src="{{url('js/jquery.min.js')}}" ></script>
   <!-- ini untuk bootstrap -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" ></script>
   <script src="{{url('js/bootstrap.min.js')}}"></script>
   <!-- end bootstrap -->

   <!-- ini untuk datatables -->
   <script src="{{url('js/jquery.dataTables.min.js')}}"></script>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


    <script>
       $(document).ready(function(){
        $('#users-table').DataTable({
            processing : true,
            serverside : true,
            ajax : '{{route('data-index')}}',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian-Alternative.json"
            },
            columns : [
                {data : 'id', name : 'id'},
                { data : 'pesan', name : 'pesan'},
                {data : 'foto', name: 'foto'} ,
                {data : 'user', name : 'user.name'},
                {data : 'created_at', name : 'created_at'} ,
                {data : 'action', name : 'action'}            
              
            ],
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'pdf',
                footer: true,
                exportOptions: {
                        columns: [1,2]
                    }
            },
            {
                extend: 'csv',
                footer: false
                
            },
            {
                extend: 'excel',
                footer: false
            }         
            ]  
         
            
        })

       })

        </script>  
     
</body>

</html>
