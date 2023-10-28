<!--
=========================================================
* Soft UI Dashboard - v1.0.6
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<?php
include "app/views/components/alert_icon.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body class="g-sidenav-show  bg-gray-100">
    <?php
    if (isset($_GET['logout'])) {
        session_destroy();
        alert_icon("success", "Log Out!", "Redirecting...", "?");
    }

    include "sidebar.php";
    ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <?php
            include "header.php";

            if (!empty($_GET["acc"])) {
                if (!empty($_GET["acc"])) {
                    include 'app/controllers/' . $_GET['acc'] . '.php';
                } else {
                    header('Location: ?');
                    exit;
                }
            } else {
                if (!empty($_GET["page"])) {
                    include 'app/views/pages/' . $_GET['page'] . '/index.php';
                } else {
                    include "app/views/pages/dashboard.php";
                }
            }

            include "footer.php";
            ?>

        </div>
    </main>

    <?php include "script.php"; ?>

</body>

</html>