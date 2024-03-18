@extends('layout.main')
@section('content')
<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
            @if (Session('success'))
        <div style="width: 100%; padding: 10px">
        <ul class="alert alert-success" role="alert">{{ session('success') }}</ul>
        </div>
        @endif

        @if ($errors->any)
        <ul style="width: 100%; padding: 10px; text-decoration: none;" class="alert" role="alert">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
        @endif

              <h5 class="card-title fw-semibold mb-4">Forms</h5>
              <div class="card">
                <div class="card-body">
                  <form action="/add" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="mb-3">
                      <label for="minggu" class="form-label">Minggu Ke- </label>
                      <input type="number" class="form-control" id="minggu" name="minggu" required>
                    </div>
                    <div class="mb-3">
                      <label for="materi" class="form-label">Materi</label>
                      <input type="file" class="form-control" id="materi" name="materi" required>
                    </div>
                    <div class="mb-3">
                      <label for="lkpd" class="form-label">LKPD</label>
                      <input type="file" class="form-control" id="lkpd" name="lkpd" accept="pdf" required>
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