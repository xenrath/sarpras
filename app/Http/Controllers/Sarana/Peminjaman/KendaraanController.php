<?php

namespace App\Http\Controllers\Sarana\Peminjaman;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Sopir;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::where([
            ['kategori', 'kendaraan'],
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

        return view('sarana.peminjaman.kendaraan.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();

        if ($peminjaman->status != 'menunggu') {
            return view('error.500');
        }

        $cek = $this->cek_peminjaman(
            $peminjaman->id,
            $peminjaman->tanggal_awal,
            $peminjaman->tanggal_akhir,
            $peminjaman->jam_awal,
            $peminjaman->jam_akhir
        );

        $kendaraans = Kendaraan::where('kapasitas', '>=', $peminjaman->jumlah)
            ->whereNotIn('id', $cek->pluck('kendaraan_id'))
            ->select(
                'id',
                'nama',
                'kapasitas'
            )
            ->get()
            ->sortBy('kapasitas');
        $sopirs = Sopir::whereNotIn('id', $cek->pluck('sopir_id'))
            ->select('id', 'nama')
            ->orderBy('nama')
            ->get();

        return view('sarana.peminjaman.kendaraan.show', compact('peminjaman', 'kendaraans', 'sopirs'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_awal' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
        ], [
            'tanggal_awal.required' => 'Tanggal Pinjam harus diisi!',
            'jam_awal.required' => 'Jam Mulai harus diisi!',
            'jam_akhir.required' => 'Jam Akhir harus diisi!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengubah Waktu Peminjaman!');
            return back()->withInput();
        }

        $peminjaman = Peminjaman::where('id', $id)->update([
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_awal,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'kendaraan_id' => null,
            'sopir_id' => null
        ]);

        if ($peminjaman) {
            alert()->success('Success', 'Berhasil mengubah Waktu Peminjaman');
        } else {
            alert()->error('Error', 'Gagal mengubah Waktu Peminjaman!');
        }

        return back();
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::where('id', $id)->update([
            'status' => 'batal',
        ]);

        if (!$peminjaman) {
            alert()->error('Error', 'Gagal membatalkan Peminjaman!');
            return back();
        }

        alert()->success('Success', 'Berhasil membatalkan Peminjaman!');

        return back();
    }

    public function konfirmasi(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'kendaraan_id' => 'required',
        ], [
            'kendaraan_id.required' => 'Kendaraan harus dipilih!',
        ]);

        $error_sopir = array();
        $validator_fails_sopir = false;
        if ($peminjaman->is_sopir) {
            $validator_sopir = Validator::make($request->all(), [
                'sopir_id' => 'required',
            ], [
                'sopir_id.required' => 'Sopir harus dipilih!',
            ]);

            if ($validator_sopir->fails()) {
                $error_sopir = $validator_sopir->errors();
                $validator_fails_sopir = $validator_sopir->fails();
            }
        }

        if ($validator->fails() || $validator_fails_sopir) {
            alert()->error('Error', 'Gagal mengkonfirmasi Peminjaman!');
            return back()->withInput()->withErrors($validator->errors()->merge($error_sopir));
        }

        $update = Peminjaman::where('id', $id)->update([
            'kendaraan_id' => $request->kendaraan_id,
            'sopir_id' => $request->sopir_id,
            'status' => 'proses'
        ]);

        if (!$update) {
            alert()->error('Error', 'Gagal mengkonfirmasi Peminjaman!');
            return back();
        }

        $telp = User::where('role', 'sarpras')->value('telp');

        if ($telp) {
            $message = "Peminjaman SARPRAS"  . PHP_EOL;
            $message .= "----------------------------------"  . PHP_EOL;
            $message .= "Kategori : " . ucfirst($peminjaman->kategori) . PHP_EOL;
            $message .= "Nama Peminjam : " . $peminjaman->nama . PHP_EOL;
            $message .= "Hari, Tanggal : " . Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') . PHP_EOL;
            $message .= "Jam : " . $peminjaman->jam_awal . "-" . $peminjaman->jam_akhir  . PHP_EOL;
            $message .= "----------------------------------"  . PHP_EOL;
            $message .= "Konfirmasi Peminjaman disini" . PHP_EOL;
            $message .= url('sarpras/peminjaman-kendaraan');

            // $this->kirim($sarpras->telp, $message);
            $this->kirim('085328481969', $message);
        }


        alert()->success('Success', 'Berhasil mengkonfirmasi Peminjaman');
        return redirect('sarana/peminjaman-kendaraan');
    }

    public function cek_peminjaman($id, $tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir)
    {
        $peminjaman = Peminjaman::where(function ($query) use ($id, $tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
            $query->where('id', '!=', $id);
            $query->where('status', '!=', 'menunggu');
            $query->where('status', '!=', 'proses');
            $query->whereBetween('tanggal_awal', array($tanggal_awal, $tanggal_akhir));
            $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                $query->whereBetween('jam_awal', array($jam_awal, Carbon::parse($jam_akhir)->subMinute()->format('H:i')));
            });
        })
            ->orWhere(function ($query) use ($id, $tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('id', '!=', $id);
                $query->where('status', '!=', 'menunggu');
                $query->where('status', '!=', 'proses');
                $query->whereBetween('tanggal_awal', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->whereBetween('jam_akhir', array(Carbon::parse($jam_awal)->addMinute()->format('H:i'), $jam_akhir));
                });
            })
            ->orWhere(function ($query) use ($id, $tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('id', '!=', $id);
                $query->where('status', '!=', 'menunggu');
                $query->where('status', '!=', 'proses');
                $query->whereBetween('tanggal_awal', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->where('jam_awal', '<', $jam_awal);
                    $query->where('jam_akhir', '>', $jam_akhir);
                });
            })
            ->orWhere(function ($query) use ($id, $tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('id', '!=', $id);
                $query->where('status', '!=', 'menunggu');
                $query->where('status', '!=', 'proses');
                $query->whereBetween('tanggal_akhir', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->whereBetween('jam_awal', array($jam_awal, Carbon::parse($jam_akhir)->subMinute()->format('H:i')));
                });
            })
            ->orWhere(function ($query) use ($id, $tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('id', '!=', $id);
                $query->where('status', '!=', 'menunggu');
                $query->where('status', '!=', 'proses');
                $query->whereBetween('tanggal_akhir', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->whereBetween('jam_akhir', array(Carbon::parse($jam_awal)->addMinute()->format('H:i'), $jam_akhir));
                });
            })
            ->orWhere(function ($query) use ($id, $tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('id', '!=', $id);
                $query->where('status', '!=', 'menunggu');
                $query->where('status', '!=', 'proses');
                $query->whereBetween('tanggal_akhir', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->where('jam_awal', '<', $jam_awal);
                    $query->where('jam_akhir', '>', $jam_akhir);
                });
            })
            ->select(
                'kendaraan_id',
                'sopir_id',
            )
            ->orderBy('tanggal_awal')
            ->orderBy('jam_awal')
            ->get();

        return $peminjaman;
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
