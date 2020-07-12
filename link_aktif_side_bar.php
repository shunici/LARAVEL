side bar head bar link aktif

       <li class="{{ (request()->is('karyawan/bonus')) ? 'active' : '' }}"><a href="{{route('karyawan-bonus')}}"><i class="fa fa-map-pin"></i> <span>Bonus</span></a></li>  
       
       
       //route
        Route::get('karyawan/bonus', 'data_user\karyawan_dataController@karyawan_bonus')->name('karyawan-bonus'); 
