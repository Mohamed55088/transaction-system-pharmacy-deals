<!-- الرأس -->
<div class="header">

    <!-- الشعار -->
    <div class="header-left">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="@if (!empty(AppSettings::get('logo'))) {{ asset('storage/' . AppSettings::get('logo')) }} @else{{ asset('assets/img/logo.webp') }} @endif"
                alt="الشعار">
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-small">
            <img src="{{ asset('assets/img/logo-small.webp') }}" alt="الشعار" width="30" height="30">
        </a>
    </div>
    <!-- /الشعار -->

    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fe fe-text-align-left"></i>
    </a>

    <!-- تبديل القائمة المتنقلة -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /تبديل القائمة المتنقلة -->

    <!-- قائمة اليمين في الرأس -->
    <ul class="nav user-menu">

        <!-- الإشعارات -->
        <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fe fe-bell"></i> <span
                    class="badge badge-pill">{{ auth()->user()->unReadNotifications->count() }}</span>
            </a>
            <div class="dropdown-menu notifications " style="right: auto">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">الإشعارات</span>
                    <a href="{{ route('mark-as-read') }}" class="clear-noti">تحديد الكل كمقروء</a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @foreach (auth()->user()->unReadNotifications as $notification)
                            <li class="notification-message">
                                <a href="{{ route('read') }}">
                                    <div class="media">
                                        <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="صورة المنتج"
                                                src="{{ asset('storage/purchases/' . $notification['image']) }}">
                                        </span>
                                        <div class="media-body">
                                            <h6 class="text-danger">تنبيه بالمخزون</h6>
                                            <p class="noti-details">
                                                <span class="noti-title">{{ $notification->data['product_name'] }} باقي
                                                    {{ $notification->data['quantity'] }} فقط.</span>
                                                <span>الرجاء تحديث كمية الشراء </span>
                                            </p>

                                            <p class="noti-time"><span
                                                    class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">عرض كافة الإشعارات</a>
                </div>
            </div>
        </li>
        <!-- /الإشعارات -->

        <!-- قائمة المستخدم -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle"
                        src="@if (!empty(auth()->user()->avatar)) {{ asset('storage/users/' . auth()->user()->avatar) }} @else {{ asset('assets/img/logo-small.webp') }} @endif"
                        width="31" alt="الصورة الرمزية"></span>
            </a>
            <div class="dropdown-menu" style="right: auto">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="@if (!empty(auth()->user()->avatar)) {{ asset('storage/users/' . auth()->user()->avatar) }} @else {{ asset('assets/img/logo-small.webp') }} @endif"
                            alt="صورة المستخدم" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text pt-2">
                        <h6>{{ auth()->user()->name }}</h6>
                    </div>
                </div>

                <a class="dropdown-item" href="{{ route('profile') }}">ملفي الشخصي</a>
                @can('view-settings')
                    <a class="dropdown-item" href="{{ route('settings') }}">الإعدادات</a>
                @endcan
                @can('backup-app')
                    <a class="dropdown-item" href="{{ route('backup-app') }}">نسخ احتياطي للتطبيق</a>
                @endcan
                @can('backup-db')
                    <a class="dropdown-item" href="{{ route('backup-db') }}">نسخ احتياطي لقاعدة البيانات</a>
                @endcan
                <a class="dropdown-item" href="{{ route('logout') }}">تسجيل الخروج</a>
            </div>
        </li>
        <!-- /قائمة المستخدم -->

    </ul>
    <!-- /قائمة اليمين في الرأس -->

</div>
<!-- /الرأس -->
