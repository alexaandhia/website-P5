@extends('layout.main')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiga Kotak Berdampingan</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin-top: 50px;
        }

        .box {
            flex: 1;
            margin: 0 10px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

        }

        .box label {
            display: block;
            margin-bottom: 10px;
        }

        .box textarea {
            width: 100%;
            height: 200px;
            resize: vertical;
        }

        .box input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color: #6fcedf;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #4562a0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h2>Penilaian Siswa</h2>
        <div class="container">
            @foreach($answers as $ans)
            @if($ans)
            <div class="box">
                <label for="detail">Detail</label>
                <p>NIS: {{$ans->user->nis}}</p>
                <p>Nama: {{$ans->user->name}}</p>
                <p>Rombel: {{$ans->user->rombel}}</p>
                <p>Jawaban Minggu ke : {{$ans->lesson->minggu}}</p>
            </div>
            <div class="box">
                <label for="jawaban">Jawaban</label>
                <p>{{$ans->jawaban}}</p>
            </div>
            <div class="box">
                <label for="kesimpulan">Kesimpulan</label>
                <p>{{$ans->kesimpulan}}</p>
            </div>
            <div class="box">
                <form action="{{ route('store-nilai', ['lesson_id' => $ans->lesson->id, 'user_id' => $ans->user->id]) }}" method="post">
                    @csrf
                    <label for="nilai">Nilai</label>
                    <input type="number" name="grade" id="nilai" min="0" max="100" placeholder="Masukkan nilai">
                    <input type="hidden" name="answer_id" value="{{ $ans->id }}">
                    <div class="button-container">
                        <button class="button" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</body>

</html>
@endsection