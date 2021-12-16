<?php
include("koneksi.php");
session_start();

$error = '';

// cek login / belum..... jika sudah login maka langsung ke
// if (isset($_SESSION['idrole']) === "admin") {
//     header('Location: dashboardAdmin.php');
// }
// if (isset($_SESSION['idrole']) === "customer") {
//     header('Location: dashboardCustomers.php');
// }
if (isset($_SESSION['loggedIn'])) {
    if (preg_match("/admin/", $_SESSION['role'])) {
        header('Location: dashboardAdmin.php');
    }
    if (preg_match("/customer/", $_SESSION['role'])) {
        header('Location: dashboardCustomers.php');
    }
}

if (isset($_POST['submit'])) {
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    if (!empty(trim($email)) && !empty(trim($password))) {

        // cek apakah data inputan form login tersedia di tabel admin
        $queryAdmin = "SELECT * FROM admin WHERE email ='$email' AND password ='$password'";
        $resultAdmin = mysqli_query($conn, $queryAdmin);
        $rowsAdmin = mysqli_num_rows($resultAdmin);

        // cek apakah data inputan form login tersedia di tabel admin
        $queryCustomers = "SELECT * FROM customer WHERE email ='$email' AND password ='$password'";
        $resultCustomers = mysqli_query($conn, $queryCustomers);
        $rowsCustomers = mysqli_num_rows($resultCustomers);

        // cek
        if ($rowsAdmin != 0) {
            while ($row = mysqli_fetch_assoc($resultAdmin)) {
                $dbEmail = $row['email'];
                $dbPassword = $row['password'];
                $role = $row['role'];
            }
            if ($email == $dbEmail && $password == $dbPassword) {
                session_start();
                $_SESSION['role'] = $role;
                $_SESSION['loggedIn'] = true;
                header('Location: dashboardAdmin.php');
            }
        } elseif ($rowsCustomers != 0) {
            while ($row = mysqli_fetch_assoc($resultCustomers)) {
                $dbEmail = $row['email'];
                $dbPassword = $row['password'];
                $role = $row['role'];
            }
            if ($email == $dbEmail && $password == $dbPassword) {
                session_start();
                $_SESSION['role'] = $role;
                $_SESSION['loggedIn'] = true;
                header('Location: dashboardCustomers.php');
            }
        }else {
            $error = "Data tidak ditemukan, gagal login!";
        }
    } else {
        $error = "Form tidak boleh kosong";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HALAMAN LOGIN</title>
</head>

<body>
    <h1>LOGINN</h1>
    <form method="POST" action="">
        <?php if ($error != '') { ?>
            <h1>Error : <?= $error; ?></h1>
        <?php } ?>
        <input type="email" name="email" placeholder="email anda">
        <input type="password" name="password" placeholder="password anda">
        <button type="submit" name="submit">Login</button>
    </form>
</body>

</html>


<!-- AFKK SEK LURDDDDD, DILUTZZZ, WES ISO NAMPILKE SEKO DATABASE TINGGAL CSS E -->