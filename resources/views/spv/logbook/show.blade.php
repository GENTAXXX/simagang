@extends('spv.layout')

@section('title')
Detail Logbook Mahasiswa
@endsection

@section('konteng')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Logbook Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Daftar Logbook Mahasiswa</li>
                        <li class="breadcrumb-item active">Detail</li>
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

                            <p class="text-muted">{{ $mhs->skill['skill'] }}</p>

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
                        <h3 class="card-title">Log Book</h3>
                    </div>
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Kegiatan Dilaksanakan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-6">
                            <div class="table-responsive">
                                <table id="logbook" class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th>Keterangan</th>
                                            <th>Saran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($data as $log)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $log->tanggal }}</td>
                                            <td>{{ $log->kegiatan }}</td>
                                            <td>{{ $log->deskripsi_log }}</td>
                                            <td>{{ $log->saran }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready( function () {
    $('#logbook').DataTable();
} );
</script>
@endsection