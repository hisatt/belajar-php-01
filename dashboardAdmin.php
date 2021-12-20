<?php
include("koneksi.php");
session_start();
if (!isset($_SESSION['role'])) {
    header('location:index.php');
}

// fetch data dari db sesuai session yang tersedia
$query = "SELECT * FROM admin WHERE id_admin ='$_SESSION[role]'";
$result = mysqli_query($conn, $query);
$fetch = mysqli_fetch_array($result);

// fetch data dari db tabel transaksi where kolom tanggalnya = tanggal hari ini
$dateNow = date("Y-m-d");
$queryTotalToday = "SELECT SUM(total) AS total FROM transaksi WHERE tanggal = '$dateNow'";
$resultTotalToday = mysqli_query($conn, $queryTotalToday);
$rowTotalToday = mysqli_fetch_assoc($resultTotalToday);
$totalToday = $rowTotalToday['total'];


// fetch data dari db tabel transaksi where tanggalnya 1bulan sebelumnya hingga hari ini
$datePrevMonth = date('Y-m-d', strtotime('-1 month', time()));
// $queryTotalPrevMonth = "SELECT SUM(total) AS total FROM transaksi WHERE tanggal BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
$queryTotalPrevMonth = "SELECT SUM(total) AS total FROM transaksi WHERE tanggal >= '$datePrevMonth' AND  tanggal <= '$dateNow'";
$resultTotalPrevMonth = mysqli_query($conn, $queryTotalPrevMonth);
$rowPrevMonth = mysqli_fetch_assoc($resultTotalPrevMonth);
$totalPrevMonth = $rowPrevMonth['total'];

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="d-flex flex-row">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="#" class="nav-link active">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        Transaksi
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        Products
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        Tabel Course
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        Tabel Admin
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        Tabel Customers
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong><?php echo $fetch['nama']; ?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <div>
            <h2>Penghasilan (Hari ini)</h2>
            <b>Rp <?php echo $totalToday; ?></b>
            
            <h2>Penghasilan (Bulan ini)</h2>
            <b><?php echo $datePrevMonth; ?> <u> hingga</u> <?php echo $dateNow; ?></b> <br>
            <b>Rp <?php echo $totalPrevMonth; ?></b>
            
        </div>
    </div>

    <!-- <h3>Data Adminds</h3>
    <table id="dataTable" cellspacing="0" class="table">
        <thead class="table-dark">
            <tr>
                <th>Id_admin</th>
                <th>Email</th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM admin";
            $result = mysqli_query($conn, $query);

            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td> <?php echo $data['id_admin']; ?> </td>
                    <td> <?php echo $data['email']; ?> </td>
                    <td> <?php echo $data['nama']; ?> </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table> -->
</body>

</html>