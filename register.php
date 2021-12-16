<?php
require('koneksi.php');
session_start();
$error = '';

if (isset($_POST['submit'])) {
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $nama_lengkap = stripslashes($_POST['nama_lengkap']);
    $nama_lengkap = mysqli_real_escape_string($conn, $nama_lengkap);

    $alamat = stripslashes($_POST['alamat']);
    $alamat = mysqli_real_escape_string($conn, $alamat);

    $telepon = $_POST['telepon'];

    $date = $_POST['date'];

    $jenis_kelamin = $_POST['jenis_kelamin'];

    $dummy_saldo = $_POST['dummy_saldo'];



    if(!empty(trim($email)) && !empty(trim($password)) && !empty(trim($nama_lengkap)) && !empty(trim($alamat)) && !empty(trim($telepon)) && !empty(trim($date)) && !empty(trim($jenis_kelamin)) && !empty(trim($dummy_saldo))) {
        if (cek_email($email, $conn) === 0) {
            if (cek_idCustomer($conn) === 0) {
                
            $query = "INSERT INTO customers (id_customer, email, password, nama_customer, alamat, telepon, tanggal, gender, saldo) VALUES ('$id_customer', '$email', '$password', '$nama_lengkap', '$alamat', '$telepon' '$date' '$jenis_kelamin' '$dummy_saldo')";
            $result = mysqli_query($conn, $query);
            }
        } 
    }
}

function cek_email($email, $conn) {
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM customer WHERE email = '$email'";
    if($result = mysqli_query($conn, $query))return mysqli_num_rows($result);
}

function cek_idCustomer($conn) {
    $key = 'C' . substr(uniqid(rand(), true), 4, 4);
    $key = mysqli_real_escape_string($conn, $key);
    $query = "SELECT * FROM customer WHERE id_customer = '$key'";
    if($result = mysqli_query($conn, $query))return mysqli_num_rows($result);
    
}
// $unique = substr(uniqid(rand(), true), 4, 4);
// <?php echo $unique = 'C' . substr(uniqid(rand(), true), 4, 4);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HALAMAN REGISTER</title>
</head>

<body>
    <h1>REGISTER</h1>
    <form method="POST" action="">
        <?php if ($error != '') { ?>
            <h1>Error : <?= $error; ?></h1>
        <?php } ?>
        <input type="email" name="email" placeholder="email anda">
        <input type="password" name="password" placeholder="password anda">
        <input type="text" name="nama_lengkap" placeholder="nama lengkap">
        <input type="text" name="alamat" placeholder="alamat lengkap">
        <input type="number" name="telepon" placeholder="nomer telepon" maxlength="13">
        <input type="date" name="date">
        <input type="radio" id="l" name="jenis_kelamin" value="L">
        <label for="l">L</label>
        <input type="radio" id="p" name="jenis_kelamin" value="P">
        <label for="p">P</label>
        <input type="number" name="dummy_saldo" placeholder="dummy saldo">
        <button type="submit" name="submit">Register</button>
    </form>

    <?php echo $cekcek; ?>
</body>

</html>