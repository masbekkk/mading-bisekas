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
                                    Data Mading
                                    <span>
                                        <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="tooltip-success"
                                            data-bs-title="Traffic Overview"></iconify-icon>
                                    </span>
                                </h5>
                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                    data-bs-target="#madingModal">
                                    <i class="fas fa-plus-circle"></i>
                                    Add Mading
                                </button>
                            </div>
                            <div>
                                <a href="/" target="_blank" class="btn btn-info mb-3">
                                    <i class="fas fa-external-link-alt"></i>
                                    Lihat Mading
                                </a>
                            </div>
                        </div>
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

    <!-- ADD Mading Modal -->
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
                                <option value="Finish">Finish</option>
                                <option value="RETUR & BAST">RETUR & BAST</option>
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

    <!-- EDIT Mading Modal -->
    <div class="modal fade edit-mading" tabindex="-1" aria-labelledby="madingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="madingModalLabel">Edit Mading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_update_mading" method="POST" data-modal="edit-mading">
                        @csrf
                        <div class="mb-3">
                            <label for="project_owner" class="form-label">Project Owner</label>
                            <input type="text" class="form-control edit_project_owner" name="project_owner">
                        </div>
                        <div class="mb-3">
                            <label for="work_location" class="form-label">Work Location</label>
                            <input type="text" class="form-control edit_work_location" name="work_location">
                        </div>
                        <div class="mb-3">
                            <label for="type_of_work" class="form-label">Type of Work</label>
                            <textarea class="form-control edit_type_of_work" name="type_of_work"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control edit_status" name="status">
                                <option value="Tagihan DP">Tagihan DP</option>
                                <option value="FPP">FPP</option>
                                <option value="Pengadaan">Pengadaan</option>
                                <option value="Running">Running</option>
                                <option value="Finish">Finish</option>
                                <option value="RETUR & BAST">RETUR & BAST </option>
                                <option value="Invoice">Invoice</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Time Schedule">Time Schedule</option>
                            </select>
                        </div>
                        <input type="hidden" class="id_edit" name="id">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control edit_tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <input type="text" class="form-control edit_pic" name="pic">
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
            $("#button-logout").click(function() {
                Swal.fire({
                    title: 'Logout?',
                    text: "Anda akan keluar dari aplikasi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#logout-form").submit();
                    }
                });
                $(this).removeClass('active')
            });
            $('#form_store_mading').submit(function(e) {
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

            function createBadge(optionValue) {
                let badgeClass = "bg-light-primary text-primary";
                switch (optionValue) {
                    case 'Tagihan DP':
                        badgeClass = "bg-warning ";
                        break;
                    case 'FPP':
                        badgeClass = "bg-info ";
                        break;
                    case 'Pengadaan':
                        badgeClass = "bg-success ";
                        break;
                    case 'Running':
                        badgeClass = "bg-secondary ";
                        break;
                    case 'Finish':
                        badgeClass = "bg-danger ";
                        break;
                    case 'RETUR & BAST':
                        badgeClass = "bg-primary ";
                        break;
                    case 'Invoice':
                        badgeClass = "bg-dark ";
                        break;
                    case 'Lunas':
                        badgeClass = "bg-success ";
                        break;
                }

                return `<span class="badge ${badgeClass} rounded-3 py-2 fw-semibold d-inline-flex align-items-center gap-1">
                        <i class="ti ti-circle fs-4"></i>${optionValue}
                    </span>`;
            }

            function formatDate(date, row, index) {
                let tgl = new Date(date)
                return new Intl.DateTimeFormat('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }).format(tgl);
            }

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
                    data: 'id'
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
                    targets: [5],
                    data: 'tanggal',
                    render: function(data, type, full, meta) {
                        return formatDate(new Date(data))
                    }
                },
                // {
                //     targets: [4],
                //     render: function(data, type, full, meta) {
                //         return createBadge(data)
                //     }
                // },
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
                                    href="#deleteData" data-delete-url="/admin-mading/${data}" 
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
                $('.edit_project_owner').val(button.data('project_owner'));
                $('.edit_work_location').val(button.data('work_location'));
                $('.edit_type_of_work').val(button.data('type_of_work'));
                $('.edit_status').val(button.data('status'));
                $('.edit_tanggal').val(button.data('tanggal'));
                $('.edit_pic').val(button.data('pic'));
            });
        });
    </script>
@endpush
