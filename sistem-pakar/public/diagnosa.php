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

// Ambil data gejala yang dipilih dari form pertanyaan_gejala.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gejala_terpilih = $_POST['gejala']; // Array berisi ID gejala yang dipilih

    // Proses gejala yang dipilih menjadi teks yang dapat disimpan
    $gejala_terpilih_text = implode(', ', $gejala_terpilih);

    // Query untuk mengambil nama-nama gejala dari database
    $query_gejala = "SELECT nama_gejala FROM gejala WHERE id IN ($gejala_terpilih_text)";
    $result_gejala = $koneksi->query($query_gejala);

    if ($result_gejala->num_rows > 0) {
        echo "<h2>Gejala yang Anda pilih:</h2>";
        echo "<ul>";
        while ($row_gejala = $result_gejala->fetch_assoc()) {
            echo "<li>" . $row_gejala['nama_gejala'] . "</li>";
        }
        echo "</ul>";

        // Contoh sederhana: Anda bisa menentukan diagnosa berdasarkan gejala yang dipilih
        // Di sini saya hanya menampilkan contoh diagnosa sederhana, Anda dapat mengembangkan lebih lanjut
        $hasil_diagnosa = "Kemungkinan infeksi mata";
        echo "<h2>Hasil Diagnosa:</h2>";
        echo "<p>$hasil_diagnosa</p>";

        // Simpan hasil diagnosa ke dalam database (opsional)
        $gejala_terpilih_text = $koneksi->real_escape_string($gejala_terpilih_text);
        $hasil_diagnosa = $koneksi->real_escape_string($hasil_diagnosa);

        $query_simpan = "INSERT INTO diagnosa (gejala_terpilih, hasil_diagnosa) VALUES ('$gejala_terpilih_text', '$hasil_diagnosa')";
        if ($koneksi->query($query_simpan) === TRUE) {
            echo "<p>Diagnosa berhasil disimpan.</p>";
        } else {
            echo "Error: " . $query_simpan . "<br>" . $koneksi->error;
        }

        // Tombol kembali
        echo "<br>";
        echo "<a href=\"pertanyaan_gejala.php\" class=\"btn btn-primary\">Kembali</a>";

        // Tombol rekomendasi diagnosa
        echo "<form action=\"proses_rekomendasi.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"gejala\" value=\"$gejala_terpilih_text\">";
        echo "<button type=\"submit\" class=\"btn btn-success\">Rekomendasi Diagnosa</button>";
        echo "</form>";

    } else {
        echo "Tidak ada gejala yang dipilih.";
    }
} else {
    echo "Data gejala tidak ditemukan.";
}

// Tutup koneksi
$koneksi->close();
?>
