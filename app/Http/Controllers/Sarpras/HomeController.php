<?php

namespace App\Http\Controllers\Sarpras;

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
            ['status', 'proses'],
        ])->count();
        $ruang = 0;
        $gedung = 0;
        $barang = 0;

        return view('sarpras.index', compact('kendaraan', 'ruang', 'gedung', 'barang'));
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
