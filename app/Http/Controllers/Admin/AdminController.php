<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgamaModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;



class AdminController extends Controller
{
    public function view()
    {
        $user = User::with('detail')->where('role', 'user');
        $agama = AgamaModel::all();

        $user_group = $user->get()->groupBy('is_active');

        $user_monthly = $user->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m-Y');
        });

        $user_monthly_active = $user_monthly->map(function ($item) {
            return [
                'active' => $item->where('is_active', 1)->count(),
                'not_active' => $item->where('is_active', 0)->count(),
            ];
        });

        $userAgamaCount = $user->get()->map(function ($item) {
            return $item->detail->agama->nama_agama;
        })->groupBy(function ($item) {
            return $item;
        })->map(function ($item) {
            return $item->count();
        });


        return view('pages.admin.dashboard', compact('user_group', 'user_monthly_active', 'userAgamaCount', 'agama'));
    }


    public function changeStatus(Request $request)
    {
        $user = User::find($request->userId);
        $user->is_active = ($user->is_active == 1) ? 0 : 1;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah status user',
        ]);
    }

    public function changeAgama(Request $request)
    {
        $user = User::find($request->userId);
        $user->detail->id_agama = $request->id_agama;
        $user->detail->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah agama user',
        ]);
    }
}
