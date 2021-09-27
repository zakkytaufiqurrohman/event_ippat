@extends('layouts.app')

@section('top-script')
@endsection
@section('title','Dashboard')
@section('body')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Admin</h4>
                </div>
                <div class="card-body">
                    {{$admin}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pendaftar</h4>
                </div>
                <div class="card-body">
                    {{$pendaftar}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Peserta</h4>
                </div>
                <div class="card-body">
                    {{$peserta}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection