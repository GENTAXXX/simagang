@extends('depart.layout')

@section('title')
Detail Mahasiswa
@endsection

@section('konteng')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detail Mahasiswa</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('images/'.$mhs->foto_mhs) }}"
                                alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $mhs->nama_mhs }}</h3>

                            <p class="text-muted text-center">{{ $mhs->depart['nama_depart'] }}</p>
                            <strong><i class="fas fa-book mr-1"></i> NIM</strong>

                            <p class="text-muted">{{ $mhs->NIM }}</p>

                            <hr>

                            <strong><i class="fas fa-mail-bulk mr-1"></i> Telepon</strong>

                            <p class="text-muted">{{ $mhs->telepon_mhs }}</p>

                            <hr>

                            <strong><i class="fas fa-mail-bulk mr-1"></i> Pengalaman</strong>

                            <p class="text-muted">{{ $mhs->pengalaman }}</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Jurusan</strong>

                            <p class="text-muted"> {{ $mhs->jurusan['jurusan'] }}
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Skill</strong>

                            @foreach ($skill as $s)
                            <p class="text-muted">{{ $s->skill }}</p>
                            @endforeach

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Jenis Kelamin</strong>

                            <p class="text-muted">{{ $mhs->jenis_kelamin }}</p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Tanggal Lahir</strong>

                            <p class="text-muted">{{ $mhs->tgl_lahir }}</p>
                        </div>
                    </div>
                </div>
                <div class="card col-md-9">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Lamaran Diajukan</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr class="row">
                                        <th class="col-2">Nomor</th>
                                        <th class="col-4">Melamar</th>
                                        <th class="col-4">Asal</th>
                                        <th class="col-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row">
                                        <td class="col-2">1</td>
                                        <td class="col-4">{{ $data->nama_low }}</td>
                                        <td class="col-4">{{ $mhs->jurusan['jurusan'] }}</td>
                                        <td class="col-2">
                                        @if ($mhs->status_id == 1)
                                            <label class="badge">Belum Magang</label>
                                        @elseif ($mhs->status_id == 2)
                                            <label class="badge badge-success">Sedang Magang</label>
                                        @elseif ($mhs->status_id == 3)
                                            <label class="badge badge-danger">Sudah Magang</label>
                                        @elseif ($mhs->status_id == 4)
                                            <label class="badge badge-warning">Sedang Mengajukan</label>
                                        @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection