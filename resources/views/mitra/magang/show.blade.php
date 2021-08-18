@extends('mitra.layout')

@section('title')
Detail Mahasiswa Magang
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mahasiswa Magang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="profile-departemen.html">Home</a></li>
              <li class="breadcrumb-item active">Mahasiswa Magang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/'.$mhs->foto_mhs) }}"alt="User profile picture">
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

                                    <p class="text-muted"> {{ $mhs->jurusan['jurusan'] }}</p>

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
                                <h3 class="card-title">Informasi Magang</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Lowongan</th>
                                                <th class="text-center">Deskripsi</th>
                                                <th class="text-center">Durasi</th>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $data->nama_low }}</td>
                                                <td class="text-center">{{ $data->deskripsi_low }}</td>
                                                <td class="text-center">{{ $data->durasi }}</td>
                                                <td class="text-center">{{ $data->nilai }}</td>
                                                <td class="text-center">{{ $data->keterangan }}</td>
                                                <td class="text-center">
                                                @if ($data->approval == 1 && $data->tgl_selesai >= $todayDate )
                                                    <label class="badge badge-success">Magang</label>
                                                @elseif ($data->approval == 1 && $data->tgl_selesai <= $todayDate )
                                                    <label class="badge badge-warning">Kadaluarsa</label>
                                                @elseif ($data->approval == 3 )
                                                    <label class="badge badge-danger">Selesai</label>
                                                @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('pendaftar.end', $data->magang_id) }}" method="POST">
                                        @csrf
                                        @if ($data->approval != 3)
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin mengakhiri magang ini?')"> Akhiri</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection