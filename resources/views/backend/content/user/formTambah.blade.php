@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah User</h1>

        <div class="card-body">
            <form action="{{ route('user.prosesTambah') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama User</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="...">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email User</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span class="...">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a> {
            </form>
        </div>
    </div>
@endsection
