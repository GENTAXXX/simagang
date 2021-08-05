@extends('dosen.layout')

@section('title')
Detail Bimbingan Mahasiswa
@endsection

@section('konteng')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Bimbingan Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Daftar Bimbingan Mahasiswa</li>
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

                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Detail Magang</h3>
                        </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Lokasi</th>
                                        <th>Lowongan Diambil</th>
                                        <th>Status</th>
                                        <th>Waktu</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $mag->nama_mitra }}</td>
                                        <td>{{ $mag->nama_low }} </td>
                                        <td>
                                            @if ($mag->status_id == 1)
                                                <label class="badge badge-warning">Belum Magang</label>
                                            @elseif ($mag->status_id == 2)
                                                <label class="badge badge-success">Sedang Magang</label>
                                            @elseif ($mag->status_id == 3)
                                                <label class="badge badge-danger">Sudah Magang</label>
                                            @endif
                                        </td>
                                        <td>{{ $mag->durasi }}</td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Bimbingan </h3>
                    </div>
                    <div class="card-body p-6">
                        <div class="table-responsive">
                            <table id="bimbingan" class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                        <th>Catatan</th>
                                        <th>Berkas lampiran</th>
                                        <th>Feedback</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($data as $bim)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $bim->tgl_bimbingan }}</td>
                                        <td>{{ $bim->catatan }}</td>
                                        <td>
                                            <a href="{{ asset('file/'.$bim->file) }}" class="btn btn-primary btn-file">Unduh</a> 
                                        </td>
                                        <td>{{ $bim->feedback }}</td>
                                        <td>
                                            @if (!isset($data->feedback))
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter-{{ $bim->bim_id }}" data-id="{{ $bim->bim_id }}">Unggah</button>
                                            @endif
                                            <div class="modal fade" id="exampleModalCenter-{{ $bim->bim_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="card card-primary">
                                                            <div class="card-header border-transparent">
                                                                <h3 class="card-title">Input Feedback</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button> 
                                                            </div>
                                                            <div class="card-body p-0">
                                                                <form action="{{ route('dospem.feedback', $bim->bim_id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label for="feedback">Catatan</label>
                                                                            <input type="text" name="feedback" class="form-control" placeholder="Catatan">
                                                                            <input type="hidden" name="mhs_id" value="{{ $mhs->id }}">
                                                                        </div>
                                                                    <!-- <div class="form-group">
                                                                        <label for="feedback">File input</label>
                                                                        <div class="input-group">
                                                                        <div class="custom-file">
                                                                            <input type="file" name="feedback" class="custom-file-input" id="feedback">
                                                                            <label class="custom-file-label" for="feedback">Choose file</label>
                                                                        </div>
                                                                        </div>
                                                                    </div> -->
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready( function () {
    $('#bimbingan').DataTable();
} );
</script>
@endsection