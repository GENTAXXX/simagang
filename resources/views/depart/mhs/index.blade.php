@extends('depart.layout')

@section('title')
Daftar Mahasiswa
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="profile-departemen.html">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Mahasiswa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- TABLE: PROPOSAL -->
    <section class="content">
        <div class="card">

            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Jurusan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($mhs as $mhs)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $mhs->nama_mhs }}</td>
                            <td class="text-center">{{ $mhs->NIM }}</td>
                            <td class="text-center">@if(isset($mhs->jurusan['jurusan'])) {{ $mhs->jurusan['jurusan'] }}  @endif</td>
                            <td class="text-center">
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
                            <td class="text-center">
                                <a href="{{ route('depart.detailMhs', $mhs->id) }}" class="btn btn-primary"> Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection