@extends('layouts.auth')

@section('content')
    <h1>هل نسيت كلمة المرور؟</h1>
    <p class="account-subtitle">أدخل بريدك الإلكتروني للحصول على رابط إعادة تعيين كلمة المرور</p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('login_error'))
        <x-alerts.danger :error="session('login_error')" />
    @endif

    @if (session('success'))
        <x-alerts.success :message="session('success')" />
    @endif

    <!-- النموذج -->
    <form action="{{ route('forgot-password') }}" method="post">
        @csrf
        <div class="form-group" style="direction: rtl">
            <input class="form-control" name="email" type="text" placeholder="البريد الإلكتروني">
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-primary btn-block" type="submit">إعادة تعيين كلمة المرور</button>
        </div>
    </form>
    <!-- /النموذج -->

    <div class="text-center dont-have">هل تتذكر كلمة المرور الخاصة بك؟ <a href="{{ route('login') }}">تسجيل الدخول</a></div>
@endsection
