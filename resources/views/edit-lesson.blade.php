@extends('layout.main')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Materi</h5>
            <form action="{{ route('lesson.update', $lesson->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="minggu" class="form-label">Minggu</label>
                    <input type="text" class="form-control" id="minggu" name="minggu" value="{{ $lesson->minggu }}">
                </div>
                <div class="mb-3">
                    <label for="materi" class="form-label">Materi</label>
                    <input type="file" class="form-control" id="materi" name="materi">
                </div>
                <div class="mb-3">
                    <label for="lkpd" class="form-label">LKPD</label>
                    <input type="file" class="form-control" id="lkpd" name="lkpd">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
