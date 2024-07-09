<?php
// Koneksi ke database (gunakan informasi koneksi yang sama dengan file pertanyaan_gejala.php)
$host = 'localhost'; // Ganti dengan host database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$database = 'mata_pakar'; // Ganti dengan nama database Anda

// Buat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data gejala yang dipilih dari form diagnosa.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gejala_terpilih_text = $koneksi->real_escape_string($_POST['gejala']); // String berisi ID gejala yang dipilih

    // Query untuk mencari diagnosa berdasarkan gejala yang dipilih
    $query_diagnosa = "SELECT hasil_diagnosa FROM diagnosa WHERE gejala_terpilih = '$gejala_terpilih_text'";
    $result_diagnosa = $koneksi->query($query_diagnosa);

    if ($result_diagnosa->num_rows > 0) {
        // Jika ditemukan hasil diagnosa
        $row_diagnosa = $result_diagnosa->fetch_assoc();
        $hasil_diagnosa = $row_diagnosa['hasil_diagnosa'];

        echo "<h2>Hasil Rekomendasi Diagnosa:</h2>";
        echo "<p>$hasil_diagnosa</p>";

    } else {
        echo "Tidak ada rekomendasi diagnosa yang ditemukan berdasarkan gejala yang dipilih.";
    }
} else {
    echo "Data gejala tidak ditemukan.";
}

// Tutup koneksi
$koneksi->close();
?>
