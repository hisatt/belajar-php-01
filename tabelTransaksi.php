<?php
include("koneksi.php");

$queryTransaksi = "SELECT * FROM transaksi";
$resultTransaksi = mysqli_query($conn, $queryTransaksi);
$rowsTransaksi = mysqli_num_rows($resultTransaksi);

$columns = array('jumlah', 'total', 'tanggal');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

$querySorting = ("SELECT * FROM transaksi ORDER BY " . $column . " " . $sort_order);
$resultSorting = mysqli_query($conn, $querySorting);

if ($resultSorting) {
    $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
}

// fetch data dari db tabel transaksi where kolom tanggalnya = tanggal hari ini
$dateNow = date("Y-m-d");
$queryTotalToday = "SELECT SUM(total) AS total FROM transaksi WHERE tanggal = '$dateNow'";
$resultTotalToday = mysqli_query($conn, $queryTotalToday);
$rowTotalToday = mysqli_fetch_assoc($resultTotalToday);
$totalToday = $rowTotalToday['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<h3>Data Transaksi</h3>
    <h2>Jumlah Transaksi</h2>
    <b><?php echo $rowsTransaksi; ?> Transaksi</b> </br>

    <h2>Jumlah Transaksi Hari ini</h2>
    <b><?php echo $totalToday; ?> Transaksi</b> </br>

    <table id="dataTable" cellspacing="0" class="table">
        <thead class="table-dark">
            <tr>
                <th>Id Transaksi</th>
                <th>Id Customer</th>
                <th>Id Course</th>
                <th><a href="tabelTransaksi.php?column=jumlah&order=<?php echo $asc_or_desc; ?>">Jumlah<i class="fas fa-sort<?php echo $column == 'jumlah' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="tabelTransaksi.php?column=total&order=<?php echo $asc_or_desc; ?>">Total<i class="fas fa-sort<?php echo $column == 'total' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                <th><a href="tabelTransaksi.php?column=tanggal&order=<?php echo $asc_or_desc; ?>">Tanggal<i class="fas fa-sort<?php echo $column == 'tanggal' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM customer";
            $result = mysqli_query($conn, $query);

            while ($data = mysqli_fetch_array($resultSorting)) {
            ?>
                <tr>
                    <td> <?php echo $data['id_transaksi']; ?> </td>
                    <td> <?php echo $data['id_customer']; ?> </td>
                    <td> <?php echo $data['id_course']; ?> </td>
                    <td> <?php echo $data['jumlah']; ?> </td>
                    <td> <?php echo $data['total']; ?> </td>
                    <td> <?php echo $data['tanggal']; ?> </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>