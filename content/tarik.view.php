<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /login");
    exit();
}
include 'component/header.view.php';
include 'component/pengaturantampilan.view.php';

?>
<div class="page">
    <?php
    include 'component/header2.view.php';
    ?>
    <!--End modal -->
    <!-- Start::app-sidebar -->
    <aside class="app-sidebar sticky" id="sidebar">

        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header">
            <a href="index.html" class="header-logo">
                <img src="assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                <img src="assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
                <img src="assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white">
                <img src="assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
            </a>
        </div>
        <!-- End::main-sidebar-header -->
        <?php
        include 'component/sidebar.view.php';
        ?>

    </aside>
    <!-- End::app-sidebar -->

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Tarik Data dari SIPD</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Menu Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tarik Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="container-fluid">
                <form method="POST" id="insertForm">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <input class="form-control" id="idspm" name="idspm" placeholder="Masukkan id spm"></input>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <textarea class="form-control" id="dataspmdetail" name="dataspmdetail" placeholder="Masukkan Json" rows="20"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit" id='insertBtn'>Tarik Data SPM</button>
                        </div>
                    </div>
                </form>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" id="">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="myTablespmdetail">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Nomor_spm</th>
                                            <th>Keterangan</th>
                                            <th>OPD</th>
                                            <th>Nilai</th>
                                            <th>Tanggal SPM</th>
                                            <th>Tanggal Masuk file</th>
                                            <!-- <th data-breakpoints="xs">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End::app-content -->


    <div class="modal fade" id="modaldemo8insert">
        <form method="post" id="form_inputmenu">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Form Input Menu</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Judul Menu" name="judul" id="judul">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Isi Link" name="link" id="link">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " placeholder="Isi Urutan Menu" name="urutan"
                                id="urutan">
                        </div>


                        <!-- //MESSAGE -->

                        <div class="alert custom-alert1 alert-secondary" id="error">
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                                aria-label="Close"><i class="bi bi-x"></i></button>
                            <div class="text-center px-5 pb-0">
                                <svg class="custom-alert-icon svg-secondary" xmlns="http://www.w3.org/2000/svg"
                                    height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                                <h5>Confirmed</h5>
                                <p class="">This alert is created to just show the confirmation message.</p>
                                <div class="">
                                    <button class="btn btn-sm btn-secondary m-1">Close</button>
                                </div>
                            </div>
                        </div>
                        <!-- ENDMESSAGE -->


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="simpan">
                            Simpan
                        </button>
                        <!-- <button type="button" class="btn btn-light" data-bs-dismiss="modal" >Close</button> -->
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="modal fade" id="modaldemo8edit">
        <form method="post" id="editForm">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Form edit Menu</h6>
                        <!-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button> -->
                    </div>
                    <div class="modal-body text-start">
                        <input type="hidden" class="form-control " id="id" name="id">
                        <div class="input-group">

                            <input type="text" class="form-control " name="judul">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " name="link">
                        </div><br>
                        <div class="input-group">
                            <input type="text" class="form-control " name="urutan">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="update">
                            Update
                        </button>
                        <!-- <button class="btn btn-light" data-bs-dismiss="modal" >Close</button> -->
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="solid-primaryToast" class="toast colored-toast bg-primary text-fixed-white" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="toast-header bg-primary text-fixed-white">
            <img class="bd-placeholder-img rounded me-2" src="../assets/images/brand-logos/toggle-white.png" alt="...">
            <strong class="me-auto">Valex</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Your,toast message here.
        </div>
    </div>

    <?php
    include 'component/footer.view.php';
    ?>

    <script>
        $(document).ready(function() {
            // $("#solid-primaryToast").show();
            fetchData();

            let table = new DataTable("#myTablespmdetail", {
                "order": [
                    [4, "desc"]
                ]
            });

            // function to fetch data from database
            function fetchData() {
                $.ajax({
                    url: "proses/mocking/spmdetail.php?action=fetchData",
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        var data = response.data;
                        // var limitedContent = content .substring(0, 50) + (content.length > 50 ? "..." : "");
                        table.clear().draw();
                        $.each(data, function(index, value) {
                            var ket = value.keterangan_spm;
                            var slice = ket.slice(0, 70);

                            table.row
                                .add([
                                    value.nomor_spm,
                                    slice,
                                    value.nama_opd,
                                    value.nilai_spm,
                                    value.tanggal_spm,
                                    value.tanggal_masuk
                                ])
                                .draw(false);
                        });
                    }
                });


            }

            // function to insert data to database
            $("#insertForm").on("submit", function(e) {
                // $("#insertBtn").attr("disabled", "disabled");
                e.preventDefault();
                $.ajax({
                    url: "proses/mocking/spmdetail.php?action=insertData",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        var response = JSON.parse(response.statusCode);

                        if (response == 200) {
                            // Swal.fire("!", "Data Sukses Terupdate", "success");
                            alert("Data Sukses Terinput");

                            // window('')
                            // Swal.fire("!", "Data Sukses Tersimpan", "success");
                            fetchData();
                        } else if (response == 500) {
                            alert("Data Tidak Tersimpan");
                            fetchData();
                        } else if (response == 400) {
                            alert("Data Gagal Tersimpan");
                            fetchData();
                        }
                    }
                });
            });

        })
    </script>