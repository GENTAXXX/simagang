@extends('mhs.layout')

@section('title')
Bimbingan
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
                    <li class="breadcrumb-item active">Bimbingan</li>
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
                    <h3 class="card-title">Bimbingan Dilaksanakan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-6">
                    <div class="table-responsive">
                        <table id="logbook" class="table m-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Tanggal Bimbingan</th>
                                    <th class="text-center">Catatan</th>
                                    <th class="text-center">File Bimbingan</th>
                                    <th class="text-center">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($bimbingan as $log)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</a></td>
                                    <td class="text-center">{{ $log['tgl_bimbingan'] }}</td>
                                    <td class="text-center">{{ $log['catatan'] }}</td>
                                    <td class="text-center">{{ $log['file'] }}</td>
                                    <td class="text-center">{{ $log['feedback'] }}</td>
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
                    <h3 class="card-title">Tambah Bimbingan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <form action="{{ route('bimbingan.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tgl_bimbingan">Tanggal Bimbingan</label>
                                <input type="date" class="form-control" id="tgl_bimbingan" name="tgl_bimbingan">
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" id="catatan" placeholder="Catatan" name="catatan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">File Bimbingan</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready( function () {
    $('#logbook').DataTable();
} );
</script>
@endsection