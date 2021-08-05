@extends('mitra.layout')

@section('title')
List Mahasiswa Magang
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Mahasiswa Magang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Mahasiswa Magang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- TABLE: PROPOSAL -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">List Mahasiswa Magang</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Nama Mahasiswa</th>
                                    <th class="text-center">Departemen</th>
                                    <th class="text-center">Nama Lowongan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($data as $data)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</a></td>
                                    <td class="text-center">{{ $data->nama_mhs }}</td>
                                    <td class="text-center">{{ $data->mahasiswa->depart['nama_depart'] }}</td>
                                    <td class="text-center">{{ $data->nama_low }}</td>
                                    <td class="text-center">
                                        @if ($data->approval == 1 && $data->tgl_selesai >= $todayDate )
                                            <label class="badge badge-success">Magang</label>
                                        @elseif ($data->approval == 1 && $data->tgl_selesai <= $todayDate )
                                            <label class="badge badge-warning">Kadaluarsa</label>
                                        @elseif ($data->approval == 3 )
                                            <label class="badge badge-danger">Selesai</label>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('magang.show', $data->magang_id) }}" class="btn btn-primary">Lihat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection