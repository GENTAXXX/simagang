@extends('mitra.layout')

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
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
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
                        <h3>{{ $mag }}</h3>

                        <p>Mahasiswa Magang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{ route('magang.index') }}" class="small-box-footer">
                        Lihat <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $low }}</h3>

                        <p>Lowongan dibuat</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="{{ route('lowongan.index') }}" class="small-box-footer">
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

                    <p>Pendaftar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-download"></i>
                </div>
                <a href="{{ route('pendaftar.index') }}" class="small-box-footer">
                    lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $full }}</h3>

                        <p>Lowongan terpenuhi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{ route('lowongan.index') }}" class="small-box-footer">
                        Lihat <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            </div>
            <!-- /.col -->
            
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
 <!-- /.content-wrapper -->
@endsection