<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<?php
if (isset($_GET["idx"]) && $_GET['form'] == 'update') {
    $substansi_id = "";
    $sumber_surat_id = "";
    $nomor_surat = "";
    $pelapor = "";
    $polres_id = "";
    $jenis_masalah = "";
    $status_penyelesaian = "";
    $keterangan = "";
    $tanggal_surat = "";
    $bukti = "";

    $get_tindak_lanjut_by_id = $run_query_view->get_arsip_surat_by_id($_GET["idx"]);
    foreach ($get_tindak_lanjut_by_id as $result) {
        $substansi_id = $result["substansi_id"];
        $sumber_surat_id = $result["sumber_surat_id"];
        $nomor_surat = $result["nomor_surat"];
        $pelapor = $result["pelapor"];
        $polres_id = $result["polres_id"];
        $jenis_masalah = $result["jenis_masalah"];
        $status_penyelesaian = $result["status_penyelesaian"];
        $keterangan = $result["keterangan"];
        $tanggal_surat = $result["tanggal_surat"];
        $bukti = $result["bukti"];
    }
}
?>

<div class="row my-4">
    <div class="col-lg-8 col-md-8">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-8 col-10">
                            <?php if ($_GET["form"] == "tambah") { ?>
                                <h6>Tambah Surat Tindak Lanjut</h6>
                                <p class="text-sm mb-0">
                                    Form <span class="font-weight-bold ms-1">Tambah Surat</span>
                                </p>
                            <?php } else if ($_GET["form"] == "update") { ?>
                                <h6>Update Surat Tindak Lanjut</h6>
                                <p class="text-sm mb-0">
                                    Form <span class="font-weight-bold ms-1">Update Surat</span>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="container m-0 pb-4">
                        <form action="?page=form-arsip-surat&acc=form-acc-arsip-surat" method="POST" enctype="multipart/form-data">
                            <?php if ($_GET["form"] == "update") { ?>
                                <input type="hidden" name="idx" value="<?= $_GET["idx"] ?>" />
                            <?php } ?>

                            <label class="mt-3">Substansi</label>
                            <select class="form-select" name="substansi_id" required>
                                <option value="0" <?= ($substansi_id == "") ? "SELECTED" : "" ?>>Pilih Substansi</option>
                                <?php
                                $substansi = $run_query_view->get_substansi();
                                foreach ($substansi as $result) {
                                ?>
                                    <option value="<?= $result['id'] ?>" <?= ($result["id"] == $substansi_id) ? "SELECTED" : "" ?>> <?= $result['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <label class="mt-3">Sumber Surat</label>
                            <select class="form-select" name="sumber_surat_id" required>
                                <option value="0" <?= ($sumber_surat_id == "0") ? "SELECTED" : "" ?>>Pilih Sumber Surat</option>
                                <?php
                                $sumbersurat = $run_query_view->get_sumber_surat();
                                foreach ($sumbersurat as $result) {
                                ?>
                                    <option value="<?= $result['id'] ?>" <?= ($result["id"] == $sumber_surat_id) ? "SELECTED" : "" ?>> <?= $result['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <label class="mt-3">Nomor Surat <a href="javascript:void(0)" class="btn btn-danger ms-lg-4 p-2 mb-0" onclick="javascript:document.getElementById('nomor-surat').value = 'random/random/sumber/sumber_num/bulan/tahun'">Format No Surat</a></label>
                            <input type="text" name="nomor_surat" id="nomor-surat" class="form-control" placeholder="No Surat" value="<?= $nomor_surat ?>" required>

                            <label class="mt-3">Pelapor</label>
                            <input type="text" name="pelapor" class="form-control" placeholder="Nama Pelapor" value="<?= $pelapor ?>" required>

                            <label class="mt-3">Terlapor - PolRes</label>
                            <select class="form-select" name="polres_id" required>
                                <option value="0" <?= ($polres_id == "0") ? "SELECTED" : "" ?>>Pilih Polres</option>
                                <?php
                                $terlapor = $run_query_view->get_polres();
                                foreach ($terlapor as $result) {
                                ?>
                                    <option value="<?= $result['id'] ?>" <?= ($result["id"] == $polres_id) ? "SELECTED" : "" ?>><?= $result['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <label class="mt-3">Jenis Masalah</label>
                            <input type="text" name="jenis_masalah" class="form-control mt-1" placeholder="Jenis Masalah / Keterangan" value="<?= $jenis_masalah ?>" required>

                            <label class="mt-3">Status Penyelesaian</label>
                            <select class="form-select" name="status_penyelesaian" required>
                                <option value="">Pilih Status</option>
                                <option value="Belum Ada Tanggapan" <?= ($status_penyelesaian == "Belum Ada Tanggapan") ? "SELECTED" : "" ?>>Belum Ada Tanggapan</option>
                                <option value="Proses" <?= ($status_penyelesaian == "Proses") ? "SELECTED" : "" ?>>Proses</option>
                                <option value="Selesai Benar" <?= ($status_penyelesaian == "Selesai Benar") ? "SELECTED" : "" ?>>Selesai Benar</option>
                                <option value="Selesai Tidak Benar" <?= ($status_penyelesaian == "Selesai Tidak Benar") ? "SELECTED" : "" ?>>Selesai Tidak Benar</option>
                            </select>

                            <label class="mt-3">Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?= $keterangan ?></textarea>

                            <label class="mt-3">Pilih Tanggal Surat</label>
                            <input type="text" name="tanggal_surat" id="datepicker-surat" class="form-control" value="<?= ($tanggal_surat == "") ? date("Y-m-d") : $tanggal_surat ?>" placeholder="Pilih Tanggal" required>

                            <label class="mt-3">Bukti (PDF)</label>
                            <br />
                            <?php
                            if ($_GET["form"] == "tambah" || $bukti == "") {
                                echo '<input type="file" class="form-control form-control-file" name="bukti">';
                            } else {
                                echo ' <h5 class="mb-0 text-m mb-2"><a href="files/bukti/' . $bukti . '" target="_blank"><span class="badge bg-gradient-secondary"><i class="fas fa-file-download"></i> Download File</span></a></h5> <h5 class="mb-0 text-m mb-2"> <a href="?page=form-arsip-surat&acc=delete-bukti&file=' . $bukti . '&idx=' . $_GET['idx'] . '"><span class="badge bg-gradient-danger"><i class="fas fa-trash-alt"></i> Delete File</span></a></h5>';
                            }
                            ?>

                            <?php if ($_GET["form"] == "tambah") { ?>
                                <div class="text-center">
                                    <button type="submit" name="submit-tambah" class="btn bg-gradient-info w-100 my-4 mb-2"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            <?php } else if ($_GET["form"] == "update") {
                            ?>
                                <div class="text-center">
                                    <button type="submit" name="submit-update" class="btn bg-gradient-success w-100 my-4 mb-2"><i class="fas fa-save"></i> Update</button>
                                </div>
                            <?php
                            } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#datepicker-surat").datepicker({
            format: "yyyy-mm-dd",
        });
        $("#datepicker-pengadu").datepicker({
            format: "yyyy-mm-dd",
        });
        $("#datepicker-polres").datepicker({
            format: "yyyy-mm-dd",
        });
        $("#datepicker-wilayah").datepicker({
            format: "yyyy-mm-dd",
        });
    </script>

</div>