<?php
session_start();
$id = $_GET['id'];

$sql1       = "SELECT ";
$q1         = mysqli_query($koneksi, $sql1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penguji</title>
</head>

<body>

    <!-- 
    <style>
        .cop {
            justify-items: center;
            line-height: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            /* height: 10px; */
            /* height:10px; */
            height: min-content;
            line-height: 8px;
            font-size: 8px;
        }

        table,
        th,
        td {
            border: 1px solid black;

        }

        th,
        td {
            padding: 10px;

        }

        th {
            /* background-color: rgb(19, 110, 170); */
            background-color: rgb(90, 150, 170);
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            line-height: 20px;
            text-align: center;
            vertical-align: middle;
            border-style: solid;
            width: 100%;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: times, sans-serif;
            font-size: 8px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
          
            border-width: 1px;
            font-family: times, sans-serif;
            font-size: 8px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-c3ow {
            text-align: center;
            vertical-align: top;
            
        }

        .tg .tg-0pky {
            text-align: center;
            vertical-align: top
        }

        .tg .tg-0lax {
            text-align: center;
            vertical-align: top
        }
    </style> -->
    <style>
        th {
            background-color: #dedede;
            color: #333333;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 8px;
        }

        tr {
            text-align: center;
            line-height: 12px;
        }

        .tbrekap {
            text-align: left;
        }
    </style>


    <table border="1">
        <thead>
            <tr>
                <th rowspan="2" style="width: 2%">No</th>
                <th rowspan="2" style="width: 8%">Tanggal</th>
                <th rowspan="2" style="width: 22%">Nomor Sp2d</th>
                <th rowspan="2">Brutto</th>
                <th colspan="3">Potongan</th>
                <th rowspan="2">Netto</th>
                <th rowspan="2">OPD</th>
                <th rowspan="2">No Rekening</th>
            </tr>
            <tr>
                <th style="">PPN</th>
                <th style="">PPh</th>
                <th style="">Lainnya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 2%">1</td>
                <td style="width: 8%">2025-12-30</td>
                <td style="width: 22%">72.71/04.00/00155/LS/0.06654654361321/M/3/2025</td>
                <td>2.000.000</td>
                <td>2.000.000</td>
                <td>2.000.000</td>
                <td>2.000.000</td>
                <td>2.000.000</td>
                <td>Dinas Kesehatan</td>
                <td>151-000-1515-21151</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>

    <table class="tbrekap" style="text-align:left">
        <tr>
            <td style="width:200px">Total SP2D S/D DAFTAR PENGUJI YANG LALU</td>
            <td style="width:10px">:</td>
            <td style="width:200px">Rp. 2.000.000</td>
        </tr>
        <tr>
            <td style="width:200px">Total SP2D DAFTAR PENGUJI INI</td>
            <td style="width:10px">:</td>
            <td style="width:200px">Rp. 2.000.000</td>
        </tr>
        <tr>
            <td>Total SP2D S/D DAFTAR PENGUJI INI</td>
            <td>:</td>
            <td>Rp. 2.000.000</td>
        </tr>
    </table>

    <br><br>
    <table style="text-align:center">
        <tr>
            <td>Mengetahui,<br><br><br><br><br>Nip.
            </td>
            <td>Mengetahui,<br>Kuasa Bendahara Umum Daerah Kota Palu<br><br><br><br><br>FADHILA,SE<br>Nip.19791113 200804 2 001
            </td>
        </tr>

    </table>

</body>

</html>