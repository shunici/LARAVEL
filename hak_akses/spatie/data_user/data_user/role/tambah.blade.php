
@if (session('error'))
    @alert(['type' => 'danger'])
        {!! session('error') !!}
    @endalert
@endif

<form role="form" action="{{ route('role.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Tambah Peran Baru</label>
        <input type="text" 
        name="name"
        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" id="name" required>
    </div>

    <div class="card-footer">
        <button class="btn btn-primary">Simpan</button>
    </div>
</form>
