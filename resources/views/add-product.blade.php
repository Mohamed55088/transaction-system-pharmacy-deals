@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-12">
        <h3 class="page-title">إضافة منتج</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">إضافة منتج</li>
        </ul>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom-edit-service">

                    <!-- إضافة دواء -->
                    <form method="post" enctype="multipart/form-data" id="update_service"
                        action="{{ route('add-product') }}">
                        @csrf
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>اسم الدواء <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> نوع الدواء <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="product_type">
                                            @foreach ($products_type as $product_type)
                                                <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>سعر البيع<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="price"
                                            value="{{ old('price') }}">
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
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
