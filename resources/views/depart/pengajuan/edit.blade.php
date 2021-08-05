@extends('depart.layout')

@section('title')
Edit Pengajuan
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengajuan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('depart.home') }}">Home</a></li>
              <li class="breadcrumb-item">Daftar Pengajuan</li>
              <li class="breadcrumb-item active">Pengajuan</li>
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
            <form action="{{ route('pengajuan.dospem', $data->magang_id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/'.$mhs->foto_mhs) }}" alt="User profile picture">
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
              <!-- /.card-body -->
            </div>
          
            <div class="card col-md-9">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Dosen Pembimbing</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="form-group">
                          <label>Dosen Pembimbing</label>
                          <select class="form-control" name="dosen_id">
                            <option value="">- Pilih Dosen -</option>
                            @foreach ($dosen as $dos)
                            <option value="{{ $dos->id }}">{{ $dos->nama_dosen }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                  <!-- /.card-body -->
          
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <div class="card-header border-transparent">
                <h3 class="card-title">Lowongan Diajukan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th class="text-center">Nama Mitra</th>
                      <th class="text-center">Nama Lowongan</th>                      
                      <th class="text-center">Deskripsi</th>
                      <th class="text-center">Lokasi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td class="text-center">{{ $data->nama_mitra }}</td>
                      <td class="text-center">{{ $data->nama_low }}</td>
                      <td class="text-center">{{ $data->deskripsi_low }}</td>
                      <td class="text-center">{{ $data->lokasi }}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</div>
<!-- /.content-wrapper -->
@endsection