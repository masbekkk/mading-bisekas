@extends('admin.layouts.index')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                            Traffic Overview
                            <span>
                                <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                                    data-bs-title="Traffic Overview"></iconify-icon>
                            </span>
                        </h5>
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#madingModal">
                            Add Mading
                        </button>
                        <div class="table-responsive">
                            <table id="table-1" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Project Owner</th>
                                        <th>Work Location</th>
                                        <th>Type of Work</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>PIC</th>
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

    <!-- Mading Modal -->
    <div class="modal fade" id="madingModal" tabindex="-1" aria-labelledby="madingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="madingModalLabel">Add Mading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_store_mading" action="{{ route('admin-mading.store') }}" method="POST"
                        data-modal="madingModal">
                        @csrf
                        <div class="mb-3">
                            <label for="project_owner" class="form-label">Project Owner</label>
                            <input type="text" class="form-control" id="project_owner" name="project_owner">
                        </div>
                        <div class="mb-3">
                            <label for="work_location" class="form-label">Work Location</label>
                            <input type="text" class="form-control" id="work_location" name="work_location">
                        </div>
                        <div class="mb-3">
                            <label for="type_of_work" class="form-label">Type of Work</label>
                            <textarea class="form-control" id="type_of_work" name="type_of_work"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Tagihan DP">Tagihan DP</option>
                                <option value="FPP">FPP</option>
                                <option value="Pengadaan">Pengadaan</option>
                                <option value="Running">Running</option>
                                <option value="RETUR">RETUR</option>
                                <option value="BAST">BAST</option>
                                <option value="Invoice">Invoice</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <input type="text" class="form-control" id="pic" name="pic">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="admin/assets/js/custom-datatable.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_store_mading').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                var arr_params = {
                    url: form.attr('action'),
                    method: 'POST',
                    input: form.serialize(),
                    forms: form[0],
                    modal: $('.' + form.data('modal')).modal('hide'),
                    reload: false,
                }
                ajaxSaveDatas(arr_params)
            });

            $('#form_update_mading').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                var id = $('.id_edit').val();
                var url = "{{ route('admin-mading.update', ['admin_mading' => ':id']) }}";
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
                    data: 'project_owner'
                },
                {
                    data: 'work_location'
                },
                {
                    data: 'type_of_work'
                },
                {
                    data: 'status'
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'pic'
                },
                {
                    data: 'actions'
                },
            ];

            var columnDef = [{
                    targets: [0],
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `<p class="text-center"> ${meta.row + 1} </p>`
                    }
                },
                {
                    targets: [7],
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return `<div class="row w-100">
                            <div class="col-12 d-flex">
                                <a class="btn btn-warning btn-lg mr-1"
                                    href="#"
                                    data-bs-toggle="modal" data-bs-target=".edit-mading" data-id="${data}"
                                    data-project_owner="${full.project_owner}"
                                    data-work_location="${full.work_location}"
                                    data-type_of_work="${full.type_of_work}"
                                    data-status="${full.status}"
                                    data-tanggal="${full.tanggal}"
                                    data-pic="${full.pic}"
                                    title="Edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-lg ml-1"
                                    href="#deleteData" data-delete-url="/mading/${data}" 
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

            $('.edit-mading').on('show.bs.modal', function(e) {
                const button = $(e.relatedTarget);
                $('.id_edit').val(button.data('id'));
                $('.project_owner_edit').val(button.data('project_owner'));
                $('.work_location_edit').val(button.data('work_location'));
                $('.type_of_work_edit').val(button.data('type_of_work'));
                $('.status_edit').val(button.data('status'));
                $('.tanggal_edit').val(button.data('tanggal'));
                $('.pic_edit').val(button.data('pic'));
            });
        });
    </script>
@endpush
