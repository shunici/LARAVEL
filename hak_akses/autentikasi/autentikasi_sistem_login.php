membuat authentikas sistem login
//referensi https://mragus.com/autentikasi-user-menggunakan-role-dan-middleware-di-framework-laravel/

//cara kerja// jika user auth masuk yang mempunyai field status 1 (model data) maka dia bisa memasuki sistem
//proses ini berfokus pada file di posisi kernel.php yang didalamnya terdapat skrip yang dibuat 'role' => \App\Http\Middleware\peranMiddleware::class,
//kemudian proses ini juga berfokus pada file yang dibuat dengan artisan yang terletak pada folder middleware

//langkah langkah
satu buat file dengan menggunakan artisan
php artisan make:middleware peranMiddleware

//setelah dibuat kemudian isi data ini pada posisi folder middleware cari peranMiddleware
<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
class peranMiddleware

{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = Auth::user();
        if ( $data['status'] == 1) {
            return $next($request);
            }
            return redirect()->intended('belum_aktif');
    }
}

// arti dari file diatas iyalah jika user yang login tidak memiliki status yang bernilai 1, maka dia akan dikembalikan ke halaman belum_aktif.blade.php

pengisian pada route 
  
Route::group(['middleware' => 'role','auth'
       //user berhasil melewati authentikasi       
}); //tutup midleware

 // ini user yang gagal melewati authentikasi
Route::get('belum_aktif', function(){    
    return view ('auth.belum_aktif');
});

              


