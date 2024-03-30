@extends('backend.layout.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"> Form Ubah Menu </h1>

        <div class="card-body">
            <form action="{{route('menu.prosesUbah')}}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" name="name_menu" placeholder="name_menu" value="{{$menu->nama_menu}}"
                           class="form-control @error('name_menu') is-invalid @enderror">
                    @error('name_menu')
                    <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Menu</label>
                    <div class="radio">
                        <input type="radio" value="page" name="jenis_menu" id="page">
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
                    <input type="url" name="link_url" id="link_url" class="form-control" placeholder="URL">
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
                        <input type="radio" value="_self" name="target_menu" id="self">
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

                <div class="mb-3">
                    <label class="form-label">Status Menu</label>

                    @php
                        $aktif = "";
                        $tidakAktif = "";
                        if ($menu->status_menu == 1){
                            $aktif = "selected";
                        }else{
                            $tidakAktif = "selected";
                        }
                    @endphp

                    <select name="status_menu" class="form-control" id="status_menu">
                        <option value="1" {{ $menu->status_menu == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $menu->status_menu == 0 ? 'selected' : '' }}>Tidak Aktif</option>


                    </select>
                </div>

                <input type="hidden" name="id_menu" value="{{$menu->id_menu}}">
                <input type="hidden" id="jenis_menu_old" value="{{$menu->jenis_menu}}">
                <input type="hidden" id="url_menu_old" value="{{$menu->url_menu}}">
                <input type="hidden" id="target_menu_old" value="{{$menu->target_menu}}">
                <input type="hidden" id="parent_menu_old" value="{{$menu->parent_menu}}">

                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{route('menu.index')}}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <script>
        $(function () {
            $("#parent_menu").val($("#parent_menu_old").val());

            var target_menu_old = $("#target_menu_old").val();
            if (target_menu_old == "_self") {
                $("#self").prop("checked", true)
            } else {
                $("#blank").prop("checked", true)
            }

            var jenis_menu_old = $("#jenis_menu_old").val();
            if (jenis_menu_old == "page") {
                $("#page").prop("checked", true);

                $("#link_page").val($("#url_menu_old").val());
                $("#url_tampil").css('display', 'none');
                $("#page_tampil").css('display', 'block');
            }else{
                $("#url").prop("checked", true);

                $("#link_url").val($("#url_menu_old").val());
                $("#url_tampil").css('display', 'block');
                $("#page_tampil").css('display', 'none');

            }

            $("#page").click(function () {
                $("#url_tampil").css('display', 'none');
                $("#page_tampil").css('display', 'block');
            });

            $("#url").click(function () {
                $("#url_tampil").css('display', 'block');
                $("#page_tampil").css('display', 'none');
            });

        });
    </script>
@endsection


