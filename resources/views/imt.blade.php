@extends('layout.userpage')
@section('content')


<style>
    /* body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
} */

.card {
    margin-left: 200px;
    margin-top: 60px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 500px;
    text-align: center;
}

h1{
    margin-left: 300px;
    margin-top: 30px;
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

button {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #2980b9;
}

#result {
    margin-top: 16px;
    font-weight: bold;
}
</style>

    <h1>Ayo Hitung IMT mu!</h1>
    <div class="card">
        <h2>Kalkulator IMT</h2>
        <label for="weight">Berat Badan (kg):</label>
        <input type="number" id="weight" placeholder="Masukkan berat badan">

        <label for="height">Tinggi Badan (cm):</label>
        <input type="number" id="height" placeholder="Masukkan tinggi badan">

        <button onclick="calculateIMT()">Hitung IMT</button>
<br/>
        <a href="/explanation" class="btn btn-danger">Kembali</a>

        <div id="result"></div>
    </div>

    <script>
        function calculateIMT() {
            var weight = document.getElementById('weight').value;
            var height = document.getElementById('height').value / 100; // convert cm to meters

            if (weight && height) {
                var imt = weight / (height * height);
                var result = "";

                if (imt < 18.5) {
                    result = "Berat badan kurang";
                } else if (imt >= 18.5 && imt < 24.9) {
                    result = "Berat badan normal";
                } else if (imt >= 25 && imt < 29.9) {
                    result = "Berat badan berlebih";
                } else {
                    result = "Obesitas";
                }

                document.getElementById('result').innerText = "IMT: " + imt.toFixed(2) + " - " + result;
            } else {
                alert("Masukkan berat dan tinggi badan terlebih dahulu");
            }
        }
    </script>

@endsection