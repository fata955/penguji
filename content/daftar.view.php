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
                    <h5 class="page-title fs-21 mb-1">DAFTAR PENGUJI</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Menu Utama</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Penguji</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-xl-3 col-md-12">
                <!-- <form action="proses/sp2d/page.php?action=fetchSingle" method="post"> -->
                <div class="card mb-4">
                    <form action="" method="post" id="cari">
                        <div class="card-body d-flex p-3 align-items-center">
                            <input class="form-control" placeholder="Nama Opd"
                                type="search" id="datasearch">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 col-md-12">
                <!-- <form action="proses/sp2d/page.php?action=fetchSingle" method="post"> -->
                <div class="card mb-4">
                    <form action="" method="post" id="cari">
                        <div class="card-body d-flex p-3 align-items-center">
                            <input class="form-control" placeholder="Nama Opd"
                                type="search" id="datasearch">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 col-md-12">
                <!-- <form action="proses/sp2d/page.php?action=fetchSingle" method="post"> -->
                <div class="card mb-4">
                    <form action="" method="post" id="cari">
                        <div class="card-body d-flex p-3 align-items-center">
                            <input class="form-control" placeholder="Nama Opd"
                                type="search" id="datasearch">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 col-md-12">
                <!-- <form action="proses/sp2d/page.php?action=fetchSingle" method="post"> -->
                <div class="card mb-4">
                    <form action="" method="post" id="cari">
                        <div class="card-body d-flex p-3 align-items-center">
                            <input class="form-control" placeholder="Nama Opd"
                                type="search" id="datasearch">
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12 col-xl-4">
                <!-- <div class="card card--events mb-4 overflow-hidden">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="main-content-label">List Pengambilan Data</div>
                                <h5>Total</h5>
                                <p class="mb-0" style="font-size:x-large;" id="totalfix">

                                </p>
                            </div>
                            <div class="list-group to-do-tasks rounded-0">
                                <div class="table-responsive border border-bottom-0 userlist-table">
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <table class="table card-table table-vcenter text-nowrap mb-0" id="mytablelist">
                                                <thead>
                                                    <tr>
                                                        <th><span>OPD</span></th>
                                                        <th><span>NILAI</span></th>
                                                        <th><span>action</span></th>

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
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="pt-4 px-4">
                                <div class="main-content-label">Daftar Penguji</div>
                            </div>
                            <div class="list-group to-do-tasks rounded-0">
                                <div class="table-responsive border border-bottom-0 userlist-table">
                                    <div class="row mt-2">
                                        <div class="col-lg-12">
                                            <table class="table card-table table-vcenter text-nowrap mb-0" id="mytablePenguji">
                                                <thead>
                                                    <tr>
                                                        <th><span>Nomor</span></th>
                                                        <th><span>Qty</span></th>
                                                        <th><span>Total</span></th>
                                                        <th><span>action</span></th>

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
                    </div> -->
            </div>
        </div>
        <!--End::row-1 -->


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

<?php
include 'component/footer.view.php';
?>



<script>

</script>