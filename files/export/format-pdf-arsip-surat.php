<?php

use Psr\Log\Test\DummyTest;

session_start();
require '../../config.php';
include '../../app/services/view.php';

function format_tanggal($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel tanggal_indo 0 = tanggal
    // variabel tanggal_indo 1 = bulan (indonesia)
    // variabel tanggal_indo 2 = tahun
    // variabel tanggal_indo 3 = bulan (int)

    $tanggal_indo = [$pecahkan[2], $bulan[(int)$pecahkan[1]], $pecahkan[0], $pecahkan[1]];
    return $tanggal_indo;
}

$run_query_view = new view($config);

if (!empty($_GET["several-months-start"]) && !empty($_GET["several-months-end"])) {
    $month_year = "BULAN " . format_tanggal($_GET["several-months-start"])[1] . " TAHUN " . format_tanggal($_GET["several-months-start"])[2] . " - BULAN " . format_tanggal($_GET["several-months-end"])[1] . " TAHUN " . format_tanggal($_GET["several-months-end"])[2];
    $date_awal = $_GET["several-months-start"];
    $date_akhir = $_GET["several-months-end"];

} else if (!empty($_GET["tanggal"])) {
    $month_year = "BULAN " . format_tanggal($_GET["tanggal"])[1] . " TAHUN " . format_tanggal($_GET["tanggal"])[2];
    $month = format_tanggal($_GET["tanggal"])[3];
    $year = format_tanggal($_GET["tanggal"])[2];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
    <style>
        p {
            font-size: 10px;
            font-family: "Times New Roman", serif;
        }

        table {
            border-collapse: collapse;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }

        th {
            text-transform: uppercase;
            font-size: 10px;
        }

        td {
            font-size: 10px;
        }

        .title {
            text-transform: uppercase;
            font-size: 12px;
        }

        .b {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .logo {
            width: 50px;
        }

        .top-border {
            border-top: 1px solid black;
        }

        .bottom-border {
            border-bottom: 1px solid black;
        }

        .right-border {
            border-right: 1px solid black;
        }

        .left-border {
            border-left: 1px solid black;
        }

        .all-border {
            border: 1px solid black;
        }

        .my-0 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .my-1 {
            margin-top: 4px;
            margin-bottom: 4px;
        }

        .space-height {
            height: 25px;
        }

        .space-height-2 {
            height: 17px;
        }

        .space-height-3 {
            height: 30px;
        }

        .w-1 {
            width: 3%;
        }

        .w-2 {
            width: 13%;
        }

        .w-3 {
            width: 12%;
        }

        .w-4 {
            width: 11%;
        }

        .w-5 {
            width: 11%;
        }

        .w-6 {
            width: 11%;
        }

        .w-7 {
            width: 6%;
        }

        .w-8 {
            width: 6%;
        }

        .w-9 {
            width: 6%;
        }

        .w-10 {
            width: 6%;
        }

        .w-11 {
            width: 16%;
        }

        .ps-1 {
            padding-left: 10px;
            padding-right:10px;
        }

        .p-2 {
            padding: 5px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .bg-cream {
            background-color: #FFCC66;
            padding: 2px;
        }

        .bg-orange {
            background-color: #FF6600;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td colspan="3" class="text-center">
                <img src="../../assets/images/logo.png" class="logo">
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                <p class="my-0">KEPOLISIAN NEGARA REPUBLIK INDONESIA</p>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                <p class="my-0">DAERAH JAWA TENGAH</p>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">
                <p class="my-0">INSPEKTORAT PENGAWASAN DAERAH​​</p>
                <hr style="width: 97%;margin-top:0;margin-bottom:0;color:black;" />
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="11">
                <br />
            </td>
        </tr>
        <tr>
            <td colspan="11" class="text-center">
                <p class="b my-1 title">REKAPITULASI ANALISIS DAN EVALUASI</p>
            </td>
        </tr>
        <tr>
            <td colspan="11" class="text-center">
                <p class="b my-1 title">ARSIP SURAT PENGADUAN MASYARAKAT POLDA JAWA TENGAH</p>
            </td>
        </tr>
        <tr>
            <td colspan="11" class="text-center">
                <p class="b my-1 uppercase title"><?= $month_year ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="8" class=" top-border">
                <br />
            </td>
            <td></td>
        </tr>
        <tr class="text-center">
            <td rowspan="3" class="all-border bg-cream text-center">
                <p class="b my-1">NO</p>
            </td>
            <td rowspan="3" class="all-border bg-cream text-center">
                <p class="b my-1">NO & TGL SURAT PENYALURAN</p>
            </td>
            <td rowspan="3" class="all-border bg-cream text-center">
                <p class="b my-1">PELAPOR & TERLAPOR</p>
            </td>
            <td rowspan="3" class="all-border bg-cream text-center">
                <p class="b my-1">SUBSTANSI</p>
            </td>
            <td rowspan="3" class="all-border bg-cream text-center">
                <p class="b my-1">SUMBER SURAT</p>
            </td>
            <td rowspan="3" class="all-border bg-cream text-center">
                <p class="b my-1">JENIS MASALAH</p>
            </td>
            <td colspan="4" class="all-border bg-cream text-center">
                <p class="b my-1">STATUS PENYELESAIAN</p>
            </td>
            <td rowspan="3" class="all-border bg-cream text-center">
                <p class="b my-1">KETERANGAN</p>
            </td>
        </tr>
        <tr class="text-center">
            <td rowspan="2" class="all-border bg-cream text-center">
                <p class="b my-1">BELUM ADA TANGGAPAN</p>
            </td>
            <td rowspan="2" class="all-border bg-cream text-center">
                <p class="b my-1">DALAM PROSES</p>
            </td>
            <td colspan="2" class="all-border bg-cream text-center">
                <p class="b my-1">SELESAI</p>
            </td>
        </tr>
        <tr class="text-center">
            <td class="all-border bg-cream text-center">
                <p class="b my-1">BENAR</p>
            </td>
            <td class="all-border bg-cream text-center">
                <p class="b my-1">TIDAK BENAR</p>
            </td>
        </tr>
        <tr class="text-center">
            <td class="all-border text-center w-1">1</td>
            <td class="all-border text-center w-2">2</td>
            <td class="all-border text-center w-3">3</td>
            <td class="all-border text-center w-4">4</td>
            <td class="all-border text-center w-5">5</td>
            <td class="all-border text-center w-6">6</td>
            <td class="all-border text-center w-7">7</td>
            <td class="all-border text-center w-8">8</td>
            <td class="all-border text-center w-9">9</td>
            <td class="all-border text-center w-10">10</td>
            <td class="all-border text-center w-11">11</td>
        </tr>
        <?php
        $nomor = 1;
        if ($_GET["by"] == "several-months") {
            $arr_result = $run_query_view->get_arsip_surat_by_multi_month($date_awal, $date_akhir);

        } else if ($_GET["by"] == "filter") {
            $arr_result = $run_query_view->get_arsip_surat_by_filter($_GET["filter"]);

        } else if ($_GET["by"] == "single-month") {
            $arr_result = $run_query_view->get_arsip_surat_by_single_month($month, $year);
        }

        foreach ($arr_result as $result) {
        ?>
        <tr>
                <td class="all-border text-center">
                    <p class="my-1"><?= $nomor ?></p>
                </td>
                <td class="all-border text-center p-2">
                    <p class="my-1"><?= $result["nomor_surat"] . "<br />Tgl. " . date_format(date_create($result["tanggal_surat"]), "d-m-Y") ?></p>
                </td>
                <td class="all-border ps-1">
                    <p class="my-1"> - <?= $result["pelapor"] . " <br /> - " . $result["name_polres"] ?></p>
                </td>
                <td class="all-border ps-1">
                    <p class="my-1"><?= $result["name_substansi"] ?></p>
                </td>
                <td class="all-border ps-1">
                    <p class="my-1"><?= $result["name_sumber_surat"] ?></p>
                </td>
                <td class="all-border ps-1">
                    <p class="my-1"><?= ($result["jenis_masalah"] != "") ? $result["jenis_masalah"] : "-" ?></p>
                </td>
                <td class="all-border text-center">
                    <p class="my-1"><?= ($result["status_penyelesaian"] == "Belum Ada Tanggapan") ? "X" : "" ?></p>
                </td>
                <td class="all-border text-center">
                    <p class="my-1"><?= ($result["status_penyelesaian"] == "Proses") ? "X" : "" ?></p>
                </td>
                <td class="all-border text-center">
                    <p class="my-1"><?= ($result["status_penyelesaian"] == "Selesai Benar") ? "X" : "" ?></p>
                </td>
                <td class="all-border text-center">
                    <p class="my-1"><?= ($result["status_penyelesaian"] == "Selesai Tidak Benar") ? "X" : "" ?></p>
                </td>
                <td class="all-border text-center">
                    <p class="my-1"><?= ($result["keterangan"] != "") ? $result["keterangan"] : "-" ?></p>
                </td>
            </tr>
        <?php
            $nomor++;
        }
        ?>

        <tr>
            <td colspan="11" class=" top-border">
                <br />
            </td>
        </tr>



        <tr>
            <td colspan="7"></td>
            <td colspan="4" class="text-center">
                <p class="my-1">a.n KEPALA KEPOLISIAN DAERAH JAWA TENGAH</p>
            </td>
        </tr>
        <tr>
            <td colspan="7"></td>
            <td colspan="4" class="text-center">
                <p class="my-1">IRWASDA</p>
            </td>
        </tr>
        <tr>
            <td colspan="11" class="">
                <br />
                <br />
                <br />
                <br />
            </td>
        </tr>
        <?php
        $signature = $run_query_view->get_signature("1");
        foreach ($signature as $result_signature) {
        ?>
            <tr>
                <td colspan="7"></td>
                <td colspan="4" class="text-center">
                    <p class="my-1"><?= $result_signature["name"] ?></p>
                    <hr style="width:84%;margin-top:0;margin-bottom:0;color:black;" />
                </td>
            </tr>
            <tr>
                <td colspan="7"></td>
                <td colspan="4" class="text-center">
                    <p class="my-1"><?= $result_signature["nrp"] ?></p>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>