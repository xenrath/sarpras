<?php

namespace App\Http\Controllers\Sarpras\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where([
            ['kategori', 'kendaraan'],
            ['status', '!=', 'menunggu'],
            ['status', '!=', 'selesai']
        ])
            ->select(
                'id',
                'nama',
                'keperluan',
                'tanggal_awal',
                'jam_awal',
                'jam_akhir',
                'kegiatan',
                'keterangan',
                'lampiran',
                'jumlah',
                'kendaraan_id',
                'is_sopir',
                'sopir_id',
                'status'
            )
            ->with('kendaraan:id,nama,kapasitas')
            ->with('sopir:id,nama,telp')
            ->orderBy('status')
            ->orderBy('tanggal_awal')
            ->orderBy('jam_awal')
            ->get();

        return view('sarpras.peminjaman.kendaraan.index', compact('peminjamans'));
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();
        if ($peminjaman->status == 'menunggu') {
            Storage::disk('local')->delete('public/uploads/' . $peminjaman->lampiran);
            $peminjaman->delete();
            alert()->success('Success', 'Berhasil menghapus Peminjaman');
        } else {
            alert()->success('Error', 'Gagal menghapus Peminjaman');
        }

        return back();
    }

    public function konfirmasi($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();

        if ($peminjaman->status != 'proses') {
            alert()->error('Error', 'Gagal mengonfirmasi Peminjaman!');
            return back();
        }

        $konfirmasi = Peminjaman::where('id', $id)->update([
            'status' => 'konfirmasi'
        ]);

        if (!$konfirmasi) {
            alert()->error('Error', 'Gagal mengonfirmasi Peminjaman!');
            return back();
        }

        $telp = User::where('role', 'bauk')->value('telp');

        if ($telp) {
            $message = "Peminjaman SARPRAS"  . PHP_EOL;
            $message .= "----------------------------------"  . PHP_EOL;
            $message .= "Kategori : " . ucfirst($peminjaman->kategori) . PHP_EOL;
            $message .= "Nama Peminjam : " . $peminjaman->nama . PHP_EOL;
            $message .= "Hari, Tanggal : " . Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') . PHP_EOL;
            $message .= "Jam : " . $peminjaman->jam_awal . "-" . $peminjaman->jam_akhir  . PHP_EOL;
            $message .= "----------------------------------"  . PHP_EOL;
            $message .= "Konfirmasi Peminjaman disini" . PHP_EOL;
            $message .= url('bauk/peminjaman-kendaraan');

            // $this->kirim($sarpras->telp, $message);
            $this->kirim('085328481969', $message);
        }

        alert()->success('Success', 'Berhasil mengonfirmasi Peminjaman');
        return back();
    }

    public function kembalikan($id)
    {
        $status = Peminjaman::where('id', $id)->value('status');

        if ($status != 'proses') {
            alert()->error('Error', 'Gagal mengembalikan Peminjaman!');
            return back();
        }

        $peminjaman = Peminjaman::where('id', $id)->update([
            'kendaraan_id' => null,
            'sopir_id' => null,
            'status' => 'menunggu',
        ]);

        if ($peminjaman) {
            alert()->success('Success', 'Berhasil mengembalikan Peminjaman');
        } else {
            alert()->error('Error', 'Gagal mengembalikan Peminjaman!');
        }

        return back();
    }

    public function kirim($telp, $message)
    {
        $data = [
            'target' => $telp,
            'message' => $message
        ];

        $curl = curl_init();
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: BUbqFXgpVtdH3EoMj@u7",
            )
        );

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return $result;
    }
}
