@extends('layout.main')
@section('content')

<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
          <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Rincian Materi P5</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Minggu</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Materi</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">LKPD</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Priority</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Keterangan</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{$task->minggu}}</td>
                            <td><a href="../assets/materi/{{$task->materi}}" target="_blank">{{$task->materi}}</td>
                            <td><a href="../assets/lkpd/{{$task->lkpd}}" target="_blank">{{$task->lkpd}}</td>
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