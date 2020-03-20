<!DOCTYPE html>
<html lang="en">
<head>
    
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>halaman dengan ajax jquery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
</head>
<body>
   
   <div class="container">
       <div class="row">
           <div class="col-md-12">
            <h1>membuat halaman pagination dengan ajax jquery</h1>
            @if (count($kirim) > 0)
            <section class="articles">
                    <div id="load" style="position: relative;">
                        @foreach($kirim as $kirim_1)
                            <div>
                                <h3>
                                    <a href="{{$kirim_1->id}}">{{$kirim_1->nama }}</a>
                                </h3>
                            </div>
                        @endforeach
                        </div>
                        {{ $kirim->links() }}
             </section>
            @endif
            
           </div>
       </div>
   </div>
    <script>

$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

        var url = $(this).attr('href');  
        getArticles(url);
        window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('.articles').html(data);  
            // alert(data);
        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }
});
//pada pagination ini mengguakan history.pushStat yang mana data itu sudah diload secara keseluruhan tetapi disembunyikan
//coba buka alert data yang berkomentar diatas maka akan tahu cara kerja sistem pagination ini.. sistem akan membaca data keselurhan html makanya terjadi //penulisan double h1 judul pada contoh diatas, untuk mengakali kejadian tersebut foreach tersebut harus dibuat terpisah filenya dengan menggunakan blade templating includ
    </script>  

</body>
</html>

//route
<?php

use Illuminate\Support\Facades\Route;
use App\profil;
use Illuminate\Http\Request;


Route::get('/', function(Request $request){
   $kirim = profil::paginate(3);
   if ($request->ajax()) {
    return view('index', ['kirim' => $kirim])->render();  
    }
    return view ('index',  compact('kirim'));
});
?>
