@extends('spv.layout')

@section('title')
List Logbook Mahasiswa
@endsection

@section('logbookMhs')
active
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
                        <li class="breadcrumb-item active">User Profile</li>
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
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Asal</th>
                            <th class="text-center">Lowongan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($data as $mhs)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $mhs->nama_mhs }}</td>
                            <td class="text-center">{{ $mhs->depart['nama_depart'] }}</td>
                            <td class="text-center">{{ $mhs->nama_low }}</td>
                            <td class="text-center">
                                @if ($mhs->approval == 1)
                                    <label class="badge badge-primary">Magang</label>
                                @elseif ($mhs->approval == 3 )
                                    <label class="badge badge-danger">Selesai</label>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('spv.logbook', $mhs->mhs_id) }}" class="btn btn-primary">Lihat</a>
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