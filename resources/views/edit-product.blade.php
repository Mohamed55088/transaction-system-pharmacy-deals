@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-12">
        <h3 class="page-title">تعديل المنتج</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">تعديل المنتج</li>
        </ul>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom-edit-service">

                    <!-- تعديل الدواء -->
                    <form method="post" enctype="multipart/form-data" id="update_service"
                        action="{{ route('edit-product', $product) }}">
                        @csrf
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label> اسم الدواء <span class="text-danger">*</span></label>
                                        <input class="form-control" value="{{ $product->name }}" type="text"
                                            name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>المنتج <span class="text-danger">*</span></label>
                                        <select class="select2 form-select form-control" name="product_type">
                                            @foreach ($products_type as $products_type)
                                                <option @if ($products_type->id == $product->type->id) selected @endif
                                                    value="{{ $products_type->id }}">{{ $products_type->name }}
                                                </option>
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
                                            value="{{ $product->price }}">
                                        <input class="form-control" type="hidden" name="user_id"
                                            value="{{ $product->user_id }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit" name="form_submit"
                                value="submit">إرسال</button>
                        </div>
                    </form>
                    <!-- /تعديل الدواء -->
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-js')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
