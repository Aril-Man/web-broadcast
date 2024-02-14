@extends('layouts.client.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Broadcast Ready</h5>
                    <p class="card-text">Jumlah: <strong>{{ $data->campaignReady }} Broadcast</strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Broadcast Prepare</h5>
                    <p class="card-text">Jumlah: <strong>{{ $data->campaignPrepare }} Broadcast</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection
