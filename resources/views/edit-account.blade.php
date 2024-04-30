@extends('layout.main')
@section('content')
<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
            @if (Session('success'))
        <div style="width: 100%; padding: 10px">
        <ul class="alert alert-success" role="alert">{{ session('successRegister') }}</ul>
        </div>
        @endif

        @if ($errors->any)
        <ul style="width: 100%; padding: 10px; text-decoration: none;" class="alert" role="alert">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
        @endif

              <h5 class="card-title fw-semibold mb-4">Edit Akun Siswa</h5>
              <div class="card">
                <div class="card-body">
                  <form action="{{ route('update.account', $account->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    @method('put')
                  <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" class="form-control" id="nama" name="name" required  value="{{ $account->name }}">
                    </div>
                  <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" required value="{{ $account->nis }}">
                    <label for="rombel" class="form-label">Rombel</label>
                    <input type="text" class="form-control" id="rombel" name="rombel" required value="{{ $account->rombel }}">
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="text" class="form-control" id="email" name="email" required value="{{ $account->email }}">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="text" class="form-control" id="password" name="password" required >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection