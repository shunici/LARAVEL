@extends('layouts.master')

@section('title', 'Tambah Outlet')

@section('content')


@include('data_user.user.section_header')
<section class="content">
            @component('components.box_primary')
                    @slot('header')
               <h2>Otorisasi User</h2>
                    @endslot
                    @slot('body')
                        <div class="row">
                            <div class="col-md-4"> @include('data_user.role.tambah')  </div>
                            <div class="col-md-8"> @include('data_user.role.tabel') </div>
                        </div>
                    @endslot
            @endcomponent
</section>
@endsection

