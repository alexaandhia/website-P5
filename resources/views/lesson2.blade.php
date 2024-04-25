@extends('layout.userpage')
@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Materi</title>
  <style>
    .row {
    display: flex;
    flex-wrap: wrap;
}

#videoPlayer {
    flex: 1;
    margin-right: 10px; /* optional spacing between video/iframe and lkpd iframe */
}

iframe {
    flex: 1;
    width: calc(50% - 10px); /* Adjust width as needed */
    box-sizing: border-box;
    border: 1px solid #ccc; /* optional border */
    margin-right: 10px; /* optional spacing between video/iframe and lkpd iframe */
}

#videoPlayer iframe {
    width: 100%; /* Adjust width as needed */
}

  </style>
</head>
<body>

<div class="container-fluid">
    <div class="row mb-3">
    <h1>Materi Minggu: {{$lessons->minggu}}</h1>
    <div id="videoPlayer">
        @if (pathinfo($lessons->materi, PATHINFO_EXTENSION) === 'mp4')
            <video id="myVideo" width="400px" controls >
                <source src="../assets/materi/{{$lessons->materi}}" type="video/mp4" id="markSuccessBtn">
                Your browser does not support HTML5 video.
            </video>
        @else
            <iframe src="../assets/materi/{{$lessons->materi}}" title="materi" class="p-3" width="400px" height="300px"></iframe>
        @endif
        <a href="../assets/materi/{{$lessons->materi}}" target="_blank">see materi full size</a>
    </div>
    <iframe src="../assets/lkpd/{{$lessons->lkpd}}" title="materi" class="p-3"></iframe>
    <a href="../assets/materi/{{$lessons->lkpd}}" target="_blank">see lkpd full size</a>
    </div>

    <form action="{{ route('answer', ['lesson_id' => $lesson_id, 'user_id' => $user_id]) }}" method="POST">
    @csrf
    <h2>Kesimpulan dan Jawaban</h2>
    <div class="mb-3">
        <label for="kesimpulan" class="form-label">Kesimpulan Materi</label>
        <textarea class="form-control" name="kesimpulan" id="kesimpulan" style="height: 100px" placeholder="Masukkan kesimpulan dari materi ini"></textarea>
    </div>
    <div class="mb-3">
        <label for="jawaban" class="form-label">Jawaban LKPD</label>
        <textarea class="form-control" name="jawaban" id="jawaban" style="height: 300px" placeholder="Masukkan Jawaban LKPD"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

<!-- <script>
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

</script> -->
</body>


@endsection
