$validator = Validator::make($request->all(),[
        'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
    ],$messages = [
        'mimes' => 'Please insert image only',
        'max'   => 'Image should be less than 4 MB'
    ]);

dd($validator->errors());
