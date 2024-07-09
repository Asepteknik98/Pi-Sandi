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

// Ambil data gejala dari database
$query_gejala = "SELECT id, nama_gejala FROM gejala";
$result_gejala = $koneksi->query($query_gejala);

// Periksa apakah ada gejala yang tersedia
if ($result_gejala->num_rows > 0) {
    ?>
    <form action="diagnosa.php" method="POST">
        <h2>Pilih Gejala yang Anda Alami:</h2>
        <ul>
            <?php
            while ($row_gejala = $result_gejala->fetch_assoc()) {
                $id_gejala = $row_gejala['id'];
                $nama_gejala = $row_gejala['nama_gejala'];
                echo "<li><input type='checkbox' name='gejala[]' value='$id_gejala'> $nama_gejala</li>";
            }
            ?>
        </ul>
        <br>
        <button type="submit" class="btn btn-primary">Proses Diagnosa</button>
    </form>
    <?php
} else {
    echo "Tidak ada gejala yang tersedia dalam database.";
}

// Tutup koneksi
$koneksi->close();
?>
