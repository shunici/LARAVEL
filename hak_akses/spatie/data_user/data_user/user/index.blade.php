@extends('layouts.master')

@section('title', 'Pengaturan User')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
{{ $message }}
</div>
@endif
@include('data_user.user.section_header')


<section class="content">
            @component('components.box_primary')
                    @slot('header')
              <h3>Pengaturan User</h3>
                  <a href="{{ route('users.create') }}" class="btn btn-primary pull-right">Tambah User Baru</a>
                    @endslot
                    @slot('body')
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nama</td>
                                    <td>Email</td>
                                    <td>Role / Peran</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($users as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        @foreach ($row->getRoleNames() as $role)
                                        <label for="" class="badge bg-orange">{{ $role }}</label>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($row->status)
                                        <label   data-toggle="modal" data-target="#modal-default"  class="badge bg-green">Aktif</label>
                                        @else
                                        <label  data-toggle="modal" data-target="#modal-default"  for="" class="badge bg-red">Tidak Aktif</label>
                                        @endif
                                        @include('data_user.user.aktivasi_modal') 
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="{{ route('users.roles', $row->id) }}" class="btn btn-info btn-sm"><i class="fa fa-user-secret"></i></a>
                                            <a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @endslot
            @endcomponent   
                       
</section>
@endsection

