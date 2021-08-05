@extends('dosen.layout')

@section('title')
Daftar Bimbingan Mahasiswa
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
                        <li class="breadcrumb-item"><a href="{{ route('dospem.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Bimbingan Mahasiswa</li>
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
                <table class="table table-valign-middle">
                    <thead>
                        <tr>
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Asal</th>
                            <th class="text-center">Jurusan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($data as $mhs)
                        <tr class="@if (isset($arrFeedback[$mhs->mhs_id])) table-secondary @endif">
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $mhs->nama_mhs }}</td>
                            <td class="text-center">Departemen {{ $mhs->depart['nama_depart'] }}</td>
                            <td class="text-center">{{ $mhs->jurusan['jurusan'] }}</td>
                            <td class="text-center">
                                @if ($mhs->approval == 1)
                                    <label class="badge badge-success">Magang</label>
                                @elseif ($mhs->approval == 3 )
                                    <label class="badge badge-danger">Selesai</label>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('dospem.bimbingan', $mhs->mhs_id) }}" class="btn btn-primary">Lihat</a>
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