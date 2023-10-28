<?php

if (isset($_POST["submit-tambah"])) {

    if ($_POST["substansi_id"] == 0 || $_POST["sumber_surat_id"] == 0 || $_POST["nomor_surat"] == "" || $_POST["pelapor"] == "" || $_POST["polres_id"] == 0 || $_POST["status_penyelesaian"] == "") {
        alert_icon("warning", "Form Required", "Pastikan anda mengisi Substansi / Sumber Surat / Nomro Surat / Pelapor / Terlapor / Status Penyelesaian dengan Benar", "?page=form-arsip-surat&form=tambah");
    } else {
        $data = array((int) $_POST["substansi_id"], (int) $_POST["sumber_surat_id"], $_POST["nomor_surat"], $_POST["pelapor"], (int) $_POST["polres_id"], $_POST["jenis_masalah"], $_POST["status_penyelesaian"], $_POST["keterangan"], $_POST["tanggal_surat"]);

        if ($_FILES["bukti"]["name"] != '') // check file sudah dipilih atau belum
        {
            $filename = $_FILES["bukti"]["name"];
            $file_basename = substr($filename, 0, strripos($filename, '.'));
            $file_ext = substr($filename, strripos($filename, '.'));
            $filesize = $_FILES["bukti"]["size"];
            $allowed_file_types = array('.doc', '.docx', '.pdf');

            if (in_array($file_ext, $allowed_file_types) && ($filesize < 2000000)) {
                // Rename file
                $newfilename = md5(rand()) . $file_ext;
                move_uploaded_file($_FILES["bukti"]["tmp_name"], "files/bukti/" . $newfilename);
                try {
                    array_push($data, $newfilename);
                    $run_query_create->add_arsip_surat($data);
                    alert_icon("success", "Berhasil menambahkan Arsip Surat!", "Redirecting...", "?page=arsip-surat");
                } catch (\Throwable $th) {
                    alert_icon("error", "Gagal menambahkan Arsip Surat!", "Redirecting...", "?page=form-arsip-surat&form=tambah");
                }
            } elseif (empty($file_basename)) {
                // file selection error
                alert_icon("warning", "Mohon upload Bukti laporan!", "Redirecting...", "?page=form-arsip-surat&form=tambah");
            } elseif ($filesize > 2000000) {
                // file size error
                alert_icon("warning", "Ukuran file terlalu besar! Max : 2 Mb", "Redirecting...", "?page=form-arsip-surat&form=tambah");
            } else {
                // file type error
                alert_icon("warning", "Tipe file tidak diperbolehkan! Valid type : " . implode(', ', $allowed_file_types), "Redirecting...", "?page=form-arsip-surat&form=tambah");
                unlink($_FILES["bukti"]["tmp_name"]);
            }
        } else {
            try {
                array_push($data, "");
                $run_query_create->add_arsip_surat($data);
                alert_icon("success", "Berhasil menambahkan Arsip Surat!", "Redirecting...", "?page=arsip-surat");
                
            } catch (\Throwable $th) {
                alert_icon("error", "Gagal menambahkan Arsip Surat!", "Redirecting...", "?page=form-arsip-surat&form=tambah");
            }
        }
    }
} else if (isset($_POST["submit-update"])) {
    if ($_POST["substansi_id"] == 0 || $_POST["sumber_surat_id"] == 0 || $_POST["nomor_surat"] == "" || $_POST["pelapor"] == "" || $_POST["polres_id"] == 0 || $_POST["status_penyelesaian"] == "") {
        alert_icon("warning", "Form Required", "Pastikan anda mengisi  Substansi / Sumber Surat / Nomro Surat / Pelapor / Terlapor / Status Penyelesaian dengan Benar", "?page=arsip-surat");
    } else {
        $data = array($_POST["substansi_id"], $_POST["sumber_surat_id"], $_POST["nomor_surat"], $_POST["pelapor"], $_POST["polres_id"], $_POST["jenis_masalah"], $_POST["status_penyelesaian"], $_POST["keterangan"], $_POST["tanggal_surat"]);

        if ($_FILES["bukti"]["name"] != '') // check file sudah dipilih atau belum
        {
            $filename = $_FILES["bukti"]["name"];
            $file_basename = substr($filename, 0, strripos($filename, '.'));
            $file_ext = substr($filename, strripos($filename, '.'));
            $filesize = $_FILES["bukti"]["size"];
            $allowed_file_types = array('.doc', '.docx', '.pdf');

            if (in_array($file_ext, $allowed_file_types) && ($filesize < 2000000)) {
                // Rename file
                $newfilename = md5(rand()) . $file_ext;
                move_uploaded_file($_FILES["bukti"]["tmp_name"], "files/bukti/" . $newfilename);
                try {
                    array_push($data, $newfilename, $_POST["idx"]);
                    $run_query_update->update_arsip_surat_with_bukti($data);
                    alert_icon("success", "Berhasil mengupdate Arsip Surat!", "Redirecting...", "?page=arsip-surat");
                } catch (\Throwable $th) {
                    alert_icon("error", "Gagal mengupdate Arsip Surat!", "Redirecting...", "?page=form-arsip-surat&form=update&idx=" . $_POST["idx"]);
                }
            } elseif (empty($file_basename)) {
                // file selection error
                alert_icon("warning", "Mohon upload Bukti laporan!", "Redirecting...", "?page=form-arsip-surat&form=update&idx=" . $_POST["idx"]);
            } elseif ($filesize > 2000000) {
                // file size error
                alert_icon("warning", "Ukuran file terlalu besar! Max : 2 Mb", "Redirecting...", "?page=form-arsip-surat&form=update&idx=" . $_POST["idx"]);
            } else {
                // file type error
                alert_icon("warning", "Tipe file tidak diperbolehkan! Valid type : " . implode(', ', $allowed_file_types), "Redirecting...", "?page=form-arsip-surat&form=update&idx=" . $_POST["idx"]);
                unlink($_FILES["bukti"]["tmp_name"]);
            }
        } else {
            try {
                array_push($data, $_POST["idx"]);
                $run_query_update->update_arsip_surat_no_bukti($data);
                alert_icon("success", "Berhasil mengupdate Arsip Surat!", "Redirecting...", "?page=arsip-surat");
            } catch (\Throwable $th) {
                alert_icon("error", "Gagal mengupdate Arsip Surat!", "Redirecting...", "?page=arsip-surat&form=update&idx=" . $_POST["idx"]);
            }
        }
    }
} else {
    alert_icon("warning", "Not Allowed!", "Redirecting...", "?page=arsip-surat");
}
