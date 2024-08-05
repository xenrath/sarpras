<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Sopir;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    public function list(Request $request)
    {
        $tanggal = $request->tanggal ?? Carbon::now()->format('Y-m-d');

        $kendaraans = Peminjaman::where('kategori', 'kendaraan')
            ->where('status', 'selesai')
            ->where('tanggal_awal', '<=', $tanggal)
            ->where('tanggal_akhir', '>=', $tanggal)
            ->get();
        $ruangs = Peminjaman::where('kategori', 'ruang')
            ->where('status', 'selesai')
            ->where('tanggal_awal', '<=', $tanggal)
            ->where('tanggal_akhir', '>=', $tanggal)
            ->get();
        $gedungs = Peminjaman::where('kategori', 'gedung')
            ->where('status', 'selesai')
            ->where('tanggal_awal', '<=', $tanggal)
            ->where('tanggal_akhir', '>=', $tanggal)
            ->get();
        $barangs = Peminjaman::where('kategori', 'barang')
            ->where('status', 'selesai')
            ->where('tanggal_awal', '<=', $tanggal)
            ->where('tanggal_akhir', '>=', $tanggal)
            ->get();

        return view('peminjaman.index', compact(
            'kendaraans',
            'ruangs',
            'gedungs',
            'barangs',
        ));
    }

    public function index()
    {
        return view('peminjaman.create');
    }

    public function create()
    {
        abort('404');
    }

    public function store(Request $request)
    {
        if ($request->kategori == 'kendaraan') {
            return redirect('peminjaman/kendaraan');
        } elseif ($request->kategori == 'ruang') {
            return redirect('peminjaman/ruang');
        } elseif ($request->kategori == 'gedung') {
            return redirect('peminjaman/gedung');
        } elseif ($request->kategori == 'barang') {
            return redirect('peminjaman/barang');
        } else {
            alert()->error('Error!', 'Pilih Kategori dengan benar!');
            return back();
        }
    }

    public function kendaraan()
    {
        $sopirs = Sopir::select('id', 'nama')->get();

        return view('peminjaman.create_kendaraan', compact('sopirs'));
    }

    public function store_kendaraan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'keperluan' => 'required',
        ], [
            'nama.required' => 'Nama Peminjam harus diisi!',
            'keperluan.required' => 'Keperluan harus dipilih!',
        ]);

        $error_keperluan = array();
        $validator_fails_keperluan = false;
        if ($request->keperluan == 'tugas') {
            $validator_keperluan = Validator::make($request->all(), [
                'lampiran' => 'required',
            ], [
                'lampiran.required' => 'Lampiran harus ditambahkan!',
            ]);

            if ($validator_keperluan->fails()) {
                $error_keperluan = $validator_keperluan->errors();
                $validator_fails_keperluan = $validator_keperluan->fails();
            }
        }

        $error_lanjutan = array();
        $validator_fails_lanjutan = false;
        $validator_lanjutan = Validator::make($request->all(), [
            'kegiatan' => 'required',
            'tanggal_awal' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
            'is_sopir' => 'required',
            'telp' => 'required',
        ], [
            'kegiatan.required' => 'Uraian Kegiatan harus diisi!',
            'tanggal_awal.required' => 'Tanggal Pinjam harus diisi!',
            'jam_awal.required' => 'Jam Mulai harus diisi!',
            'jam_akhir.required' => 'Jam Akhir harus diisi!',
            'keterangan.required' => 'Tempat / Tujuan harus diisi!',
            'jumlah.required' => 'Jumlah Penumpang harus diisi!',
            'is_sopir.required' => 'Perlu Sopir harus dipilih!',
            'telp.required' => 'Nomor Telepon harus diisi!',
        ]);

        if ($validator_lanjutan->fails()) {
            $error_lanjutan = $validator_lanjutan->errors();
            $validator_fails_lanjutan = $validator_lanjutan->fails();
        }

        if ($validator->fails() || $validator_fails_keperluan || $validator_fails_lanjutan) {
            alert()->error('Error', 'Gagal membuat Peminjaman!');
            return back()->withInput()->withErrors(
                $validator->errors()->merge($error_keperluan)->merge($error_lanjutan)
            );
        }

        $kode = strtoupper(Str::random(6));

        if ($request->lampiran) {
            Storage::disk('local')->delete('public/uploads/' . $request->lampiran);
            $lampiran = 'lampiran/' . $kode . '.' . $request->lampiran->getClientOriginalExtension();
            $request->lampiran->storeAs('public/uploads/', $lampiran);
        } else {
            $lampiran = null;
        }

        $peminjaman = Peminjaman::create([
            'kode' => $kode,
            'kategori' => 'kendaraan',
            'nama' => $request->nama,
            'keperluan' => $request->keperluan,
            'lampiran' => $lampiran,
            'kegiatan' => $request->kegiatan,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_awal,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'jumlah' => $request->jumlah,
            'is_sopir' => $request->is_sopir,
            'keterangan' => $request->keterangan,
            'telp' => $request->telp,
            'status' => 'menunggu'
        ]);

        $message_peminjam = "Peminjaman SARPRAS"  . PHP_EOL;
        $message_peminjam .= "----------------------------------"  . PHP_EOL;
        $message_peminjam .= "Kategori : " . ucfirst($peminjaman->kategori) . PHP_EOL;
        $message_peminjam .= "Nama Peminjam : " . $peminjaman->nama . PHP_EOL;
        $message_peminjam .= "Hari, Tanggal : " . Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') . PHP_EOL;
        $message_peminjam .= "Jam : " . $peminjaman->jam_awal . "-" . $peminjaman->jam_akhir  . PHP_EOL;
        $message_peminjam .= "----------------------------------"  . PHP_EOL;
        $message_peminjam .= "Cek status Peminjaman disini" . PHP_EOL;
        $message_peminjam .= url('peminjaman/' . $peminjaman->kode);

        if ($this->kirim($peminjaman->telp, $message_peminjam)['status']) {
            $sarana = User::where('role', 'sarana')->first();

            $message_sarana = "Peminjaman SARPRAS"  . PHP_EOL;
            $message_sarana .= "----------------------------------"  . PHP_EOL;
            $message_sarana .= "Kategori : " . ucfirst($peminjaman->kategori) . PHP_EOL;
            $message_sarana .= "Nama Peminjam : " . $peminjaman->nama . PHP_EOL;
            $message_sarana .= "Hari, Tanggal : " . Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F') . PHP_EOL;
            $message_sarana .= "Jam : " . $peminjaman->jam_awal . "-" . $peminjaman->jam_akhir  . PHP_EOL;
            $message_sarana .= "----------------------------------"  . PHP_EOL;
            $message_sarana .= "Lihat daftar Peminjaman disini" . PHP_EOL;
            $message_sarana .= url('sarana/peminjaman-kendaraan');

            // $this->kirim($sarana->telp, $message_sarana);
            $this->kirim('085328481969', $message_sarana);
        };

        alert()->success('Success', 'Berhasil membuat Peminjaman');

        return redirect('peminjaman/list')->with('kendaraan', true);
    }

    public function ruang()
    {
        alert()->warning('Warning', 'Peminjaman masih dalam tahap pembuatan');
        return back()->withInput();
        // return view('peminjaman.create_ruang');
    }

    public function store_ruang(Request $request)
    {
    }

    public function gedung()
    {
        alert()->warning('Warning', 'Peminjaman masih dalam tahap pembuatan');
        return back()->withInput();
        // return view('peminjaman.create_gedung');
    }

    public function store_gedung(Request $request)
    {
    }

    public function barang()
    {
        alert()->warning('Warning', 'Peminjaman masih dalam tahap pembuatan');
        return back()->withInput();
        // return view('peminjaman.create_barang');
    }

    public function store_barang(Request $request)
    {
    }

    public function show($kode)
    {
        $peminjaman = Peminjaman::where('kode', $kode)
            ->with('kendaraan:id,nama')
            ->with('sopir:id,nama,telp')
            ->first();

        if ($peminjaman->kategori == 'kendaraan') {
            return view('peminjaman.show_kendaraan', compact('peminjaman'));
        } elseif ($peminjaman->kategori == 'ruang') {
            abort('404');
        } elseif ($peminjaman->kategori == 'gedung') {
            abort('404');
        } elseif ($peminjaman->kategori == 'barang') {
            abort('404');
        }
    }

    public function bukti($kode)
    {
        $status = Peminjaman::where('kode', $kode)->value('status');

        if ($status != 'selesai') {
            alert()->error('Error!', 'Peminjaman belum dikonfirmasi!');
            return redirect('peminjaman/' . $kode);
        }

        $peminjaman = Peminjaman::where('kode', $kode)
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

        $pdf = Pdf::loadview('peminjaman.bukti_kendaraan', compact('peminjaman', 'bauk', 'sarpras'));
        return $pdf->stream('Bukti Peminjaman (' . $peminjaman->kode . ')');
    }

    public function cek_peminjaman($tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir)
    {
        $peminjaman = Peminjaman::where(function ($query) use ($tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
            $query->where('status', 'konfirmasi');
            $query->whereBetween('tanggal_awal', array($tanggal_awal, $tanggal_akhir));
            $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                $query->whereBetween('jam_awal', array($jam_awal, Carbon::parse($jam_akhir)->subMinute()->format('H:i')));
            });
        })
            ->orWhere(function ($query) use ($tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('status', 'konfirmasi');
                $query->whereBetween('tanggal_awal', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->whereBetween('jam_akhir', array(Carbon::parse($jam_awal)->addMinute()->format('H:i'), $jam_akhir));
                });
            })
            ->orWhere(function ($query) use ($tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('status', 'konfirmasi');
                $query->whereBetween('tanggal_awal', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->where('jam_awal', '<', $jam_awal);
                    $query->where('jam_akhir', '>', $jam_akhir);
                });
            })
            ->orWhere(function ($query) use ($tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('status', 'konfirmasi');
                $query->whereBetween('tanggal_akhir', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->whereBetween('jam_awal', array($jam_awal, Carbon::parse($jam_akhir)->subMinute()->format('H:i')));
                });
            })
            ->orWhere(function ($query) use ($tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('status', 'konfirmasi');
                $query->whereBetween('tanggal_akhir', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->whereBetween('jam_akhir', array(Carbon::parse($jam_awal)->addMinute()->format('H:i'), $jam_akhir));
                });
            })
            ->orWhere(function ($query) use ($tanggal_awal, $tanggal_akhir, $jam_awal, $jam_akhir) {
                $query->where('status', 'konfirmasi');
                $query->whereBetween('tanggal_akhir', array($tanggal_awal, $tanggal_akhir));
                $query->where(function ($query) use ($jam_awal, $jam_akhir) {
                    $query->where('jam_awal', '<', $jam_awal);
                    $query->where('jam_akhir', '>', $jam_akhir);
                });
            })
            ->select(
                'keperluan',
                'nama',
                'tanggal_awal',
                'tanggal_akhir',
                'jam_awal',
                'jam_akhir',
                'keterangan',
                'pj'
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
