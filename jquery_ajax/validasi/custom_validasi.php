//php artisan make:rule namaValidasi
//buat logic di folder baru yang telah automatis dibuat

<?php
contoh :
deskripsi contoh : jika bukan programming maka tampilkan bukan hobi anda shunici

php artisan make:rule hobiValidasi

buka di foler rule hobiValidasi.php
<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class hobiValidasi implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!empty($value) ) {
            $kesukaan = 'programming';
            if($kesukaan == $value){
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ini bukan hobi anda shunici';
    }
}

controlller
use Illuminate\Support\Facades\Validator;
use App\Rules\hobiValidasi;

  public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'nama' => 'required',
            'hobi' => ['required', new hobiValidasi],
        ]); 
        

        if ($validator->passes()) {
            return response()->json([
                'sukses'=> $request->hobi,
               'url' => "/record_stok",              
                ]);
        }
        return response([
            'error' => $validator->errors()->all()
        ]);
    }

view blade php.

  <div class="form-group">
   <label for="nama">hobi</label>
   <input type="text" class="form-control" name="nama" placeholder="masukkan hobi nama">
  </div>
  
  <div class="form-group">
   <label for="hobi">hobi</label>
   <input type="text" class="form-control" name="hobi" placeholder="masukkan hobi shuni">
  </div>
<div class="box-footer">
   <input name="_token" type="hidden" value="{!! csrf_token() !!}">
   <button type="submit" class="btn btn-primary">Proses</button>
</div>

//pemerosesan dengan menggunakan jquery ajax seperti biasaa

sumber ilmu
https://www.youtube.com/watch?v=bsKOhgflCmI

/>
