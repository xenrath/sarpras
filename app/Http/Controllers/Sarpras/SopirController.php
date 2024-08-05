<?php

namespace App\Http\Controllers\Sarpras;

use App\Http\Controllers\Controller;
use App\Models\Sopir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SopirController extends Controller
{
    public function index()
    {
        $sopirs = Sopir::select('id', 'nama', 'telp')->paginate(5);

        return view('sarpras.sopir.index', compact('sopirs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:sopirs,telp',
        ], [
            'nama.required' => 'Nama Sopir harus diisi!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Sopir::create([
            'nama' => $request->nama,
            'telp' => $request->telp,
        ]);

        alert()->success('Success', 'Berhasil menambahkan Sopir');

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:sopirs,telp,' . $id . ',id',
        ], [
            'nama.required' => 'Nama Sopir harus diisi!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        Sopir::where('id', $id)->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
        ]);

        alert()->success('Success', 'Berhasil memperbarui Sopir');

        return back();
    }

    public function destroy($id)
    {
        Sopir::where('id', $id)->delete();

        alert()->success('Success', 'Berhasil menghapus Sopir');

        return back();
    }
}
