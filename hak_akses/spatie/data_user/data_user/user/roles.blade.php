@extends('layouts.master')

@section('title', 'Set Role')

@section('content')


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
                    Set Role
                    @endslot
                    @slot('body')
                    <form action="{{ route('users.set_role', $user->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                   
                      
                        
                      
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>:</td>
                                        <td>
                                            @foreach ($roles as $row)
                                            <input type="radio" name="role" 
                                                {{ $user->hasRole($row) ? 'checked':'' }}
                                                value="{{ $row }}"> {{  $row }} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>                     
                          

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Set Role</button>
                                </div>
                 
              
                    </form>
                    @endslot
            @endcomponent
</section>
@endsection

