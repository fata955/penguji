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
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <button class="btn btn-primary" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-md-4 col-lg-4 col-xl-2  col-sm-4">
                            <div class="card" style="min-height: 350px; ">
                                <div class="card-body h-100">
                                    <div class="pro-img-box">
                                        <div class="product-sale">
                                            <!-- <div class="badge bg-pink">New</div> -->
                                            <!-- <a href="wish-list.html"><i class="mdi mdi-heart-outline ms-auto wishlist"></i></a> -->
                                        </div>
                                        <a href="spm/1"><img class="w-100 rounded-3" src="../Logo/BPBD.png"
                                                alt="product-image">
                                        </a>
                                        <!-- <a href="product-cart.html" class="adtocart"> <i class="las la-shopping-cart "></i>
                                        </a> -->
                                    </div>
                                    <div class="text-center pt-3">
                                        <h3 class="h6 mb-2 mt-4 fw-bold text-uppercase">BPBD</h3>
                                        <span class="fs-15 ms-auto">
                                            <i class="ion ion-md-star text-warning"></i>
                                            <i class="ion ion-md-star text-warning"></i>
                                            <i class="ion ion-md-star text-warning"></i>
                                            <i class="ion ion-md-star-half text-warning"></i>
                                            <i class="ion ion-md-star-outline text-warning"></i>
                                        </span>
                                        <!-- <h4 class="h5 mb-0 mt-2 text-center fw-bold text-danger">$26 <span
                                                class="text-secondary fw-normal fs-13 ms-1 prev-price">$59</span>
                                        </h4> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- pagination -->
                        <!-- <ul class="pagination product-pagination ms-auto float-end mb-3 ps-2">
                            <li class="page-item page-prev disabled">
                                <a class="page-link" href="javascript:void(0);" tabindex="-1">Prev</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                            <li class="page-item page-next">
                                <a class="page-link" href="javascript:void(0);">Next</a>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>

        </div>

        <!-- Page Header Close -->




    </div>
</div>
<?php
include 'component/footer.view.php';
?>

<script>
    $(document).ready(function() {
        fetchData()

        let table = new DataTable("#mytable");

        function fetchData() {
            $.ajax({
                url: "proses/sp2d/listpenguji.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;
                    table.clear().draw();
                    var counter = 1;
                    $.each(data, function(index, value) {
                        table.row
                            .add([
                                counter,
                                value.nomor_spm,
                                value.keterangan_spm,
                                value.nilai_spm,
                                value.jenis,
                                value.status_berkas,
                                value.id_sp2d,
                                value.nomorpenguji
                            ])

                            .draw(false);
                        counter++;
                    });
                }
            });
        }

        // $('form').on('submit', function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: 'proses/sp2d/listsp2d.php?action=cariData',
        //         method: 'POST',
        //         data: $(this).serialize(),
        //         dataType: 'json',
        //         success: function(response) {
        //             let rows = '';
        //             if (response.length > 0) {
        //                 $.each(response, function(i, item) {
        //                     rows += `<tr>
        //       <td>${i+1}</td>
        //       <td>${item.nama}</td>
        //       <td>${item.lokasi}</td>
        //       <td>${item.kategori}</td>
        //       <td>${item.status}</td>
        //       <td>${item.tahun}</td>
        //     </tr>`;
        //                 });
        //             } else {
        //                 rows = '<tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>';
        //             }
        //             $('table tbody').html(rows);
        //         }
        //     });
        // });
    });
</script>

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