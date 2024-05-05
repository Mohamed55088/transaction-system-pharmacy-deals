@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">المنتجات</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">المنتجات</li>
        </ul>
    </div>
    <div class="col-sm-5 col">
        <a href="{{ route('add-product') }}" class="btn btn-primary float-right mt-2">إضافة جديد</a>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- المنتجات -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-export" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>اسم المنتج</th>
                                    <th>نوع الدواء</th>
                                    <th>السعر</th>
                                    <th>المسؤول</th>
                                    <th class="action-btn">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    @if ($product->exists())
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    {{ $product->name }}
                                                </h2>
                                            </td>
                                            <td>{{ $product->type->name }}</td>
                                            <td>{{ AppSettings::get('app_currency', '$') }} {{ $product->price }}
                                            </td>
                                            <td>{{ $product->super->name }}</td>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /المنتجات -->

        </div>
    </div>

    <!-- نافذة حذف -->
    <x-modals.delete :route="'products'" :title="'منتج'" />
    <!-- /نافذة حذف -->
@endsection

@push('page-js')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
