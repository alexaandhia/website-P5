@extends('layout.userpage')
@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dua Kolom</title>
  <style>
    /* Styles di sini */
  </style>
</head>
<body>

<div class="container">
    <h1>Materi Minggu: {{$lessons->minggu}}</h1>
    <h2>Materi Minggu: {{$lessons->minggu}}</h2>
    <div id="videoPlayer">
        @if (pathinfo($lessons->materi, PATHINFO_EXTENSION) === 'mp4')
            <video id="myVideo" width="400px" controls onended="restartVideo()">
                <source src="../assets/materi/{{$lessons->materi}}" type="video/mp4" id="markSuccessBtn">
                Your browser does not support HTML5 video.
            </video>
        @else
            <iframe src="../assets/materi/{{$lessons->materi}}" title="materi" class="p-3" width="400px" height="300px"></iframe>
        @endif
        <form id="kesimpulanForm" action="/answer/{{ $lessons->id }}" method="POST">
    @csrf
    <textarea name="kesimpulan" id="kesimpulan" cols="40" rows="10" placeholder="Masukkan Kesimpulan"></textarea>
    <button id="submitButton" type="button" class="btn btn-outline-primary">Submit</button>
</form>

    </div>
    <div id="successMessage" style="display:none">
        <p style="padding-left: 50px;">Congratulations! You have successfully completed the video.</p>
        <iframe src="../assets/lkpd/{{$lessons->lkpd}}" title="materi" class="p-3"></iframe>

        <form action="/answer/{{ $lessons->id }}" method="POST">
            @csrf
        <textarea name="jawaban" id="jawaban" cols="40" rows="10" placeholder="Masukkan Jawaban"></textarea>
        <button id="" type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('kesimpulanForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah perilaku bawaan form
    var kesimpulan = document.getElementById('kesimpulan').value;
    var jawaban = document.getElementById('jawaban').value;
    
    var xhr = new XMLHttpRequest();
    var lesson_id = "{{ $lessons->id }}"; // Mendapatkan lesson_id dari Blade template
    var url = 'http://127.0.0.1:8000/answer/' + lesson_id; // Membuat URL dengan lesson_id
    
    xhr.open('POST', url, true); // Menggunakan URL yang telah dibuat
    xhr.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Data berhasil disimpan');
            document.getElementById('videoPlayer').style.display = 'none';
            document.getElementById('successMessage').style.display = 'block';
        } else {
            console.log('Gagal menyimpan data:', xhr.statusText);
            // Tambahkan logika lainnya untuk penanganan kesalahan
        }
    };
    xhr.send(JSON.stringify({ kesimpulan: kesimpulan, jawaban: jawaban }));
});

</script>



@endsection
