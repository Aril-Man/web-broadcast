@extends('layouts.admin.app')
@section('head')
@section('title', 'List All Campaign')
@section('content')
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body alert-dismissible fade show" role="alert">
                        <div class="alert-title">Failed</div>
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mt-2" id="data">
                                    @if (count($data->campaigns) > 0)
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Client Name</th>
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->campaigns as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->client_name }}</td>
                                            <td>{{ Str::substr($row->content, 0, 50) . '...' }}</td>
                                            <td class="text-center">
                                                @if ($row->status == 'ready')
                                                <div class="btn btn-warning fw-bolder">
                                                    {{ ucfirst($row->status) }}
                                                </div>
                                                @elseif ($row->status == 'prepare')
                                                <div class="btn btn-primary fw-bolder">
                                                    {{ ucfirst($row->status) }}
                                                </div>
                                                @elseif ($row->status == 'done')
                                                <div class="btn btn-success fw-bolder">
                                                    {{ ucfirst('in progress') }}
                                                </div>
                                                @else
                                                <div class="btn btn-info fw-bolder">
                                                    {{ ucfirst($row->status) }}
                                                </div>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                @if ($row->status == 'ready')
                                                <button class="btn btn-success">Process</button>
                                                @else
                                                -
                                                @endif
                                            </td>
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
    $(document).ready(function () {
        $('#data').DataTable();
    });

    function openModal() {

    }

</script>
@endsection
