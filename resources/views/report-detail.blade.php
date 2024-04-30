@extends('layout.main')
@section('content')

<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="box">
                    <h6>Identitas</h6>
                    <p>NIS: {{ $user->nis }}</p>
                    <p>Nama: {{ $user->name }}</p>
                    <p>Rombel: {{ $user->rombel }}</p>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Minggu</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Keterangan</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lesson as $lsn)
                            <tr>
                                <td>{{ $lsn->minggu }}</td>
                                <td>
                                    @php
                                    // Cari nilai untuk jawaban yang sedang dilihat pada minggu ini
                                    $grade = $details->firstWhere('lesson_id', $lsn->id);
                                    @endphp
                                    @if($grade)
                                        {{ $grade->grade }} {{-- Menampilkan nilai --}}
                                    @elseif($answer)
                                        Belum dinilai
                                    @else
                                        Belum dikerjakan
                                    @endif
                                </td>
                                <td>
                                    @if($grade)
                                        Sudah dinilai
                                    @else
                                        <a href="/nilai/{{ $answer->id }}" class="btn btn-primary">Nilai</a>
                                    @endif
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
