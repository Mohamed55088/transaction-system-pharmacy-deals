@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-12">
        <h3 class="page-title">تعديل عملية الشراء</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">تعديل عملية الشراء</li>
        </ul>
    </div>
@endpush


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom-edit-service">

                    <!-- إضافة دواء -->
                    <form method="post" enctype="multipart/form-data" autocomplete="off"
                        action="{{ route('edit-purchase', $purchase) }}">
                        @csrf
                        @method('PUT')
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>اسم العميل <span class="text-danger">*</span></label>
                                        <input class="form-control" value="{{ $purchase->customer->name }}" type="disable"
                                            name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> القيمه <span class="text-danger">*</span></label>
                                        <input class="form-control" value="{{ $purchase->value }}" type="text"
                                            name="value">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>الفئة <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="typevalue">
                                            @foreach ($typevalues as $typevalue)
                                                <option @if ($purchase->typeMedicine->id == $typevalue->id) selected @endif
                                                    value="{{ $typevalue->id }}">{{ $typevalue->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>الشهر<span class="text-danger">*</span></label>
                                        <input class="form-control" value="{{ $purchase->month }}" type="text"
                                            name="month">
                                        <input class="form-control" value="{{ $purchase->user_id }}" type="hidden"
                                            name="user">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">إرسال</button>
                        </div>
                    </form>
                    <!-- /إضافة دواء -->

                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <!-- Datetimepicker JS -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
