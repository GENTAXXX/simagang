@extends('mitra.layout')

@section('title')
Home
@endsection

@section('konteng')
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
                        <li class="breadcrumb-item"><a href="{{ route('mitra.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content ">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/'.$mitra->foto_mitra) }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $mitra->nama_mitra }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                            <strong><i class="fas fa-book mr-1"></i> Alamat</strong>

                            <p class="text-muted">{{ $mitra->alamat_mitra }}</p>

                            <hr>

                            <strong><i class="fas fa-mail-bulk mr-1"></i> Telepon</strong>

                            <p class="text-muted">{{ $mitra->telepon_mitra }}</p>

                            <hr>

                            <strong><i class="fas fa-mail-bulk mr-1"></i> Fax</strong>

                            <p class="text-muted">{{ $mitra->fax_mitra }}</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Kabupaten</strong>

                            <p class="text-muted"> {{ $mitra->kabupaten['nama'] }}
                            </p>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-5 ">
                                <a class="btn btn-danger" href="{{ route('profile.edit', $mitra->id) }}">
                                    Ubah
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection