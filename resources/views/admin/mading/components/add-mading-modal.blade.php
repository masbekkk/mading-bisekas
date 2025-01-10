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
                        <label for="user_id" class="form-label">Project Owner</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
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
