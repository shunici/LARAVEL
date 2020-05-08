blade//
data.blade.php
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

</head>
<body>
    <h1>data base yajra latihan</h1>
   <div class="container">
       <div class="row">
           <div class="col-md-12">
            <table class="table table-bordered" id="users-table">
                <thead>               
                 <tr>
                    <th>id</th>
                    <th>Nama</th>
                    <th>keterampilan</th>
                    <th>intro</th>
                    <th>dibuat</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
        
                </tbody>
            </table>
        
           </div>
       </div>
   </div>

   
    
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
 
    <!-- print-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

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
                { data : 'nama', name : 'nama'},
                {data : 'keterampilan', name: 'keterampilan'},
                {data : 'intro', name : 'intro'},
                {data : 'created_at', name : 'created_at'},
                {data : 'action', name : 'action', orderable : true, searchable:true}
              
            ],

            //print dan desain letterhead
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                {
                    extend: 'print',
                    orientation: 'potrait',
                    pageSize: 'a4',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                                '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                            );
    
                            $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'impact' )
                            .css('background-color', 'yellow')
                           
                        
                            $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                            $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                                $(this).css('background-color','grey');
                            });
                            $(win.document.body).find('h1').css('text-align','center');
                            $(win.document.body);

                    }
                }
            ]

            
        })

       })

        </script>     
</body>

</html>

//controller

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\profil;
use DataTables;
use Jenssegers\Date\Date;

use Carbon\Carbon;
class dataController extends Controller
{
   public function index (Request $request)
   
   {
    Date::setLocale('id');
    if ($request->ajax()){
        $users = profil::select(['id', 'nama', 'keterampilan', 'created_at'])->get();

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a href="shun/'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->editColumn( 'nama', 'ronaldo {{$nama}}') 

            ->editColumn('created_at', function ($user) {
                return  Date::parse($user->created_at)->format('l, j F Y');
            })
            ->addColumn('intro', 'wahai {{ $nama }}!')        
            ->toJson();
            
    }
   
    return view ('data');
   }



}

//route
<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'dataController@index')->name('data-index');
Route::get('/data', 'dataController@json')->name('data_json');

Route::get('shun/{id}', function(){
    return 'tesss';
});
