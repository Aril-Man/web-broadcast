@extends('layouts.admin.app')
@section('head')
@section('title', 'List All Client')
@section('content')
    @include('admin.client.modal.create_client')
    @include('admin.client.modal.edit_client')
    <section class="section">
        <div class="section-header">
            <h1>List All Client</h1>
        </div>

        <div class="row mt-5">
            <div class="col-lg-15 col-md-12 col-12 col-sm-12">
                <div class="card">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-has-icon">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body alert-dismissible fade show" role="alert">
                                <div class="alert-title">Success</div>
                                @php
                                    $msg = explode("|",Session::get('success'));
                                @endphp
                                {{$msg[0]}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-has-icon">
                            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body alert-dismissible fade show" role="alert">
                                <div class="alert-title">Failed</div>
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                 <!-- Add Client button -->
                                <div class="d-flex justify-content-end mb-3">
                                    <a onclick="openModal()" class="btn btn-primary">Add Client</a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table mt-2" id="data">
                                        @if (count($data->clients) > 0)
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Quota</th>
                                                    <th>Email</th>
                                                    <th>Register Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->clients as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a class="text-info" style="cursor: pointer;" onclick="openModalEdit('{{ $row->id }}')">{{ $row->name }}</a>
                                                        </td>
                                                        <td>{{ number_format($row->quota, 0, ',', '.') }}</td>
                                                        <td>{{ $row->email }}</td>
                                                        <td>{{ $row->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @else
                                            <h4 class="text-center">Data Not Found</h4>
                                        @endif
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data').DataTable();
        });

        function openModal() {
            $('#create-client').trigger("reset");
            $('#modal_create_client').modal('show')
        }

        function openModalEdit(id) {
            $('#modal_edit_client').modal('show')

            const url = `{{ url('/admin/client' ) }}/${id}`

            $.ajax({
                url : url,
                type : 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function (result) {
                    $('#client_id').val(result.data.client.id);
                    $('#name').val(result.data.client.name);
                    $('#email').val(result.data.client.email);
                    $('#qty').val(result.data.client.quota);
                }
            })

        }

    </script>
@endsection
