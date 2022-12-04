<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AgamaModel;
use App\Models\DetailModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        $data = User::with('detail')->find($user->id);
        $agama = AgamaModel::all();
        return view('pages.user.dashboard', compact('data', 'agama'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|min:10|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'id_agama' => 'required|exists:agama,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = Auth::user();
        $data = User::find($user->id);
        $detail = $data->detail;

        $data->name = $request->name;
        $data->email = $request->email;
        $detail->alamat = $request->alamat;
        $detail->tanggal_lahir = $request->tanggal_lahir;
        $detail->tempat_lahir = $request->tempat_lahir;
        $detail->id_agama = $request->id_agama;
        $detail->umur = date_diff(date_create($request->tanggal_lahir), date_create('now'))->y;

        $data->save();
        $detail->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah detail profil',
        ], 200);
    }


    public function changePhotoKTP()
    {
        $user = Auth::user();
        $detail = User::find($user->id)->detail;

        if ($detail->foto_ktp != "foto_ktp.png") {
            if (file_exists(public_path('photo/' . $detail->foto_ktp))) {
                unlink(public_path('photo/' . $detail->foto_ktp));
            }
        }

        $file = request()->file('photoKTP');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('photo/'), $fileName);

        $detail->foto_ktp = $fileName;
        $savePhoto = $detail->save();

        if ($savePhoto) {
            return back()->with('success', 'Upload foto ktp berhasil');
        } else {
            return back()->with('error', 'Upload foto ktp gagal');
        }
    }

    public function changePhotoProfile()
    {
        $user = Auth::user();
        $detail = User::find($user->id);

        if ($detail->foto != null) {
            if (file_exists(public_path('photo/' . $detail->foto))) {
                unlink(public_path('photo/' . $detail->foto));
            }
        }

        $file = request()->file('photoProfil');

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('photo/'), $fileName);

        $detail->foto = $fileName;

        $savePhoto = $detail->save();
        if ($savePhoto) {
            return back()->with('success', 'Upload foto profil berhasil');
        } else {
            return back()->with('error', 'Upload foto profil gagal');
        }
    }
}
