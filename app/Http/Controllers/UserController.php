<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function json()
    {
        $user = User::select(['id', 'name', 'email', 'email_verified_at']);

        return Datatables::of($user)
            ->editColumn('email', function ($user) {
                $tanda = "";
                $pecah = explode('@', $user->email);
                for ($i = 1; $i < strlen($pecah[0]) - 1; $i++) {
                    $tanda .= "*";
                }
                $cen = str_replace(substr($pecah[0], 1, -1), $tanda, $pecah[0]) . "@" . $pecah[1];
                return $user->email ? $cen : '';
            })
            ->editColumn('email_verified_at', function ($user) {
                return $user->email_verified_at ? with(new Carbon($user->email_verified_at))->format('Y-m-d H:i:s') : '';
            })
            ->make(true);
    }
}
