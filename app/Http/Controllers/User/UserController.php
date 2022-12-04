<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function changePassword()
    {
        $user = Auth::user();
        $userModel = User::find($user->id);

        Validator::make(request()->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6|max:50',
            'repassword' => 'required|same:password',
        ])->validate();

        if (!Hash::check(request()->old_password, $userModel->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password lama salah',
            ], 422);
        };

        $userModel->password = bcrypt(request()->password);
        $userModel->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mengubah password',
        ], 200);
    }
}
