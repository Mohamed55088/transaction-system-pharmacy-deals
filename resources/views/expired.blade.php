@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-12">
        <h3 class="page-title">منتهية الصلاحية</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products') }}">المنتجات</a></li>
            <li class="breadcrumb-item active">منتهية الصلاحية</li>
        </ul>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- الطلبات الأخيرة -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-export"
                            class="table table-striped table-bordered table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>اسم العلامة التجارية</th>
                                    <th>الفئة</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الخصم</th>
                                    <th>تاريخ الانتهاء</th>
                                    <th class="action-btn">العملية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                @if (!empty($product->image))
                                                    <span class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img"
                                                            src="{{ asset('storage/products/' . $product->image) }}"
                                                            alt="صورة المنتج">
                                                    </span>
                                                @endif
                                                {{ $product->name }}
                                            </h2>
                                        </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ AppSettings::get('app_currency', '$') }}{{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->discount }}%</td>
                                        <td><span class="btn btn-sm bg-danger-light">المنتج منتهي الصلاحية</span></td>
                                        <td>
                                            <div class="actions">
                                                <a class="btn btn-sm bg-success-light"
                                                    href="{{ route('edit-product', $product) }}">
                                                    <i class="fe fe-pencil"></i> تعديل
                                                </a>
                                                <a data-id="{{ $product->id }}" href="javascript:void(0);"
                                                    class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
                                                    <i class="fe fe-trash"></i> حذف
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /الطلبات الأخيرة -->

        </div>
    </div>

    <!-- حذف Modal -->
    <x-modals.delete :route="'products'" :title="'منتج منتهي الصلاحية'" />
    <!-- /حذف Modal -->
@endsection

@push('page-js')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
