<?php

namespace App\Http\Controllers\Bauk\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where([
            ['kategori', 'kendaraan'],
            ['status', 'konfirmasi']
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
            )
            ->with('kendaraan:id,nama,kapasitas')
            ->with('sopir:id,nama,telp')
            ->orderBy('tanggal_awal')
            ->orderBy('jam_awal')
            ->get();

        return view('bauk.peminjaman.kendaraan.index', compact('peminjamans'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();

        if ($peminjaman->status != 'konfirmasi') {
            alert()->error('Error', 'Gagal mengonfirmasi Peminjaman!');
            return back();
        }

        $update = Peminjaman::where('id', $id)->update([
            'status' => 'selesai'
        ]);

        if (!$update) {
            alert()->error('Error', 'Gagal mengonfirmasi Peminjaman!');
            return back();
        }

        $telp = User::where('role', 'bauk')->value('telp');

        if ($telp) {
            $message = "Peminjaman SARPRAS"  . PHP_EOL;
            $message .= "----------------------------------"  . PHP_EOL;
            $message .= "Peminjaman Kendaraan Anda telah disetujui" . PHP_EOL;
            $message .= "Cetak dan informasikan bukti peminjaman ke Satpam terkait" . PHP_EOL;
            $message .= "----------------------------------"  . PHP_EOL;
            $message .= "Bukti peminjaman Anda disini" . PHP_EOL;
            $message .= url('peminjaman/bukti/' . $peminjaman->kode);

            // $this->kirim($sarpras->telp, $message);
            $this->kirim('085328481969', $message);
        }

        alert()->success('Success', 'Berhasil mengonfirmasi Peminjaman');
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
