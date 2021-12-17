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
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>DASHBOARD ADMIN</h1>
    <p>Anda login sebagai : <b><?php echo $fetch['nama']; ?></b></p>

    <h3>Data Adminds</h3>
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
    </table>
</body>

</html>