<?php
session_start();

// jika session idCustomer masih kosong maka ke file login.php
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIST COURSE</title>
</head>
<body>
    <h1>LIST COURSE</h1>
</body>
</html>