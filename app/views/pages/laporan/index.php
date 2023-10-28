<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<div class="row my-4">
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-8 col-10">
                        <h6>Cari Arsip Surat</h6>
                        <p class="text-sm mb-0">
                            Berdasarkan <span class="font-weight-bold ms-1">Single Bulan</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="container m-0 pb-4">
                    <form action="?page=laporan" method="POST">
                        <label>Pilih Bulan</label>
                        <input type="text" name="single-month" id="datepicker-3" class="form-control w-lg-50" placeholder="Bulan, Tahun" onchange="javascript:document.getElementById('single-month').value = this.value" value="<?= (!empty($_POST["single-month"])) ? $_POST["single-month"] : "" ?>" required>

                        <div class="text-center">
                            <button type="submit" name="preview" value="single-month" class="btn bg-gradient-info w-100 mt-4"><i class="fas fa-search"></i> Preview</button>
                        </div>
                    </form>
                    <form action="files/export/arsip-surat.php" method="GET">
                        <input type="hidden" id="single-month" name="tanggal" value="<?= (!empty($_POST["single-month"])) ? $_POST["single-month"] : "" ?>">

                        <div class="text-center">
                            <button type="submit" name="by" value="single-month" class="btn bg-gradient-warning w-100"><i class="far fa-file-pdf"></i> Download PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-8 col-10">
                        <h6>Cari Arsip Surat</h6>
                        <p class="text-sm mb-0">
                            Berdasarkan <span class="font-weight-bold ms-1">Multi bulan</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="container m-0 pb-4">
                    <form action="?page=laporan" method="POST">
                        <label>Pilih Bulan Awal</label>
                        <input type="text" name="several-months-start" id="datepicker-4" class="form-control w-lg-50" placeholder="Bulan Awal" onchange="javascript:document.getElementById('several-months-start').value = this.value" value="<?= (!empty($_POST["several-months-start"])) ? $_POST["several-months-start"] : "" ?>" required>

                        <label class="mt-3">Pilih Bulan Akhir</label>
                        <input type="text" name="several-months-end" id="datepicker-5" class="form-control w-lg-50" placeholder="Bulan Akhir" onchange="getLastDate(this.value)" value="<?= (!empty($_POST["several-months-end"])) ? $_POST["several-months-end"] : "" ?>" required>

                        <div class="text-center">
                            <button type="submit" name="preview" value="several-months" class="btn bg-gradient-info w-100 mt-4"><i class="fas fa-search"></i> Preview</button>
                        </div>
                    </form>
                    <form action="files/export/arsip-surat.php" method="GET">
                        <input type="hidden" id="several-months-start" name="several-months-start" value="<?= (!empty($_POST["several-months-start"])) ? $_POST["several-months-start"] : "" ?>">
                        <input type="hidden" id="several-months-end" name="several-months-end" value="<?= (!empty($_POST["several-months-end"])) ? $_POST["several-months-end"] : "" ?>">

                        <div class="text-center">
                            <button type="submit" name="by" value="several-months" class="btn bg-gradient-warning w-100"><i class="far fa-file-pdf"></i> Download PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-8 col-10">
                            <h6>Cari Arsip Surat</h6>
                            <p class="text-sm mb-0">
                                berdasarkan <span class="font-weight-bold ms-1">Filter</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="container m-0 pb-4">
                        <form action="?page=laporan" method="POST">

                            <label>Nomor Surat / Pelapor / Jenis Masalah</label>
                            <input type="text" name="filter" class="form-control" placeholder="Filter" onchange="javascript:document.getElementById('filter').value = this.value" value="<?= (!empty($_POST["filter"])) ? $_POST["filter"] : "" ?>" required>

                            <div class="text-center">
                                <button type="submit" name="preview" value="filter" class="btn bg-gradient-info w-100 mt-4"><i class="fas fa-search"></i> Preview</button>
                            </div>
                        </form>
                        <form action="files/export/arsip-surat.php" method="GET">
                            <input type="hidden" id="filter" name="filter" value="<?= (!empty($_POST["filter"])) ? $_POST["filter"] : "" ?>">

                            <div class="text-center">
                                <button type="submit" name="by" value="filter" class="btn bg-gradient-warning w-100"><i class="far fa-file-pdf"></i> Download PDF</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <div class="col-lg-12 col-md-12">
        <?php
        if (isset($_POST["preview"])) {
            if ($_POST["preview"] == "several-months") {
                $tanggal_query_awal = $_POST["several-months-start"];
                $tanggal_query_akhir = $_POST["several-months-end"];
                $month_year = "";
                $title_table = "Berdasarkan Multi Bulan : " . format_tanggal($tanggal_query_awal)[1] . ' ' . format_tanggal($tanggal_query_awal)[2] . ' - ' . format_tanggal($tanggal_query_akhir)[1] . ' ' . format_tanggal($tanggal_query_akhir)[2];
                $arsip_surat = $run_query_view->get_arsip_surat_by_multi_month($tanggal_query_awal, $tanggal_query_akhir);
            } else if ($_POST["preview"] == "filter") {
                $month_year = "";
                $title_table = "Berdasarkan Filter : " . $_POST['filter'];
                $arsip_surat = $run_query_view->get_arsip_surat_by_filter($_POST["filter"]);
            } else if ($_POST["preview"] == "single-month") {
                $tanggal_query = $_POST["single-month"];
                $month_year = format_tanggal($tanggal_query)[1] . " " . format_tanggal($tanggal_query)[2];
                $title_table = "";
                $arsip_surat = $run_query_view->get_arsip_surat_by_single_month(format_tanggal($tanggal_query)[3], format_tanggal($tanggal_query)[2]);
            }
        } else {
            $tanggal_query = date('Y-m-d');
            $month_year = format_tanggal($tanggal_query)[1] . " " . format_tanggal($tanggal_query)[2];
            $title_table = "";
            $arsip_surat = $run_query_view->get_arsip_surat_by_single_month(format_tanggal($tanggal_query)[3], format_tanggal($tanggal_query)[2]);
        }

        include "app/views/components/tabel_arsip_surat.php";
        ?>
    </div>
</div>

<script>
    $("#datepicker").datepicker({
        format: "yyyy-mm-dd",
        startView: "months",
        minViewMode: "months"
    });
    $("#datepicker-2").datepicker({
        format: "yyyy-mm-dd",
        startView: "months",
        minViewMode: "months"
    });
    $("#datepicker-3").datepicker({
        format: "yyyy-mm-dd",
        startView: "months",
        minViewMode: "months"
    });
    $("#datepicker-4").datepicker({
        format: "yyyy-mm-dd",
        startView: "months",
        minViewMode: "months"
    });
    $("#datepicker-5").datepicker({
        format: "yyyy-mm-dd",
        startView: "months",
        minViewMode: "months"
    });

    function getLastDate(valuex) {
        var dateform = $("#datepicker-5").datepicker('getDate');
        var selectedMonth = dateform.getMonth();
        var selectedYear = dateform.getFullYear();

        var lastDate = new Date(selectedYear, selectedMonth + 1, 0);

        var year = lastDate.toLocaleString("default", {
            year: "numeric"
        });
        var month = lastDate.toLocaleString("default", {
            month: "2-digit"
        });
        var day = lastDate.toLocaleString("default", {
            day: "2-digit"
        });

        // Generate yyyy-mm-dd date string
        var formattedDate = year + "-" + month + "-" + day;

        document.getElementById('datepicker-5').value = formattedDate;
        document.getElementById('several-months-end').value = formattedDate;
    }
</script>