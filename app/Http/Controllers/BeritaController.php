<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\Kategori;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')->get();
        return view('backend.content.berita.list', compact('berita'));
    }

    public function tambah()
    {
        $kategori = Kategori::all();
        return view('backend.content.berita.formTambah', compact('kategori'));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'judul_berita' => 'required',
            'isi_berita' => 'required',
            'id_kategori' => 'required',
            'gambar_berita' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambar_berita = $request->file('gambar_berita')->store('public');

        $berita = new Berita();
        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->id_kategori = $request->id_kategori;
        $berita->gambar_berita = $gambar_berita;

        try {
            $berita->save();
            return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil Tambah Berita']);
        } catch (\Exception $e) {
            return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal Tambah Berita']);
        }
    }

    public function ubah($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('backend.content.berita.formUbah', compact('berita', 'kategori'));
    }

    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'judul_berita' => 'required',
            'isi_berita' => 'required',
            'id_kategori' => 'required',
        ]);

        $berita = Berita::findOrFail($request->id_berita);

        if ($request->hasFile('gambar_berita')) {
            $this->validate($request, [
                'gambar_berita' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $gambar_berita = $request->file('gambar_berita')->store('public');
            $berita->gambar_berita = $gambar_berita;
        }

        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->id_kategori = $request->id_kategori;

        try {
            $berita->save();
            return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil Ubah Berita']);
        } catch (\Exception $e) {
            return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal Ubah Berita']);
        }
    }

    public function hapus($id)
    {
        $berita = Berita::findOrFail($id);

        try {
            $berita->delete();
            return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil Hapus Berita']);
        } catch (\Exception $e) {
            return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal Hapus Berita']);
        }
    }
}
