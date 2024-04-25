@extends('layout.userpage')
@section('content')

<div class="container-fluid">
<div class="col-sm-6 col-xl-3">
@if (Session('success'))
        <div style="width: 100%; padding: 10px">
        <ul class="alert alert-success" role="alert">{{ session('success') }}</ul>
        </div>
        @endif
@foreach($tasks as $task)
            <div class="card overflow-hidden rounded-2" >
              <div class="position-relative">
                <a href="/lesson/{{$task->id}}"><img src="../assets/images/olr.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="/lesson/{{$task->id}}" class="bg-primary text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"></a>                      </div>
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Minggu {{$task->minggu ?? '-'}}</h6>
  
              </div>
            </div>
            @endforeach
          </div>
</div>
@endsection