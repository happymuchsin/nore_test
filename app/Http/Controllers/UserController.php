<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::select('level')->where('email', Auth::user()->email)->first();
        return view('user.index', ['level' => $user]);
    }

    public function json()
    {
        if (Auth::user()->level == 99) {
            $user = User::select(['id', 'name', 'email', 'email_verified_at', 'level']);
        } else {
            $user = User::select(['id', 'name', 'email', 'email_verified_at', 'level'])->where('email', Auth::user()->email)->get();
        }

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

    public function crup(Request $request)
    {
        if ($request->id == 0) {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } else {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        User::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => date("Y-m-d H:i:s"),
                'level' => $request->level,
            ],
        );

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            'isi' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => true]);
    }

    public function excel()
    {
        $user = User::all();

        return view('User.excel', ['user' => $user]);
    }

    public function pdf()
    {
        $user = User::all();

        $pdf = PDF::loadview('User.pdf', ['user' => $user]);
        return $pdf->download('User.pdf');
    }
}
