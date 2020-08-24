@extends('layouts.master')

@section('title', 'Tambah User Baru')

@section('content')

@include('data_user.user.section_header')

<section class="content">
            @component('components.box_primary')
                    @slot('header')
            Tambah User Baru
                    @endslot
                    @slot('body')
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select style="height: 35px" name="role" class="form-control {{ $errors->has('role') ? 'is-invalid':'' }}" required>
                                <option value="">Pilih</option>
                                @foreach ($role as $row)
                                <option value="{{ $row->name }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('role') }}</p>
                        </div>
                        <div class="form-g
                        roup">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-send"></i> Simpan
                            </button>
                        </div>
                    </form>
                    @endslot
            @endcomponent
</section>
@endsection

