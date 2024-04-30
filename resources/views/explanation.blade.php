@extends('layout.userpage')
@section('content')

<!-- ini penjelasan imt nya -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dua Kolom</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      background-color: #ffffff;
    }


    h2{
        padding-top: 30px;
        
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      overflow: hidden;
      padding: 20px;
    }

    .column {
      float: left;
      width: 50%;
      padding: 20px;
      box-sizing: border-box;
    }

    .column img {
      width: 100%;
      height: auto;
      margin-top: 30px;
      padding-left: 80px;
      border-radius: 8px;
    }

    .column p {
      margin-top: 30px;
      font-size: 16px;
      line-height: 1.6;
      color: black;
    }

    @media (max-width: 768px) {
      .column {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="column">
      <img src="https://p2ptm.kemkes.go.id/uploads//TmQwU05BQS9YYlJpanB5VnNtRldFUT09/11_Juni__05.png" alt="Foto" />
    </div>
    <div class="column">
      <h2>Apa itu IMT?</h2>
      <p>
        Dalam konteks kesehatan dan kedokteran, IMT adalah suatu pengukuran yang digunakan 
        untuk mengevaluasi berat badan seseorang relatif terhadap tinggi badannya. 
        IMT dihitung dengan membagi berat badan (dalam kilogram) dengan kuadrat tinggi badan (dalam meter). 
        IMT sering digunakan sebagai indikator kasar status gizi dan risiko kesehatan.
      </p>
      <p>
       <strong>Cara menghitung IMT</strong> <br>
       Gunakan rumus IMT: IMT = Berat Badan (kg) / (Tinggi Badan (m) * Tinggi Badan (m))
       Contoh: Jika berat badan Anda adalah 70 kg dan tinggi badan Anda adalah 1.75 meter, maka IMT = 70 / (1.75 * 1.75) = 22.86.
      </p>
      <p>
       Dan disini kami menyediakan Kalkulator IMT untuk mengecek kamu masuk kategori apa dalam imt 
      </p>
      <div>
        <a href="/imt" class="btn btn-outline-success">Kalkulator IMT </a>
      </div>
    </div>
  </div>

</body>
</html>
@endsection