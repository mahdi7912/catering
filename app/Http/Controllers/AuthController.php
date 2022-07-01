<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except([
            'login'
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect(route('login'));
    }

    public function login(Request $request)
    {
        $user = User::where('user_name', $request->user_name)
            ->orWhere('phone', $request->user_name)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'اطلاعات شما یافت نشد'], Response::HTTP_BAD_REQUEST);
        }

        auth()->login($user);

        return response()->json(['message' => 'کد تایید برای شما ارسال شد.', 'user' => $user], Response::HTTP_OK);
    }
}
