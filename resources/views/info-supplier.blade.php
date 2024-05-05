@extends('layouts.app')

@push('page-css')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tab-content profile-tab-cont">
                <!-- تبويب التفاصيل الشخصية -->
                <div class="tab-pane fade show active" id="per_details_tab">
                    <!-- تفاصيل الشخصية -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>تفاصيل شخصية</span>
                                    </h5>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">الاسم</p>
                                        <p class="col-sm-10">{{ $customer->name }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">البريد الإلكتروني</p>
                                        <p class="col-sm-10">{{ $customer->email }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3">دور المستخدم</p>
                                        <p class="col-sm-10">
                                            عميل
                                        </p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mv-0 mb-sm-3"> كود العميل </p>
                                        <p class="col-sm-10">
                                            {{ $customer->id }}
                                        </p>
                                    </div>
                                    <div class="row pt-3">
                                        <div
                                            style="box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;width:auto;margin-right:5px;margin-left:10px">
                                            <p>
                                                المبلغ الكلي المحلي : {{ $customer->totalmoney->local ?? '0' }}
                                            </p>
                                        </div>
                                        <div
                                            style="box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px;width:auto;padding-left:2px">
                                            <p>
                                                المبلغ الكلي المستورد : {{ $customer->totalmoney->imported ?? '0' }}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div
                                    style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /تفاصيل الشخصية -->
                </div>
                <!-- /تبويب التفاصيل الشخصية -->
            </div>
            <!-- بيانات العميل -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between">
                        <span> القيم المضافه </span>
                    </h5>
                    <div class="table-responsive">
                        <table id="datatable-export" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th> القيمه </th>
                                    <th>نوع القيمه</th>
                                    <th> المسؤول </th>
                                    <th> الشهر </th>
                                    <th> اخر من قام بالتحديث </th>
                                    <th> التعديل الذي تم </th>
                                    <th class="action-btn">العملية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->money as $money)
                                    <tr>
                                        <td>{{ AppSettings::get('app_currency', '$') }}{{ $money->value }}</td>
                                        <td>{{ $money->typeMedicine->name }}</td>
                                        <td>{{ $money->user->name }}</td>
                                        <td>{{ $money->month }}</td>
                                        <td>
                                            @if ($money->userUpdate->isNotEmpty())
                                                @foreach ($money->userUpdate as $super)
                                                    {{ $super->user->name }}<br>
                                                @endforeach
                                            @else
                                                no one
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($money->userUpdate as $update)
                                                @php
                                                    $data = json_decode($update->value_update, true);
                                                    $oldValue = $data['update']['before']['value'];
                                                    $newValue = $data['update']['after']['value']['new'];
                                                @endphp
                                                {{ $oldValue }}--> {{ $newValue }} <br>
                                            @endforeach
                                        </td>
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
            <!-- /بيانات العميل-->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between">
                        <span> عمليات الشراء </span>
                    </h5>
                    <div class="table-responsive">
                        <table id="datatable-export" class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th> المنتج </th>
                                    <th> النوع </th>
                                    <th>الكميه</th>
                                    <th> تاريخ الشراء </th>
                                    <th> اخر تعديل </th>
                                    <th> من قام بها </th>
                                    <th> التعديلات </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customer->sales as $sale)
                                    <tr>
                                        <td>{{ $sale->product->name }}</td>
                                        <td>{{ $sale->product->type->name }}</td>
                                        <td>{{ $sale->quantity }}</td>
                                        <td>{{ $sale->created_at }}</td>
                                        <td>{{ $sale->updated_at }}</td>
                                        <td>
                                            @if ($sale->updatSale->isNotEmpty())
                                                @foreach ($sale->updatSale as $super)
                                                    {{ $super->user->name }}
                                                    <hr>
                                                @endforeach
                                            @else
                                                no one
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($sale->updatSale as $update)
                                                @php
                                                    $data = json_decode($update->value_update, true);
                                                    $oldQuantity = $data['update']['before']['quantity'];
                                                    $newQuantity = $data['update']['after']['quantity'];
                                                    $oldType = $data['update']['before']['quantity'];
                                                    $newType = $data['update']['after']['quantity'];
                                                    $oldType = App\Models\Product::findOrFail(
                                                        $data['update']['before']['product_id'],
                                                    );
                                                    $newType = App\Models\Product::findOrFail(
                                                        $data['update']['after']['product_id'],
                                                    );

                                                @endphp
                                                الكميه :
                                                {{ $oldQuantity != $newQuantity ? "$oldQuantity -->$newQuantity" : 'لم يتم تغير الكميه' }}<br>
                                                النوع :
                                                {{ $oldType != $newType ? "$oldType->name -->$$newType->name" : 'لم يتم تغير النوع' }}
                                                <hr>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
