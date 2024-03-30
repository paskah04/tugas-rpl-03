<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Berita;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        #halaman awal
        $menu = $this->getMenu();
        $berita = Berita::with('kategori')->latest()->get()->take(6);
        $mostViews = Berita::with('kategori')->orderByDesc('total_views')->get()->take(3);
        return view('frontend.content.home', compact('menu','berita','mostViews'));
    }

    public function detailBerita($id)
    {

    }

    public function detailPage($id)
    {

    }

    public function semuaBerita()
    {

    }

    private function getMenu()
    {
        $menu = Menu::whereNull('parent_menu')
            ->with(['submenu' => fn($q) => $q->where('status_menu', '=', 1)->orderBy('urutan_menu', 'asc')])
            ->where('status_menu', '=', 1)
            ->orderBy('urutan_menu', 'asc')
            ->get();

        $dataMenu = [];
        foreach ($menu as $m) {
            $jenis_menu = $m->jenis_menu;
            $urlMenu = "";

            if ($jenis_menu == "url") {
                $urlMenu = $m->url_menu;
            } else {
                $urlMenu = route('home.detailPage', $m->url_menu);
            }

            #item menu
            $dItemMenu = [];
            foreach ($m->submenu as $im) {
                $jensItemMenu = $im->jenis_menu;
                $urlItemMenu = "";

                if ($jensItemMenu == "url") {
                    $urlItemMenu = $im->url_menu;
                } else {
                    $urlItemMenu = route('home.detailPage', $im->url_menu);
                }

                $dItemMenu[] = [
                    'sub_menu_nama' => $im->nama_menu,
                    'sub_menu_target' => $im->target_menu,
                    'sub_menu_url' => $urlItemMenu,
                ];
            }


            $dataMenu[] = [
                'menu' => $m->nama_menu,
                'target' => $m->target_menu,
                'url' => $urlMenu,
                'itemMenu' => $dItemMenu
            ];
        }

        return $dataMenu;
    }


}
