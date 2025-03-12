<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "absensi_db";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $status = $_POST['status'];

    $sql = "INSERT INTO absensi (nama, status) VALUES ('$nama', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Absensi berhasil disimpan!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data dari database
$sql = "SELECT * FROM absensi ORDER BY waktu DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color:rgb(59, 148, 155);
    margin: 150px;
    text-align: center;
}

.container {
    width: 50%;
    margin: auto;
    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px gray;
    border-radius: 10px;
}

h2 {
    color: #333;
}

form {
    margin-bottom: 20px;
}

input, select, button {
    padding: 10px;
    margin: 5px;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background:rgb(58, 103, 201) ;
    color: white;
    cursor: pointer;
}

button:hover {
    background:rgb(148, 181, 253);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid black;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color:rgb(59, 148, 155);
}
    </style>
</head>
<body>

    <h2>Form Absensi Siswa</h2>

    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <label for="status">Status Kehadiran:</label>
        <select name="status">
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpha">Alpha</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <h2>Hasil Absensi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['waktu']}</td>
                          </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='4'>Belum ada data absensi.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
include 'config.php';
?>
