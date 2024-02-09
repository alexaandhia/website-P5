function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Simpan logika login sesuai kebutuhan Anda
    // Contoh sederhana, jika username dan password sama dengan "admin"
    if (username === "admin" && password === "admin") {
        alert("Login successful!");
    } else {
        alert("Login failed. Please check your username and password.");
    }
}
