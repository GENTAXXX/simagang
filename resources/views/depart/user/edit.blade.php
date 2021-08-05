@extends('depart.layout')

@section('title')
Edit User
@endsection

@section('konteng')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buat User</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('depart.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
            <section>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Buat User</h3>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama User:</label>
                                <input type="text" class="form-control" name="name" autofocus value="{{ $user->name }}" />
                            </div>
                            <div class=" form-group">
                                <label>Email User:</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" />
                            </div>
                            <div class=" form-group">
                                <label>Role:</label>
                                <select class="form-control" name="role_id">
                                    <option value="">- Pilih Role -</option>
                                    @foreach ($role as $role)
                                    <option value="{{ $role->id }}" @if ($user->role_id == $role->id) selected @endif>{{ $role->role }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" value="{{ $user->password }}" />
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection