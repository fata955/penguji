<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "product";

$koneksi    = mysqli_connect($host,$user,$pass,$db);
$sql1       = "select * from product";
$q1         = mysqli_query($koneksi,$sql1);
?>
<style>
    th {
        background-color: #dedede;
        color: #333333;
        font-weight: bold;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
</style>
<table border="1">
    <thead>
        <tr>
            <th style="width:2%">No.</th>
            <th style="width:20%">Kode Customer</th>
            <th style="width:40%">Nama Customer</th>
            <th style="width:30%">Kota Customer</th>
            <th style="width:10%">Kota Customer</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        while($r1 = mysqli_fetch_assoc($q1)){
            ?>
            <tr>
                <td style="width:2%"><?php echo $i++ ?></td>
                <td style="width:20%"><?php echo $r1['name']?></td>
                <td style="width:40%"><?php echo $r1['price']?></td>
                <td style="width:30%"><?php echo $r1['quantity']?></td>
                <td style="width:10%"><?php echo $r1['description']?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>