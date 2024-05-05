@extends('layouts.auth')

@section('content')
    <h1>تسجيل الدخول</h1>
    <p class="account-subtitle">الوصول إلى لوحة التحكم الخاصة بنا</p>
    @if (session('login_error'))
        <x-alerts.danger :error="session('login_error')" />
    @endif
    <!-- النموذج -->
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group" style="direction: rtl">
            <input class="form-control" name="email" type="text" placeholder="البريد الإلكتروني">
        </div>
        <div class="form-group" style="direction: rtl">
            <input class="form-control" name="password" type="password" placeholder="كلمة المرور">
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">تسجيل الدخول</button>
        </div>
    </form>
    <!-- /النموذج -->

    <div class="text-center forgotpass"><a href="{{ route('forgot-password') }}">نسيت كلمة المرور؟</a></div>

    <div class="text-center dont-have">ليس لديك حساب؟ <a href="{{ route('register') }}">التسجيل</a></div>
@endsection
