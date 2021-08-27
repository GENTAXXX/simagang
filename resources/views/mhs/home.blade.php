@extends('mhs.layout')

@section('title')
Dashboard
@endsection

@section('konteng')
<!-- Content Wrapper. Contains page content -->
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
                        <h3>{{ $ajukan }}</h3>

                        <p>Lamaran diajukan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-arrow-alt-circle-up"></i>
                    </div>
                    <a href="{{ route('lowongan.diajukan') }}" class="small-box-footer">
                        Lihat <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
            <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $log }}</h3>

                        <p>Log Book diisi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{ route('logbook.index') }}" class="small-box-footer">
                        Lihat<i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
            <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $bim }}</h3>

                        <p>Bimbingan dilakukan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <a href="{{ route('bimbingan.index') }}" class="small-box-footer">
                        lihat <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
            <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        @if ($mhs->status_id == 1)
                            <h3>Belum Magang</h3>
                        @elseif ($mhs->status_id == 2)
                            <h3>Sedang Magang</h3>
                        @elseif ($mhs->status_id == 3)
                            <h3>Sedang Magang</h3>
                        @elseif ($mhs->status_id == 4)
                            <h3>Sedang Mengajukan</h3>
                        @endif

                        <p>Status Magang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-"></i>
                    </div>
                    <a href="{{ route('lowongan.diajukan') }}" class="small-box-footer">
                        Lihat <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
            <!-- ./col -->
            </div>
            <!-- /.col -->
            
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection