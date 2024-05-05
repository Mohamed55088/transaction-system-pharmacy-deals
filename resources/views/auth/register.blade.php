@extends('layouts.auth')

@section('content')
    <h1>التسجيل</h1>
    <p class="account-subtitle">الوصول إلى لوحة التحكم الخاصة بنا</p>
    @if (session('login_error'))
        <x-alerts.danger :error="session('login_error')" />
    @endif
    <!-- النموذج -->
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group" style="direction: rtl">
            <input class="form-control" name="name" type="text" value="{{ old('name') }}" placeholder="الاسم الكامل">
        </div>
        <div class="form-group" style="direction: rtl">
            <input class="form-control" name="email" type="text" value="{{ old('email') }}"
                placeholder="البريد الإلكتروني">
        </div>
        <div class="form-group" style="direction: rtl">
            <input class="form-control" name="password" type="password" placeholder="كلمة المرور">
        </div>
        <div class="form-group" style="direction: rtl">
            <input class="form-control" name="password_confirmation" type="password" placeholder="تأكيد كلمة المرور">
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-primary btn-block" type="submit">التسجيل</button>
        </div>
    </form>
    <!-- /النموذج -->

    <div class="text-center dont-have">لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></div>
@endsection
