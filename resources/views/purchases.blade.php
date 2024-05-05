@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title"> مستحقات العملاء </h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">الشراء</li>
        </ul>
    </div>
    <div class="col-sm-5 col">
        <a href="{{ route('add-purchase') }}" class="btn btn-primary float-right mt-2">إضافة جديد</a>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- آخر الطلبات -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-export" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>اسم العميل</th>
                                    <th> القيمه </th>
                                    <th>نوع القيمه</th>
                                    <th> المسؤول </th>
                                    <th> الشهر </th>
                                    <th> اخر من قام بالتحديث </th>

                                    <th class="action-btn">العملية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasmoney as $money)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                {{ $money->customer->name }}
                                            </h2>
                                        </td>
                                        <td>{{ AppSettings::get('app_currency', '$') }}{{ $money->value }}</td>
                                        <td>{{ $money->typeMedicine->name }}</td>
                                        <td>{{ $money->user->name }}</td>
                                        <td>{{ $money->month }}</td>
                                        <td>{{ $money->userUpdate->last()->user->name ?? 'no one' }}</td>
                                        <td>
                                            <div class="actions">
                                                <a class="btn btn-sm bg-success-light"
                                                    href="{{ route('edit-purchase', $money) }}">
                                                    <i class="fe fe-pencil"></i> تعديل
                                                </a>
                                                <a data-id="{{ $money->id }}" href="javascript:void(0);"
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
            <!-- /آخر الطلبات -->
        </div>
    </div>
    <!-- نافذة حذف -->
    <x-modals.delete :route="'purchases'" :title="'الشراء'" />
    <!-- /نافذة حذف -->
@endsection

@push('page-js')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
