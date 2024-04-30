@extends('layout.main')
@section('content')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Laporan Nilai Siswa</h5>
                @if (Session('success'))
                <div style="width: 100%; padding: 10px">
                    <ul class="alert alert-success" role="alert">{{ session('success') }}</ul>
                </div>
                @endif
                @if (Session('back'))
                <div style="width: 100%; padding: 10px">
                    <ul class="alert alert-danger" role="alert">{{ session('back') }}</ul>
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
                                    <h6 class="fw-semibold mb-0">Keterangan</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $data)
                            <tr>
                                <td>{{$data->nis}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->rombel}}</td>
                                <td>
                                <a href="/report_detail/{{$data->id}}" class="btn btn-primary">Detail</a>
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