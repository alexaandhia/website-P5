@extends('layout.main')
@section('content')

<div class="container-fluid">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Data Akun Siswa</h5>
        @if (Session('success'))
                <div style="width: 100%; padding: 10px">
                    <ul class="alert alert-success" role="alert">{{ session('success') }}</ul>
                </div>
        @endif
        <div class="mb-3">
                    <form action="" method="GET">
                        <input type="text" name="search" placeholder="Cari Nis" class="form-control" maxlength="20">
                        <button type="submit" class="btn btn-primary mt-2">Cari</button>
                    </form>
                </div>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">NIS</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Nama</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Rombel</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Email</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Action</h6>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($accounts as $acc)
              <tr>
                <td>{{$acc->nis}}</td>
                <td>{{$acc->name}}</td>
                <td>{{$acc->rombel}}</td>
                <td>{{$acc->email}}</td>
                <td>
                <a href="{{ route('edit.account', $acc->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                  <form action="{{ route('delete.account', $acc->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection