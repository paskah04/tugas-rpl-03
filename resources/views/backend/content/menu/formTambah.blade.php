@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Menu</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('menu.prosesTambah') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="name_menu" placeholder="name_menu" value="{{ old('name_menu') }}"
                               class="form-control @error('name_menu') is-invalid @enderror">
                        @error('name_menu')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Menu</label>
                        <div class="radio">
                            <input type="radio" checked value="page" name="jenis_menu" id="page">
                            <label for="page">Page</label>
                            <input type="radio" value="url" name="jenis_menu" id="url">
                            <label for="url">URL</label>
                        </div>
                        @error('jenis_menu')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <label class="form-label">URL</label>
                    <div id="url_tampil">
                        <input type="url" name="link_url" class="form-control" value="{{ old('link_url') }}" placeholder="URL">
                    </div>

                    <div class="mb-3" id="page_tampil">
                        <label class="form-label">Halaman</label>
                        <select name="link_page" class="form-control">
                            <option value="" selected disabled>Pilih Halaman</option>
                            @foreach ($page as $row)
                                <option value="{{ $row->id_page }}">{{ $row->judul_page }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Target Menu</label>
                        <div class="radio">
                            <input type="radio" checked value="_self" name="target_menu" id="self">
                            <label for="self">Tab Saat Ini</label>
                            <input type="radio" value="_blank" name="target_menu" id="blank">
                            <label for="blank">Tab Baru</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent Menu</label>
                        <select name="parent_menu" class="form-control" id="parent_menu">
                            <option selected value="" disabled>Pilih Parent</option>
                            @foreach ($parent as $row)
                                <option value="{{ $row->id_menu }}">{{ $row->name_menu }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {
            $("#url").click(function () {
                $("#url_tampil").css('display', 'block');
                $("#page_tampil").css('display', 'none');
            });

            $("#page").click(function () {
                $("#url_tampil").css('display', 'none');
                $("#page_tampil").css('display', 'block');
            });
        });
    </script>
@endsection
