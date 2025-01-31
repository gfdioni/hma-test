@extends('dashboard.layouts.main')
@section('css')
@endsection
@section('section')
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ubah User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('user-management-update') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="user_fullname" value="{{ $user_fullname }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="user_email" value="{{ $user_email }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Nomer Telp</label>
                        <input type="text" id="phone_number" name="user_phone_number" value="{{ $user_phone_number }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmation Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success btn-sm">Update Data</button>
                        <a href="{{ route('user-management-index') }}" class="btn btn-warning btn-sm">Kembali</a>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
@section('js')
@endsection
