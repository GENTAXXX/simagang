@extends('dosen.layout')

@section('title')
Dashboard
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beranda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Beranda</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content ">
        <div class="container ">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $mhsBim }}</h3>

                        <p>Mahasiswa bimbingan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{ route('dospem.index') }}" class="small-box-footer">
                        Lihat <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $feedback }}</h3>

                        <p>Bimbingan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="{{ route('dospem.index') }}" class="small-box-footer">
                        Lihat<i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
@endsection