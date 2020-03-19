<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validasi ajax</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body style="background-color : grey">
{{-- error --}}
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
<div class="container" >
    <div class="row">        
        <div class="col-md-12">
            <h1>insert data</h1>
            <form action="#" method="post">                     
                    <input type="text" name="nama" class="form-control" placeholder="nama">   
                   <input type="text" name="keterampilan" class="form-control" placeholder="keterampilan">   
                    <input name="_token" type="hidden" value="{!! csrf_token() !!}">
            <button class="btn btn-info" type="submit">tambahkan</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
 
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $('form').submit(function(e){
        var CSRF_TOKEN = $('input[name="_token"]').attr('value');
        var keterampilan = $("input[name='keterampilan']").val();
        var nama =  $('#nama').val();
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/pos_data",
            data: {
                '_token' : CSRF_TOKEN,
                nama :nama,
                keterampilan:keterampilan,
            },
            dataType: "json",
            success: function (data) {
                if($.isEmptyObject(data.error)){
                alert(data.success);
                }else{
                printErrorMsg(data.error);
                }
            }
        });
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
        
    });
  
});

</script>


</body>
</html>

//route

<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Route::get('/', function(){
    return view ('index');
});

Route::post('/pos_data', function(Request $request){
    $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'keterampilan' => 'required',      
    ]);
    if ($validator->passes()) {
        return response()->json(['success'=>'Added new records.']);
    }
    return response()->json(['error'=>$validator->errors()->all()]);
});

?>
