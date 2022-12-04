<?php

namespace App\Http\Controllers;

use App\Models\DetailModel;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function loginwithTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function cbTwitter()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            $userWhere = User::where('twitter_id', $user->id)->first();

            if ($userWhere) {
                Auth::login($userWhere);
                return redirect('/user/dashboard');
            } else {

                DB::beginTransaction();
                try {
                    $RegistUser = User::create([
                        'name' => $user->name,
                        'email' => ($user->email) ? $user->email : $user->id . '@twitter.com',
                        'twitter_id' => $user->id,
                        'oauth_type' => 'twitter',
                        'password' => bcrypt('12345678'),
                        'role' => 'user',
                        'is_active' => 1,
                    ]);

                    DetailModel::create([
                        'id_user' => $RegistUser->id,
                    ]);

                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();

                    return redirect('/login')->with('error', 'Gagal melakukan registrasi');
                }

                return redirect('/login')->with('success', 'Berhasil mendaftar');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
