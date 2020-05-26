<?php
//cara dibawah ini menggunakan closure database
controller
public function store(Request $request)
    {
        $stok = bahan::find($request->id_bahan)->stok;        
        $validator = validator::make($request->all(),[
            'id_bahan' => 'required',
            'stok' => [
                'required',              
                function ($attribute, $value, $fail) use($stok){                   
                    if ($value < $stok) {
                       return true;
                    }
                    $fail($attribute. ' Pengambilan melebihi jumlah stok');
                },
            ],

        ]);         

        if ($validator->passes()) {
            return response()->json([
                'sukses'=> 'berhasil coy',
               'url' => "/record_stok",              
                ]);
        }
        return response([
            'error' => $validator->errors()->all()
        ]);
    }


















/>
