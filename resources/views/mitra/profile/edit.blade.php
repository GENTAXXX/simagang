@extends('mitra.layout')

@section('title')
Edit Profile
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">User Profile</li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <a class="nav-link" href="#settings" data-toggle="tab">Pengaturan</a>
                </div><!-- /.card-header -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal" action="{{ route('profile.update', $mitra->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" name="nama_mitra" value="{{ $mitra->nama_mitra }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat:</label>
                                        <textarea class="form-control" name="alamat_mitra">{{ $mitra->alamat_mitra }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="telepon">Telepon:</label>
                                        <input type="number" class="form-control" name="telepon_mitra" value="{{ $mitra->telepon_mitra }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="fax">Fax:</label>
                                        <input type="number" class="form-control" name="fax_mitra" value="{{ $mitra->fax_mitra }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="kab_id">Kabupaten:</label>
                                        <select class="form-control" name="kab_id">
                                            <option value="">- Pilih Kabupaten -</option>
                                            @foreach ($kabupatens as $kabupaten)
                                                    <option value="{{ $kabupaten->id }}" @if ($mitra->kab_id == $kabupaten->id) selected @endif>{{ $kabupaten->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto:</label>
                                        <input type="file" class="form-control" name="foto_mitra" value="{{ $mitra->foto_mitra }}" />
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection