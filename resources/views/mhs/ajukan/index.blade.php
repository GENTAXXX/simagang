@extends('mhs.layout')

@section('title')
Lowongan Diajukan
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lowongan Diajukan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lowongan Diajukan</li>
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
                    <h3 class="card-title">Lowongan Diajukan</h3>
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
                                    <th class="text-center">Lowongan</th>
                                    <th class="text-center">Mitra</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($data as $data)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</a></td>
                                    <td class="text-center">{{ $data->nama_low }}</td>
                                    <td class="text-center">{{ $data->lowongan->mitra['nama_mitra'] }}</td>
                                    <td class="text-center">
                                        @if ($data->approval == 1)
                                            <label class="badge badge-success">Diterima</label>
                                        @elseif ($data->approval == 2)
                                            <label class="badge badge-danger">Ditolak</label>
                                        @elseif ($data->approval == 3)
                                            <label class="badge badge-danger">Selesai</label>
                                        @elseif ($data->approval == 'null')
                                            <label class="badge badge-warning">Menunggu</label>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('mitra/pendaftar', $data->magang_id) }}" class="btn btn-primary">Lihat</a>
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