https://stackoverflow.com/questions/24109535/how-to-update-column-value-in-laravel
edit database cuma satu kolom
<?php


 public function update(Request $request)
    {
        $id = $request->id_record_gajih;
            record_gajih::where('id', $id)
            ->update(array(
                'lain_lain'=> $request->lain_lain,
                'keterangan' => $request->keterangan,
                )
        );
        return response()->json('berhasil');

    }

update cuma satu field di data base
 
 dibawah ini lebih simpel
  public function update(Request $request)
    {
        $id = $request->id_record_gajih;
       $record = record_gajih::find($id);
        if($record) {
           $record->lain_lain = $request->lain_lain;
           $record->save();
       }
       
        return response()->json('berhasil');

    }
