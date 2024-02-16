@extends('layouts.client.app')
@section('head')
@section('title', 'List All Campaign')
@section('content')
    @include('client.campaign.modal.create')
    <section class="section">
        <div class="section-header">
            <h1>List All Campaign</h1>
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
                                 <!-- Add Campaign button -->
                                <div class="d-flex justify-content-end mb-3">
                                    <a onclick="openModal()" class="btn btn-primary">Add Campaign</a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table mt-2" id="data">
                                        @if (count($campaigns) > 0)
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Content</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($campaigns as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $row->name }}</td> 
                                                        <td>{{ $row->content }}</td>
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
            $('#create-campaign').trigger("reset");
            $('#modal_create').modal('show')
        }

    </script>
@endsection
