<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function cek_login()
    {
        if (auth()->check()) {
            if (auth()->user()->isDev()) {
                return redirect('dev');
            }
            if (auth()->user()->isSarpras()) {
                return redirect('sarpras');
            }
            if (auth()->user()->isBauk()) {
                return redirect('bauk');
            }
            if (auth()->user()->isSarana()) {
                return redirect('sarana');
            }
            if (auth()->user()->isPrasarana()) {
                return redirect('prasarana');
            }
        } else {
            return redirect('login');
        }
    }

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $validator_nipy = 'nullable';
        $validator_ttd = 'nullable';
        if (auth()->user()->isSarpras() || auth()->user()->isBauk()) {
            $validator_nipy = 'required';
            if (!auth()->user()->ttd) {
                $validator_ttd = 'required';
            }
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:users,telp,' . auth()->user()->id,
            'password' => 'required',
            'nipy' => $validator_nipy . '|unique:users,nipy,' . auth()->user()->id,
            'ttd' => $validator_ttd . '|image|mimes:png|max:2048',
        ], [
            'nama.required' => 'Nama Lengkap belum diisi!',
            'telp.required' => 'Nomor Telepon belum diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
            'password.required' => 'Password belum diisi!',
            'nipy.required' => 'NIPY belum diisi!',
            'nipy.unique' => 'NIPY sudah digunakan!',
            'ttd.required' => 'Tanda Tangan belum ditambahkan!',
            'ttd.image' => 'Tanda Tangan harus berformat png!',
            'ttd.max' => 'Tanda Tangan maksimal ukuran 2 MB',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        if ($request->ttd) {
            Storage::disk('local')->delete('public/uploads/' . auth()->user()->ttd);
            $ttd = 'ttd/' . str_replace('.', '', $request->nipy) . '.' . $request->ttd->getClientOriginalExtension();
            $request->ttd->storeAs('public/uploads/', $ttd);
        } else {
            $ttd = auth()->user()->ttd;
        }

        User::where('id', auth()->user()->id)->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'password' => bcrypt($request->password),
            'password_text' => $request->password,
            'nipy' => $request->nipy,
            'ttd' => $ttd,
        ]);

        alert()->success('Success!', 'Berhasil memperbarui Profile');

        return back();
    }

    public function ttd(Request $request)
    {
        if (auth()->user()->ttd) {
            $validator_ttd = 'nullable';
        } else {
            $validator_ttd = 'required';
        }

        $validator = Validator::make($request->all(), [
            'nipy_test' => 'required',
            'ttd_test' => $validator_ttd . '|image|mimes:png|max:2048',
        ], [
            'nipy_test.required' => 'NIPY belum diisi!',
            'ttd_test.required' => 'Tanda Tangan belum ditambahkan!',
            'ttd_test.image' => 'Tanda Tangan harus berformat jpeg, jpg, png!',
            'ttd_test.max' => 'Tanda Tangan maksimal ukuran 2 MB',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal melihat hasil TTD!');
            return back()->withInput()->withErrors($validator->errors());
        }

        if ($request->ttd_test) {
            Storage::disk('local')->delete('public/uploads/' . auth()->user()->ttd);
            $ttd_test = 'ttd/' . str_replace('.', '', $request->nipy_test) . '.' . $request->ttd_test->getClientOriginalExtension();
            $request->ttd_test->storeAs('public/uploads/', $ttd_test);

            User::where('id', auth()->user()->id)->update([
                'nipy' => $request->nipy_test,
                'ttd' => $ttd_test,
            ]);
        } else {
            $ttd_test = auth()->user()->ttd;
        }

        $sarpras = User::where('role', 'sarpras')
            ->select('nama', 'nipy', 'ttd', 'role')
            ->first();
        $bauk = User::where('role', 'bauk')
            ->select('nama', 'nipy', 'ttd', 'role')
            ->first();

        $pdf = Pdf::loadview('ttd', compact('sarpras', 'bauk'));

        return $pdf->stream('Contoh Surat Peminjaman');
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
