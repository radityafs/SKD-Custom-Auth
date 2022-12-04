<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgamaModel;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function view()
    {
        $agama = AgamaModel::all();

        return view('pages.admin.agama', compact('agama'));
    }

    public function store(Request $request)
    {
        AgamaModel::create([
            'nama_agama' => $request->nama_agama,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambahkan agama',
        ], 200);
    }


    public function update(Request $request)
    {
        $agama = AgamaModel::find($request->agamaId);
        $agama->nama_agama = $request->nama_agama;
        $agama->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah agama',
        ], 200);
    }

    public function delete(Request $request)
    {
        $agama = AgamaModel::find($request->agamaId);
        $agama->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menghapus agama',
        ], 200);
    }
}
