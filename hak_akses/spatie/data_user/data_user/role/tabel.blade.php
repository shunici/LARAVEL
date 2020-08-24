
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
{{ $message }}
</div>
@endif

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <td>No</td>
                <td>Peran / role</td>
                <td>Guard</td>
                <td>Waktu</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse ($role as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->guard_name }}</td>
                <td>{{ $row->created_at }}</td>
                <td>
                    <form action="{{ route('role.destroy', $row->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="float-right">
    {!! $role->links() !!}
</div>
