@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-12">
        <h3 class="page-title">إضافة عملية شراء</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">إضافة عملية شراء</li>
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
                        action="{{ route('add-purchase') }}">
                        @csrf
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>العميل <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="name">
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> القيمه <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="value"
                                            value="{{ old('value') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> نوع القيمه <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="typevalue">
                                            @foreach ($typevalues as $typevalue)
                                                <option value="{{ $typevalue->id }}">{{ $typevalue->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> الشهر <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="month"
                                            value="{{ old('month') }}">
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
