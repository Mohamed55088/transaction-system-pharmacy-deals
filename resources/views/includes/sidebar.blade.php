<!-- الشريط الجانبي -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>الرئيسية</span>
                </li>
                <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>الرئيسية</span></a>
                </li>
                {{-- 
                        @can('view-category')
                    <li class="{{ Request::routeIs('categories') ? 'active' : '' }}">
                        <a href="{{ route('categories') }}"><i class="fe fe-layout"></i> <span> اقسام الادويه </span></a>
                    </li>
                @endcan
                    --}}
                @can('view-products')
                    <li class="submenu">
                        <a href="#"><i class="fe fe-document"></i> <span> المنتجات</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @can('view-products')
                                <li><a class="{{ Request::routeIs('products') ? 'active' : '' }}"
                                        href="{{ route('products') }}">المنتجات</a></li>
                            @endcan
                            @can('create-product')
                                <li><a class="{{ Request::routeIs('add-product') ? 'active' : '' }}"
                                        href="{{ route('add-product') }}">إضافة منتج</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('view-purchase')
                    <li class="submenu">
                        <a href="#"><i class="fe fe-star-o"></i> <span> مستحقات </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ Request::routeIs('purchases') ? 'active' : '' }}"
                                    href="{{ route('purchases') }}">قائمة بالمستحقات</a></li>
                            @can('create-purchase')
                                <li><a class="{{ Request::routeIs('add-purchase') ? 'active' : '' }}"
                                        href="{{ route('add-purchase') }}">إضافة قيمه جديده</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('view-sales')
                    <li><a class="{{ Request::routeIs('sales') ? 'active' : '' }}" href="{{ route('sales') }}"><i
                                class="fe fe-activity"></i> <span>المبيعات</span></a></li>
                @endcan

                <li class="submenu">
                    <a href="#"><i class="fe fe-user"></i> <span> العملاء</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::routeIs('suppliers') ? 'active' : '' }}"
                                href="{{ route('suppliers') }}">العملاء</a></li>
                        @can('create-supplier')
                            <li><a class="{{ Request::routeIs('add-supplier') ? 'active' : '' }}"
                                    href="{{ route('add-supplier') }}">إضافة عميل</a></li>
                        @endcan
                    </ul>
                </li>
                @can('view-access-control')
                    <li class="submenu">
                        <a href="#"><i class="fe fe-lock"></i> <span> إدارة الوصول</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @can('view-permission')
                                <li><a class="{{ Request::routeIs('permissions') ? 'active' : '' }}"
                                        href="{{ route('permissions') }}">الصلاحيات</a></li>
                            @endcan
                            @can('view-role')
                                <li><a class="{{ Request::routeIs('roles') ? 'active' : '' }}"
                                        href="{{ route('roles') }}">الأدوار</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('view-users')
                    <li class="{{ Request::routeIs('users') ? 'active' : '' }}">
                        <a href="{{ route('users') }}"><i class="fe fe-users"></i> <span>المستخدمين</span></a>
                    </li>
                @endcan

                <li class="{{ Request::routeIs('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}"><i class="fe fe-user-plus"></i> <span>الملف الشخصي</span></a>
                </li>
                @can('view-settings')
                    <li class="{{ Request::routeIs('settings') ? 'active' : '' }}">
                        <a href="{{ route('settings') }}">
                            <i class="fa fa-gears"></i>
                            <span class="pl-1">الإعدادات</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
<!-- /الشريط الجانبي -->
