@extends('mhs.layout')

@section('title')
Logbook
@endsection

@section('konteng')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Log Book</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Log Book</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Informasi Lowongan</h3>
                </div>
            <!-- /.card-header -->
                <div class="card-body">
                    <div class="row m-3" >
                        <div class="col-sm-2">
                            <a href="detail-lowongan.html">
                            <img src="{{ asset('assets/img/sim-vertical-black.png') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0">
                            <h3></h3>
                            <ul class="list-unstyled ">
                                <span>
                                    <li class="d-flex align-items-start m-3"><span><img src="{{ asset('assets/img/building.svg') }}" alt="" style="height: 20px;width: 20px;" class=""></span><span class="ml-3">{{ $low->nama_low }}</span></li>
                                </span>
                                <span>
                                    <li class="d-flex align-items-start m-3"><span><img src="{{ asset('assets/img/placeholder.svg') }}" alt="" style="height: 20px;width: 20px;"></span><span class="ml-3">{{ $low->lokasi }}</span></li>
                                </span>
                                <span>
                                    <li class="d-flex align-items-start m-3"><span><img src="{{ asset('assets/img/filter.svg') }}" alt="" style="height: 20px;width: 20px;"></span><span class="ml-3">{{ $low->kategori['kategori']}}</span></li>
                                </span>  
                            </ul>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            </div>
        </div>
    </section>
  <!-- TABLE: PROPOSAL -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Kegiatan Dilaksanakan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-6">
                    <div class="table-responsive">
                        <table id="logbook" class="table m-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Kegiatan</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Saran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($logs as $log)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</a></td>
                                    <td class="text-center">{{ $log['tanggal'] }}</td>
                                    <td class="text-center">{{ $log['kegiatan'] }}</td>
                                    <td class="text-center">{{ $log['deskripsi_log'] }}</td>
                                    <td class="text-center">{{ $log['saran'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Tambah Logbook</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <form action="{{ route('logbook.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>
                            <div class="form-group">
                                <label for="kegiatan">Kegiatan</label>
                                <input type="text" class="form-control" id="kegiatan" placeholder="Kegiatan" name="kegiatan">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_log">Deskripsi</label>
                                <textarea name="deskripsi_log" id="deskripsi_log" class="form-control" placeholder="Deskripsi Kegiatan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="saran">Saran</label>
                                <input type="text" class="form-control" id="saran" name="saran" placeholder="Saran">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <a class="btn btn-success" href="{{ route('logbook.print') }}">Print PDF</a>
        </div>
    </section>
</div>
<script>
$(document).ready( function () {
    $('#logbook').DataTable();
} );
</script>
@endsection