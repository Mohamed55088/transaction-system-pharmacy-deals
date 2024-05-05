<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $title = "forgot password";
        return view(
            'auth.forgot-password',
            compact(
                'title'
            )
        );
    }

    public function reset(Request $request)
    {
        //validate the request

        try {
            $this->validate($request, [
                'email' => 'required|email',
            ]);

            $user = User::where('email', $request->email)->first();
            if (!isset($user)) {
                return back()->with('login_error', ' البريد الإلكتروني غير موجود ');
            }
            return back()->with('success', ' البريد الإلكتروني موجود ولكن لايمكن عمل اي اجراء الا من خلال المسؤولين');
        } catch (\Exception $e) {
            return back()->with('login_error', ' هناك خطأ ما ');
        }
    }
}
