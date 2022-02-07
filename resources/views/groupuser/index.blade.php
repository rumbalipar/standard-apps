@extends('layout.index')

@section('title')
    Group User
@endsection

@section('judul')
    Group User
@endsection

@section('filter')
    <form action="">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" name="kode" class="form-control form-control-sm" value="{{ isset($_GET['kode']) ? $_GET['kode'] : '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control form-control-sm" value="{{ isset($_GET['deskripsi']) ? $_GET['deskripsi'] : '' }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-info">Search</button>
    </form>
@endsection

@section('content')
    @if(\App\Models\User::find(session()->get('sesiuserid'))->GroupUser->Module()->where('route',Route::currentRouteName())->first()->pivot->buat == 'Y')
    <p>
        <a href="{{ route('groupuser.create') }}" class="btn btn-sm btn-primary input" title="Create Group User">Create</a>
    </p>
    @endif
    <div class="table-responsive">
        <table class="table table-hover table-stripped">
            <thead>
                <tr>
                    <th class="bg-info text-white text-center forn-weight-bold">Kode</th>
                    <th class="bg-info text-white text-center forn-weight-bold">Deskripsi</th>
                    @if(\App\Models\User::find(session()->get('sesiuserid'))->GroupUser->Module()->where('route',Route::currentRouteName())->first()->pivot->ubah == 'Y')
                    <th class="bg-info text-white text-center forn-weight-bold">Ubah</th>
                    @endif
                    @if(\App\Models\User::find(session()->get('sesiuserid'))->GroupUser->Module()->where('route',Route::currentRouteName())->first()->pivot->hapus == 'Y')
                    <th class="bg-info text-white text-center forn-weight-bold">Hapus</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $datas)
                    <tr>
                        <td class="text-center">{{ $datas['kode'] }}</td>
                        <td>{{ $datas['deskripsi'] }}</td>
                        @if(\App\Models\User::find(session()->get('sesiuserid'))->GroupUser->Module()->where('route',Route::currentRouteName())->first()->pivot->ubah == 'Y')
                        <td class="text-center">
                            <a href="{{ route('groupuser.edit',['id' => $datas['id']]) }}" class="btn btn-sm btn-primary input" title="Edit Group User">Ubah</a>
                        </td>
                        @endif
                        @if(\App\Models\User::find(session()->get('sesiuserid'))->GroupUser->Module()->where('route',Route::currentRouteName())->first()->pivot->hapus == 'Y')
                        <td class="text-center">
                            <a href="{{ route('groupuser.delete',['id' => $datas['id']]) }}" class="btn btn-sm btn-danger input" title="Delete Group User">Hapus</a>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pull-left">
        {{ $data->links() }}
    </div>
    <div class="pull-right">
        Showing 
        {{ $data->firstItem() }}
        to 
        {{ $data->lastItem() }}
        of
        {{ $data->total() }}
    </div>
@endsection