@extends('layout.userpage')
@section('content')

<div class="container-fluid">
    <div class="row"> <!-- Kelompokkan card ke dalam satu baris -->
        @foreach($tasks as $task)
        <div class="col-md-4"> <!-- Kolom dengan ukuran yang sesuai -->
            <div class="card mb-3 overflow-hidden rounded-2" style="max-width: 540px;"> <!-- Atur lebar maksimum card -->
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="/lesson/{{$task->id}}"><img src="../assets/images/olr.jpg" class="img-fluid rounded-start" alt="..."></a>
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                            <h5 class="card-title">Minggu {{$task->minggu ?? '-'}}</h5>
                                <a href="/lesson/{{$task->id}}" class="btn btn-primary">Isi Tugas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection