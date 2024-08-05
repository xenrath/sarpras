<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'dev')
            ->select('id', 'nama', 'telp', 'role')
            ->paginate(5);

        return view('dev.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:users,telp',
            'role' => 'required',
        ], [
            'nama.required' => 'Nama User harus diisi!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
            'role.required' => 'Role harus dipilih!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        User::create([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'password' => bcrypt('bhamada'),
            'role' => $request->role,
        ]);

        alert()->success('Success', 'Berhasil menambahkan User');

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'telp' => 'required|unique:users,telp',
            'role' => 'required',
        ], [
            'nama.required' => 'Nama User harus diisi!',
            'telp.required' => 'Nomor Telepon harus diisi!',
            'telp.unique' => 'Nomor Telepon sudah digunakan!',
            'role.required' => 'Role harus dipilih!',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return back()->withInput()->with('error', $error);
        }

        User::where('id', $id)->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
        ]);

        alert()->success('Success', 'Berhasil memperbarui User');

        return back();
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        alert()->success('Success', 'Berhasil menghapus User');

        return back();
    }

    public function reset($id)
    {
        User::where('id', $id)->update([
            'password' => bcrypt('bhamada')
        ]);

        alert()->success('Success', 'Berhasil mereset Password');

        return back();
    }
}
