<div class="modal fade" id="modal_edit_client" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Update Client</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="client_id" id="client_id" value="">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control value="">
                </div>
                <div class=" form-group mt-4">
                    <label>Email</label>
                    <input type="email" name="email" id="email" onchange="changeEmail()" class="form-control value="">
                    <input type="hidden" name="is_email" id="is_email" value="">
                </div>
                <div class="form-group mt-4">
                    <label>Quota</label>
                    <input type="text" name="qty" id="qty" class="form-control value="">
                </div>
            </div>
            <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateProfile()">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function changeEmail() {
            document.getElementById('is_email').value = true;
        }

        function updateProfile() {
            const url = `{{ route('admin.client.update') }}`;
            let data = {
                'client_id': $('#client_id').val(),
                'name': $('#name').val(),
                'email': $('#email').val(),
                'qty': $('#qty').val(),
                'isEmail': $('#is_email').val() ?? ""
            }

            console.log(data);

            $.ajax({
                url: url,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function (result) {
                    if (result == 1) {
                        Swal.fire({
                            title: "Successfully!",
                            text: "Client Updated Successfully!",
                            icon: "success",
                            confirmButtonText: 'Oke'
                        }).then((result) => {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: result,
                        });
                    }
                }
            })
        }

    </script>
