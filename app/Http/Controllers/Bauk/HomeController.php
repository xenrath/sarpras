<?php

namespace App\Http\Controllers\Bauk;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index()
    {
        $kendaraan = Peminjaman::where([
            ['kategori', 'kendaraan'],
            ['status', 'menunggu']
        ])->count();
        $ruang = Peminjaman::where([
            ['kategori', 'ruang'],
            ['status', 'menunggu']
        ])->count();
        $gedung = Peminjaman::where([
            ['kategori', 'gedung'],
            ['status', 'menunggu']
        ])->count();
        $barang = Peminjaman::where([
            ['kategori', 'barang'],
            ['status', 'menunggu']
        ])->count();

        return view('bauk.index', compact(
            'kendaraan',
            'ruang',
            'gedung',
            'barang'
        ));
    }

    public function hubungi($telp)
    {
        $agent = new Agent;
        $desktop = $agent->isDesktop();

        if ($desktop) {
            return redirect()->away('https://web.whatsapp.com/send?phone=+62' . $telp);
        } else {
            return redirect()->away('https://wa.me/+62' . $telp);
        }
    }
}
