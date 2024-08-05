<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\Sopir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::select(
            'id',
            'nama',
            'kategori',
            'tanggal_awal',
            'tanggal_akhir',
            'jam_awal',
            'jam_akhir',
            'telp',
        )
            ->paginate(5);

        return view('dev.peminjaman.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $kategori = Peminjaman::where('id', $id)->value('kategori');

        if ($kategori == 'kendaraan') {
            $peminjaman = Peminjaman::where('id', $id)->first();
            $kendaraans = Kendaraan::select('id', 'nama', 'kapasitas')->get();
            $sopirs = Sopir::select('id', 'nama')->get();
            return view('dev.peminjaman.show_kendaraan', compact('peminjaman', 'kendaraans', 'sopirs'));
        } elseif ($kategori == 'ruang') {
        } elseif ($kategori == 'gedung') {
        } elseif ($kategori == 'barang') {
        }
    }

    public function update(Request $request, $id)
    {
        $kategori = Peminjaman::where('id', $id)->value('kategori');

        if ($kategori == 'kendaraan') {
            $error = array();
            if ($request->status == 'menunggu') {
                $validator = Validator::make($request->all(), [
                    'tanggal_awal' => 'required',
                    'jam_awal' => 'required',
                    'jam_akhir' => 'required',
                    'is_sopir' => 'required',
                ], [
                    'tanggal_awal.required' => 'Tanggal Pinjam harus diisi!',
                    'jam_awal.required' => 'Jam Mulai harus diisi!',
                    'jam_akhir.required' => 'Jam Akhir harus diisi!',
                    'is_sopir.required' => 'Perlu Sopir harus dipilih!',
                ]);

                if ($validator->fails()) {
                    $error_validation = $validator->errors()->all();
                    foreach ($error_validation as $value) {
                        array_push($error, $value);
                    }
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'tanggal_awal' => 'required',
                    'jam_awal' => 'required',
                    'jam_akhir' => 'required',
                    'is_sopir' => 'required',
                    'kendaraan_id' => 'required',
                ], [
                    'tanggal_awal.required' => 'Tanggal Pinjam harus diisi!',
                    'jam_awal.required' => 'Jam Mulai harus diisi!',
                    'jam_akhir.required' => 'Jam Akhir harus diisi!',
                    'is_sopir.required' => 'Perlu Sopir harus dipilih!',
                    'kendaraan_id.required' => 'Kendaraan harus dipilih!',
                ]);

                if ($validator->fails()) {
                    $error_validation = $validator->errors()->all();
                    array_push($error, $error_validation);
                }

                if ($request->is_sopir) {
                    $validator = Validator::make($request->all(), [
                        'sopir_id' => 'required',
                    ], [
                        'sopir_id.required' => 'Sopir harus dipilih!',
                    ]);

                    if ($validator->fails()) {
                        $error_validation = $validator->errors()->all()[0];
                        array_push($error, $error_validation);
                    }
                }
            }

            if ($error) {
                return $error;
                return back()->with('error', $error);
            }

            Peminjaman::where()->update([
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_awal,
                'jam_awal' => $request->jam_awal,
                'jam_akhir' => $request->jam_akhir,
                'is_sopir' => $request->is_sopir,
                'kendaraan_id' => $request->kendaraan_id,
                'sopir_id' => $request->sopir_id,
            ]);

            alert()->success('Success', 'Berhasil menambahkan Sopir');
            
            return back();
        } elseif ($kategori == 'ruang') {
        } elseif ($kategori == 'gedung') {
        } elseif ($kategori == 'barang') {
        }
    }
}
