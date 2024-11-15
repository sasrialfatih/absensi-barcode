<?php
// $namaBulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

date_default_timezone_set("Asia/Jayapura");

function get_nama_hari_indonesia($day)
{
    if ($day == "Sunday") {
        $day_indonesia = "Minggu";
    } else if ($day == "Monday") {
        $day_indonesia = "Senin";
    }else if ($day == "Tuesday") {
        $day_indonesia = "Selasa";
    }else if ($day == "Wednesday") {
        $day_indonesia = "Rabu";
    }else if ($day == "Thursday") {
        $day_indonesia = "Kamis";
    }else if ($day == "Friday") {
        $day_indonesia = "Jumat";
    }else if ($day == "Saturday") {
        $day_indonesia = "Sabtu";
    }

    return $day_indonesia;
}

// $tanggal = date('d M Y');
// $hari = date('l');
// $am = date('A');
// $bulan = date('m');
// $tahun = date('Y');
// $tahunDepan = date('Y') + 1;
// $tgl = date('d');
// $tgl_3 = date('d') + 3;
// // $menit = date('G:i:s');


function get_bulan_angka($get_nama_bulan)
{
    if ($get_nama_bulan == "Januari") {
        $get_bulan = "01";
    } else if ($get_nama_bulan == "Februari") {
        $get_bulan = "02";
    } else if ($get_nama_bulan == "Maret") {
        $get_bulan = "03";
    } else if ($get_nama_bulan == "April") {
        $get_bulan = "04";
    } else if ($get_nama_bulan == "Mei") {
        $get_bulan = "05";
    } else if ($get_nama_bulan == "Juni") {
        $get_bulan = "06";
    } else if ($get_nama_bulan == "Juli") {
        $get_bulan = "07";
    } else if ($get_nama_bulan == "Agustus") {
        $get_bulan = "08";
    } else if ($get_nama_bulan == "September") {
        $get_bulan = "09";
    } else if ($get_nama_bulan == "Oktober") {
        $get_bulan = "10";
    } else if ($get_nama_bulan == "November") {
        $get_bulan = "11";
    } else if ($get_nama_bulan == "Desember") {
        $get_bulan = "12";
    }

    return $get_bulan;
}


function get_angka_bulan($get_angka_bulan)
{
    switch ($get_angka_bulan) {
        case 1:
            $get_angka_bulan = "Januari";
            break;
        case 2:
            $get_angka_bulan = "Februari";
            break;
        case 3:
            $get_angka_bulan = "Maret";
            break;
        case 4:
            $get_angka_bulan = "April";
            break;
        case 5:
            $get_angka_bulan = "Mei";
            break;
        case 6:
            $get_angka_bulan = "Juni";
            break;
        case 7:
            $get_angka_bulan = "Juli";
            break;
        case 8:
            $get_angka_bulan = "Agustus";
            break;
        case 9:
            $get_angka_bulan = "September";
            break;
        case 10:
            $get_angka_bulan = "Oktober";
            break;
        case 11:
            $get_angka_bulan = "November";
            break;
        case 12:
            $get_angka_bulan = "Desember";
            break;
    }

    return $get_angka_bulan;
}
