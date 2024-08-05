<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::select('id', 'nama', 'kapasitas')->paginate(5);

        return view('sarpras.kendaraan.index', compact('kendaraans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kapasitas' => 'required',
        ], [
            'nama.required' => 'Nama Kendaraan harus diisi!',
            'kapasitas.required' => 'Kapasitas Penumpang harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Kendaraan::create([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        alert()->success('Success', 'Berhasil menambahkan Kendaraan');

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kapasitas' => 'required',
        ], [
            'nama.required' => 'Nama Kendaraan harus diisi!',
            'kapasitas.required' => 'Kapasitas Penumpang harus diisi!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Kendaraan::where('id', $id)->update([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        alert()->success('Success', 'Berhasil memperbarui Kendaraan');

        return back();
    }

    public function destroy($id)
    {
        Kendaraan::where('id', $id)->delete();

        alert()->success('Success', 'Berhasil menghapus Kendaraan');

        return back();
    }
}
