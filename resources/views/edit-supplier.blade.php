@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-12">
        <h3 class="page-title">إضافة مورد</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">إضافة مورد</li>
        </ul>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom-edit-service">


                    <!-- إضافة دواء -->
                    <form method="post" enctype="multipart/form-data" action="{{ route('edit-supplier', $customer) }}">
                        @csrf
                        @method('PUT')
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>الاسم<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" value="{{ $customer->name }}"
                                            name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>البريد الإلكتروني<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $customer->email }}"
                                        name="email">
                                </div>
                            </div>
                        </div>

                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>الهاتف<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" value="{{ $customer->phone }}"
                                            name="phone">
                                        <input class="form-control" type="hidden" value="{{ $customer->user_id }}"
                                            name="user_id">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>العنوان<span class="text-danger">*</span></label>
                                        <input type="text" name="address" value="{{ $customer->address }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit" name="form_submit"
                                value="submit">إرسال</button>
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
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
