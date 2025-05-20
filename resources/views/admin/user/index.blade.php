@extends('admin.layouts.index')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                                    Data User
                                    <span>
                                        <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="tooltip-success"
                                            data-bs-title="Traffic Overview"></iconify-icon>
                                    </span>
                                </h5>
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                    data-bs-target="#userModal">
                                    <i class="fas fa-plus-circle"></i>
                                    Add User
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table-1" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ADD User Modal -->
    @include('admin.user.components.add-user-modal')

    <!-- EDIT User Modal -->
    @include('admin.user.components.edit-user-modal')

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_store_user').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                var arr_params = {
                    url: form.attr('action'),
                    method: 'POST',
                    input: form.serialize(),
                    forms: form[0],
                    modal: $('#' + form.data('modal')).modal('hide'),
                    reload: false,
                }
                ajaxSaveDatas(arr_params)
            });

            $('#form_update_user').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                var id = $('.id_edit').val();
                var url = "{{ route('admin-user.update', ['user' => ':id']) }}";
                url = url.replace(':id', id);

                var arr_params = {
                    url: url,
                    method: 'PUT',
                    input: form.serialize(),
                    forms: form[0],
                    modal: $('.' + form.data('modal')).modal('hide'),
                    reload: false,
                }
                ajaxSaveDatas(arr_params)
            });

            var dataColumns = [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role'
                },
                {
                    data: 'id'
                },
            ];

            var columnDef = [{
                    targets: [0],
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `<p class="text-center"> ${meta.row + 1} </p>`
                    }                },
                {
                    targets: [4],
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `<div class="row w-100">
                            <div class="col-12 d-flex">
                                <a class="btn btn-warning btn-lg mr-1"
                                    href="#"
                                    data-bs-toggle="modal" data-bs-target=".edit-user" data-id="${data}"
                                    data-name="${full.name}"
                                    data-email="${full.email}"
                                    data-role="${full.role}"
                                    title="Edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-lg ml-1"
                                    href="#deleteData" data-delete-url="/admin-user/${data}"
                                    onclick="return deleteConfirm(this,'delete')"
                                    title="Delete"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>`
                    }
                },
            ];

            var arrayParams = {
                idTable: '#table-1',
                urlAjax: "{{ url()->current() }}",
                columns: dataColumns,
                defColumn: columnDef,
            }
            loadAjaxDataTables(arrayParams);

            $('.edit-user').on('show.bs.modal', function(e) {
                const button = $(e.relatedTarget);
                $('.id_edit').val(button.data('id'));
                $('.edit_name').val(button.data('name'));
                $('.edit_email').val(button.data('email'));
                $('.edit_role').val(button.data('role'));
            });
        });
    </script>
@endpush
