@extends('layouts.app')

@push('page-css')
    <!-- Select2 css-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('page-header')
    <div class="col-sm-7 col-auto">
        <h3 class="page-title">المستخدمين</h3>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
            <li class="breadcrumb-item active">المستخدمين</li>
        </ul>
    </div>
    <div class="col-sm-5 col">
        <a href="#add_user" data-toggle="modal" class="btn btn-primary float-right mt-2">إضافة مستخدم</a>
    </div>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-export"
                            class=" table table-striped table-bordered table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الدور</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th class="text-center action-btn">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                @if (!empty($user->avatar))
                                                    <span class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img"
                                                            src="{{ asset('storage/users/' . $user->avatar) }}"
                                                            alt="صورة المستخدم">
                                                    </span>
                                                @endif
                                                {{ $user->name }}
                                            </h2>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        @can('update-role')
                                            <td>
                                                @foreach ($user->getRoleNames() as $role)
                                                    {{ $role }}
                                                @endforeach
                                            </td>
                                        @endcan
                                        <td>{{ date_format(date_create($user->created_at), 'd M,Y') }}</td>

                                        <td class="text-center">
                                            <div class="actions">
                                                <a data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    class="btn btn-sm bg-success-light editbtn" id="edit-user"
                                                    data-toggle="modal" href="javascript:void(0)">
                                                    <i class="fe fe-pencil"></i> تعديل
                                                </a>
                                                <a data-id="{{ $user->id }}" href="javascript:void(0);"
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
        </div>
    </div>

    <!-- إضافة مستخدم Modal -->
    <div class="modal fade" id="add_user" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة مستخدم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('users') }}">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>الاسم الكامل</label>
                                    <input type="text" name="name" class="form-control" placeholder="جون دو">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>البريد الإلكتروني</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>الدور</label>
                                    <div class="form-group">
                                        <select class="select2 form-select form-control" name="role">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>الصورة</label>
                                    <input type="file" name="avatar">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>كلمة المرور</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تأكيد كلمة المرور</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">حفظ التغييرات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /إضافة مستخدم Modal -->

    <!-- تعديل بيانات Modal -->
    <div class="modal fade" id="edit_user" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل مستخدم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('users') }}">
                        @csrf
                        @method('PUT')
                        <div class="row form-row">
                            <input type="hidden" name="id" id="edit_id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>الاسم الكامل</label>
                                    <input type="text" name="name" class="form-control edit_name"
                                        placeholder="جون دو">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input type="email" name="email" class="form-control edit_email" id="email">
                                </div>
                            </div>
                            @can('update-role')
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>الدور</label>
                                        <div class="form-group">
                                            <select class="select2 form-select form-control edit_role" name="role">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="avatar">صورة المستخدم</label>
                                    <input type="file" name="avatar" id="avatar">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>كلمة المرور</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>تأكيد كلمة المرور</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">حفظ التغييرات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /تعديل بيانات Modal -->

    <!-- حذف Modal -->
    <x-modals.delete :route="'users'" :title="'المستخدم'" />
    <!-- /حذف Modal -->
@endsection

@push('page-js')
    <!-- Select2 js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable-export').on('click', '.editbtn', function() {
                event.preventDefault();
                jQuery.noConflict();
                $('#edit_user').modal('show');
                var id = $(this).data('id');
                var name = $(this).data('name');
                var email = $(this).data('email');
                var role = $(this).data('role');
                $('#edit_id').val(id);
                $('.edit_name').val(name);
                $('.edit_email').val(email);
                $('.edit_role').val(role);
            });
        });
    </script>
@endpush
