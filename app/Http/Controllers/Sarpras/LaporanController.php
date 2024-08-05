<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where('status', 'selesai')->get();

        return view('sarpras.laporan.index', compact('peminjamans'));
    }

    public function bukti($id)
    {
        $status = Peminjaman::where('id', $id)->value('status');

        if ($status != 'selesai') {
            alert()->error('Error!', 'Peminjaman belum dikonfirmasi!');
            return back();
        }

        $peminjaman = Peminjaman::where('id', $id)
            ->select(
                'nama',
                'tanggal_awal',
                'jam_awal',
                'jam_akhir',
                'keperluan',
                'kegiatan',
                'keterangan',
                'kendaraan_id',
                'sopir_id',
            )
            ->with('kendaraan:id,nama')
            ->with('sopir:id,nama')
            ->first();
        $bauk = User::where('role', 'bauk')->first();
        $sarpras = User::where('role', 'sarpras')->first();

        $pdf = Pdf::loadview('sarpras.laporan.bukti', compact('peminjaman', 'bauk', 'sarpras'));
        return $pdf->stream('Bukti Peminjaman (' . $peminjaman->kode . ')');
    }
}
