<div class="modal fade edit-user" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_update_user" method="POST" data-modal="edit-user">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control edit_name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control edit_email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control edit_role" name="role">
                            <option value="admin">Admin</option>
                            <option value="approver">Approver</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <small  class="text-danger">*isi jika ganti password</small></label>
                        <input type="password" class="form-control edit_password" name="password">
                    </div>
                    <input type="hidden" class="id_edit" name="id">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
