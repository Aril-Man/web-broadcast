<div class="modal fade" id="modal_create_client" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.client.store') }}" id="create-client" class="needs-validation">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Create data client</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <div class="d-flex gap-2">
                            <label for="name">Name</label>
                            <div class="invalid-feedback">
                                Required Field
                            </div>
                        </div>
                        <input type="name" class="form-control" name="name" tabindex="1" required autofocus>
                    </div>
                    <div class="form-group mt-4">
                        <div class="d-flex gap-2">
                            <label for="email">Email</label>
                            <div class="invalid-feedback">
                                Required Field
                            </div>
                        </div>
                        <input type="email" class="form-control" name="email" tabindex="1" required
                            autofocus>
                    </div>
                    <div class="form-group mt-4">
                        <div class="d-flex gap-2">
                            <label for="qty">Qty quota</label>
                            <div class="invalid-feedback">
                                Required Field
                            </div>
                        </div>
                        <input type="number" min="1" class="form-control" name="qty" tabindex="1" required
                            autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
