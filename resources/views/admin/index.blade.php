@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Broadcast Ready</h5>
                    <p class="card-text">Jumlah: <strong>100 Dosen</strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Broadcast Prepare</h5>
                    <p class="card-text">Jumlah: <strong>100 Broadcast</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection
