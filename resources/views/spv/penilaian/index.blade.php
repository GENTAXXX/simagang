@extends('spv.layout')

@section('title')
List Logbook Mahasiswa
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="profile-departemen.html">Home</a></li>
                        <li class="breadcrumb-item active">Penilaian</li>
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
            <div class="card-body table-responsive p-6">
                <table id="penilaian" class="table m-0">
                    <thead>
                        <tr>
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Asal</th>
                            <th class="text-center">Lowongan</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($data as $mhs)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $mhs->nama_mhs }}</td>
                            <td class="text-center">{{ $mhs->mahasiswa->depart['nama_depart'] }}</td>
                            <td class="text-center">{{ $mhs->nama_low }}</td>
                            <td class="text-center">{{ $mhs->nilai }}</td>
                            <td class="text-center">{{ $mhs->keterangan }}</td>
                            <td class="text-center">
                                @if (!isset($mhs->keterangan) && !isset($mhs->nilai))
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter-{{ $mhs->mag_id }}" data-id="{{  $mhs->mag_id }}">Nilai</button>
                                @endif
                                    <div class="modal fade" id="exampleModalCenter-{{ $mhs->mag_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="card card-primary">
                                                    <div class="card-header border-transparent">
                                                        <h3 class="card-title">Masukan Penilaian</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <form action="{{ route('spv.score', $mhs->mag_id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="nilai">Nilai</label>
                                                                    <input type="number" name="nilai" class="form-control" placeholder="Nilai">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="keterangan">Keterangan</label>
                                                                    <textarea class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                                                                </div>
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
    </section>
</div>
<script>
$(document).ready( function () {
    $('#penilaian').DataTable();
} );
</script>
@endsection