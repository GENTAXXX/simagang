@extends('depart.layout')

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
                <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ $user }}</h3>

                    <p>Akun dibuat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-crwat"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-fuchsia">
                <div class="inner">
                    <h3>{{ $mitra }}</h3>

                    <p>Jumlah Mitra</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-navy">
                <div class="inner">
                    <h3>{{ $spv }}</h3>

                    <p>Jumlah Supervisor</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $dosen }}</h3>

                    <p>Jumlah Dosen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $mhs }}</h3>

                    <p>Jumlah Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $mhsMag }}</h3>

                    <p>Mahasiswa Magang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
                <a href="{{ route('depart.mhs') }}" class="small-box-footer">
                    Lihat<i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $count }}</h3>

                    <p>Mahasiswa Mengajukan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation"></i>
                </div>
                <a href="{{ route('pengajuan.index') }}" class="small-box-footer">
                    lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $blmMag }}</h3>

                    <p>Belum Magang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times"></i>
                </div>
                <a href="{{ route('depart.mhs') }}" class="small-box-footer">
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