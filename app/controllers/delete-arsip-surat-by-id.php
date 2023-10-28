<?php

if (isset($_POST["submit"])) {
    $bukti = "";
    $get_tindak_lanjut_by_id = $run_query_view->get_arsip_surat_by_id($_POST["id-tindak-lanjut"]);
    foreach ($get_tindak_lanjut_by_id as $result) {
        $bukti = $result["bukti"];
    }
    $path = 'files/bukti/' . $bukti;
    if (file_exists($path)) {
        try {
            $run_query_delete->delete_arsip_surat_by_id($_POST["id-tindak-lanjut"]);
            unlink($path);
            alert_icon("success", "Berhasil menghapus Arsip Surat!", "Redirecting...", "?page=arsip-surat");
        } catch (\Throwable $th) {
        alert_icon("error", "Gagal menghapus Arsip Surat!", "Redirecting...", "?page=arsip-surat");
        }
    } else {
        alert_icon("error", "File Bukti Tindak Lanjut tidak ditemukan!", "Redirecting...", "?page=arsip-surat");
    }
}
