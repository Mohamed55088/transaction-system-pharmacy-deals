@extends('layouts.app')

@push('page-css')
    <!-- Select2 css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">المبيعات</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">المبيعات</li>
        </ul>
    </div>
    @can('create-sales')
        <div class="col-sm-5 col">
            <a href="#add_sales" data-toggle="modal" class="btn btn-primary float-right mt-2">إضافة مبيعات</a>
        </div>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- المبيعات الأخيرة -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-export" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th> اسم العميل </th>
                                    <th> اسم الدواء </th>
                                    <th> نوع الدواء </th>
                                    <th> الكميه </th>
                                    <th> سعر العلبه </th>
                                    <th> المسؤول </th>
                                    <th>التاريخ</th>
                                    <th> من قام بأخر تحديث </th>
                                    <th class="action-btn">العملية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->customer->name }}</td>
                                        <td>{{ $sale->product->name }}</td>
                                        <td>{{ $sale->product->type->name }}</td>
                                        <td>{{ $sale->quantity }}</td>
                                        <td>{{ AppSettings::get('app_currency', '$') }} {{ $sale->product->price }}
                                        </td>
                                        <td> {{ $sale->super->name }}</td>
                                        <td>{{ date_format(date_create($sale->created_at), ' H:i/ d ,M Y') }}</td>
                                        <td>{{ $sale->updatSale->last()->user->name ?? 'no one' }}</td>
                                        <td>
                                            <div class="actions">
                                                @can('update-sales')
                                                    <a class="btn btn-sm bg-info-light"
                                                        href="{{ route('info-supplier', $sale->customer) }}">
                                                        <i class="fas fa-info"></i> المزيد
                                                    </a>
                                                    <a data-id="{{ $sale->id }}" data-product="{{ $sale->product_id }}"
                                                        data-quantity="{{ $sale->quantity }}"
                                                        class="btn btn-sm bg-success-light editbtn" href="javascript:void(0);">
                                                        <i class="fe fe-pencil"></i> تعديل
                                                    </a>
                                                @endcan
                                                @can('destroy-sales')
                                                    <a data-id="{{ $sale->id }}" href="javascript:void(0);"
                                                        class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
                                                        <i class="fe fe-trash"></i> حذف
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /المبيعات الأخيرة -->

        </div>
    </div>
    <!-- حذف Modal -->
    <x-modals.delete :route="'sales'" :title="'بيع المنتجات'" />
    <!-- /حذف Modal -->
    <!-- إضافة Modal -->
    <div class="modal fade" id="add_sales" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">بيع منتج</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('sales') }}">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>اسم العميل <span class="text-danger">*</span></label>
                                    <select class="select2 form-select form-control" name="customerid">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>المنتج <span class="text-danger">*</span></label>
                                    <select class="select2 form-select form-control" name="productid">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>الكمية</label>
                                    <input type="number" value="1" class="form-control" name="quantity">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"> تأكيد البيع </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /إضافة Modal -->

    <!-- تعديل Modal -->
    <div class="modal fade" id="edit_sale" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل منتج مباع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('sales') }}">
                        @csrf
                        @method('PUT')
                        <div class="row form-row">
                            <div class="col-12">
                                <input type="hidden" id="edit_id" name="id">
                                <div class="form-group">
                                    <label>المنتج <span class="text-danger">*</span></label>
                                    <select class="select2 form-select form-control edit_product" name="product">
                                        @foreach ($products as $product)
                                            @if (!empty($product))
                                                <option value="{{ $product->id }}">{{ $product->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>الكمية</label>
                                    <input type="number" class="form-control edit_quantity" name="quantity">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">حفظ التغييرات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /تعديل Modal -->
@endsection


@push('page-js')
    <!-- Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable-export').on('click', '.editbtn', function() {
                event.preventDefault();
                jQuery.noConflict();
                $('#edit_sale').modal('show');
                var id = $(this).data('id');
                var product = $(this).data('product');
                var quantity = $(this).data('quantity');
                $('#edit_id').val(id);
                $('.edit_product').val(product);
                $('.edit_quantity').val(quantity);

            });
        });
    </script>
@endpush
