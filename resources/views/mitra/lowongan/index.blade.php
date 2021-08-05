@extends('mitra.layout')

@section('title')
List Lowongan
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Lowongan</h1>
                    <a href="{{ route('lowongan.create') }}" class="nav-link">
                        <button type="submit" class="btn btn-primary">
                            Buat Lowongan
                        </button>
                    </a>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lowongan</li>
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
                    <h3 class="card-title">Lowongan Dibuat</h3>

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
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Lokasi</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($low as $low)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</a></td>
                                    <td class="text-center">{{ $low->nama_low }}</td>
                                    <td class="text-center">{{ $low->deskripsi_low }}</td>
                                    <td class="text-center">{{ $low->lokasi }}</td>
                                    <td class="text-center"><span>
                                            <form action="{{ route('lowongan.destroy', $low->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('lowongan.edit', $low->id) }}" class="btn btn-primary m-2">Ubah</a>
                                                <button type="submit" class="btn btn-danger m-2">Hapus</button>
                                        </span>
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