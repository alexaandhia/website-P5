@extends('layout.main')
@section('content')

<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
          <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Daftar Akun Siswa</h5>
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
                          <h6 class="fw-semibold mb-0">Keterangan</h6>
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