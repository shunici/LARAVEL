</php

posisi di controller
 date_default_timezone_set('Asia/Jakarta');
\Date::setLocale('id');


// output jum'at, 20 mei 2020
 $data = record_stok::with('bahan')->where('bahan_id', $id)->orderBy('created_at', 'DESC')->latest()->get();;
            return DataTables::of($data)                    
                    ->editColumn('created_at', function ($data) {
                        return  Date::parse($data->created_at)->format('l, j F Y');
                    })->make(true);
  
// output 























/>
