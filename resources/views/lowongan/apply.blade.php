@extends('mhs.layout')

@section('title')
Pengajuan Lowongan
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Lowongan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan Lowongan</li>
                    </ol>
                </div>
            </div>Id
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    @if ($button == 'disabled')
        <div class="alert alert-danger text-center">
            <strong>Perhatian!</strong> Kamu harus <a href="{{ url('profile') }}" class="alert-link">lengkapi data diri</a>.
        </div>
    @elseif ($button == 'enable')
        <div class="alert alert-success text-center">
            Silahkan melanjutkan pengajuan.
        </div>
    @endif
    <section class="content ">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <form action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/'.$mhsId->foto_mhs) }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $mhsId->nama_mhs }}</h3>

                                <p class="text-muted text-center">Software Engineer</p>
                                <strong><i class="fas fa-book mr-1"></i> NIM</strong>

                                <p class="text-muted">{{ $mhsId->NIM }}</p>

                                <hr>

                                <strong><i class="fas fa-mail-bulk mr-1"></i> Telepon</strong>

                                <p class="text-muted">{{ $mhsId->telepon_mhs }}</p>

                                <hr>

                                <strong><i class="fas fa-mail-bulk mr-1"></i> Pengalaman</strong>

                                <p class="text-muted">{{ $mhsId->pengalaman }}</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Jurusan</strong>

                                <p class="text-muted"> {{ $mhsId->jurusan['jurusan'] }}
                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Skill</strong>

                                @foreach ($skill as $s)
                                    <p class="text-muted">{{ $s->skill }}</p>
                                @endforeach

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Jenis Kelamin</strong>

                                <p class="text-muted">{{ $mhsId->jenis_kelamin }}</p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Tanggal Lahir</strong>

                                <p class="text-muted">{{ $mhsId->tgl_lahir }}</p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Lowongan Dipilih</strong>

                                <p class="text-muted">{{ $low->nama_low }}</p>
                                <input type="hidden" class="form-control" name="mhs_id" value="{{ $mhsId->id }}"/>
                                <input type="hidden" class="form-control" name="lowongan_id" value="{{ $low->id }}"/>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-5 ">
                                    <a href="{{ route('mahasiswa.home') }}">
                                        <button type="submit" class="btn btn-danger" {{ $button }}>Ajukan</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection