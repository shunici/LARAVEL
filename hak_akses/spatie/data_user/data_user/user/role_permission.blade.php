@extends('layouts.master')

@section('title', 'Role Permission')

@section('content')
<style type="text/css">
    .tab-pane{
        height:150px;
        overflow-y:scroll;
    }
</style>
@include('data_user.user.section_header')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
{{ $message }}
</div>
@endif
<section class="content">
            @component('components.box_primary')
                    @slot('header')
                   Tambah Tindakan Baru                 
                    @endslot
                    @slot('body')
                      <div class="row">
                            <div class="col-md-4">
                                <form action="{{ route('users.add_permission') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">
                                           Buat Baru
                                        </button>
                                    </div>
                                </form>

                                <table class="table  table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tindakan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; ?>
                                            @if (!empty($permissions))
                                            @forelse ($permissions as $item)                                                                                                                                                                                     
                                            <tr>
                                            <td scope="row">{{$no++}}</td>
                                                <td>{{$item}}</td>
                                                <td>
                                                    <form action="#" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                                </td>
                                            </tr> 
                                            @empty
                                            <tr><td colspan="3">Tak ada data</td></tr>
                                            @endforelse   
                                            @endif                                     
                                        </tbody>
                                </table>

                            </div>
                            {{-- end col-md4 --}}
                            <div class="col-md-8">
                                Set Tindakan ke Peran
                                <form action="{{ route('users.roles_permission') }}" method="GET">
                                    <div class="form-group">
                                        <label for="">Peran</label>
                                        <div class="input-group">
                                            <select name="role" class="form-control" style="height: 35px">
                                                @foreach ($roles as $value)
                                                    <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger">Periksa!</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                                
                                @if (!empty($permissions))
                                    <form action="{{ route('users.setRolePermission', request()->get('role')) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-group">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1" data-toggle="tab">Tindakan</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1">
                                                        @php $no = 1; @endphp
                                                        @foreach ($permissions as $key => $row)
                                                            <input type="checkbox" 
                                                                name="permission[]" 
                                                                class="minimal-red" 
                                                                value="{{ $row }}"
                                                                {{--  CHECK, JIKA PERMISSION TERSEBUT SUDAH DI SET, MAKA CHECKED --}}
                                                                {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                                > {{ $row }} <br>
                                                            @if ($no++%4 == 0)
                                                            <br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="pull-right">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-send"></i> Set Tindakan
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                            </div>


                      </div>
                     

                    @endslot
            @endcomponent
</section>
@endsection

