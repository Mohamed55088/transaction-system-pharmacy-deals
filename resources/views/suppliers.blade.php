@extends('layouts.app')

@push('page-css')
    <!-- Select2 css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">قائمة العملاء</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active"> العملاء </li>
        </ul>
    </div>
    <div class="col-sm-5 col">
        <a href="{{ route('add-supplier') }}" class="btn btn-primary float-right mt-2">إضافة جديد</a>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- العملاء -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-export" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>كود العميل</th>
                                    <th>الاسم</th>
                                    <th>الهاتف</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>العنوان</th>
                                    <th> تم الاضافه بواسطه </th>
                                    <th class="action-btn">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->super->name }}</td>
                                        <td>
                                            <div class="actions">
                                                <a class="btn btn-sm bg-info-light"
                                                    href="{{ route('info-supplier', $customer) }}">
                                                    <i class="fas fa-info"></i> المزيد
                                                </a>
                                                <a class="btn btn-sm bg-success-light"
                                                    href="{{ route('edit-supplier', $customer) }}">
                                                    <i class="fe fe-pencil"></i> تعديل
                                                </a>
                                                <a data-id="{{ $customer->id }}" href="javascript:void(0);"
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
            <!-- /العملاء-->

        </div>
    </div>
    <!-- حذف Modal -->
    <x-modals.delete :route="'suppliers'" :title="'المورّد'" />
    <!-- /حذف Modal -->
@endsection

@push('page-js')
    <!-- Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
