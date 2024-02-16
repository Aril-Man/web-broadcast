<div class="modal fade" id="modal_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="{{ route('client.campaign.store') }}" id="create-campaign" class="needs-validation">
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
                        <input id="name" type="text" class="form-control" name="name" tabindex="1" required autofocus>
                    </div>
                    <div class="form-group mt-4">
                        <div class="d-flex gap-2">
                            <label for="content">Content</label>
                            <div class="invalid-feedback">
                                Required Field
                            </div>
                        </div>
                        <textarea id="content" type="text" class="form-control" name="content" tabindex="1" required
                            autofocus cols="30" rows="10"></textarea>
                    </div> 
                    <div class="form-group mt-4">
                        <div class="d-flex gap-2">
                            <label for="file">File</label>
                            <div class="invalid-feedback">
                                Required Field
                            </div>
                        </div>
                        <input id="file" type="file" class="form-control" name="file" tabindex="1" required
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
