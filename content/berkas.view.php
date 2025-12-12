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
    <!-- <aside class="app-sidebar sticky" id="sidebar">

        
        <div class="main-sidebar-header">
            <a href="index.html" class="header-logo">
                <img src="assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                <img src="assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
                <img src="assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white">
                <img src="assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
            </a>
        </div>
    
        <?php
        // include 'component/sidebar.view.php';
        ?>

    </aside> -->
    <!-- End::app-sidebar -->

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body p-2">
                           <form action="" method="post" id="cari">
                            <div class="card-body d-flex p-3 align-items-center">
                                <input class="form-control" placeholder="CARI NAMA OPD"
                                    type="search" id="datasearch"> <button type="submit" class="btn"><i
                                        class="fa fa-search d-none d-md-block"></i></button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="row row-sm" id="tablespm">


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


<script>
    $(document).ready(function() {
        // setInterval(fetchData, 9990);
        fetchData();
        // let table = new DataTable("#mytablelist");
        // let table1 = new DataTable("#mytablePenguji", {
        //     order: [
        //         [3, 'desc']
        //     ]
        // });
        // let table2 = new DataTable("#tablelistspm");
        // fetchCart();
        // fetchPenguji();
        // kosong();
        // $("#tab").hide();

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // function to fetch data from database
        function fetchData(data) {
            $("#tablespm").empty();
            $.ajax({
                url: "proses/berkas/page.php?action=fetchData",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    var data = response.data;

                    // $("#tablespm").hide();

                    $.each(data, function(index, value) {

                        $("#tablespm").append(`
                            <div class="col-md-4 col-lg-4 col-xl-2  col-sm-4">
                            <div class="card" style="min-height: 350px; ">
                                <div class="card-body h-100">
                                    <div class="pro-img-box">
                                        <div class="product-sale">
                                            <!-- <div class="badge bg-pink">New</div> -->
                                            <!-- <a href="wish-list.html"><i class="mdi mdi-heart-outline ms-auto wishlist"></i></a> -->
                                        </div>
                                        <a href="spm/1"><img class="w-100 rounded-3" src=""
                                                alt="product-image">
                                        </a>
                                        <!-- <a href="product-cart.html" class="adtocart"> <i class="las la-shopping-cart "></i>
                                        </a> -->
                                    </div>
                                    <div class="text-center pt-3">
                                 
                                        <h3 class="h6 mb-2 mt-4 fw-bold text-uppercase">` + value.nama_opd + `
                                        </h3> 
                                      
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
                                    
                                    <div class="text-center pt-3">
                                    <button class="btn btn-outline-primary ms-auto float-center cariBtn"
                                        data-bs-placement="top" data-bs-toggle="tooltip"  value="` + value.id_sipd + `" title="View Task">Cari SPM</button>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    
                        `)
                        // .draw(false);
                    });

                }
            });
        }


        // function to update data in database
        $("#cari").on("submit", function(e) {
            // $("#editBtn").attr("disabled");
            $("#tablespm").empty();
            var dsearch = $("#datasearch").val();
            e.preventDefault();
            if (dsearch) {
                $.ajax({
                    url: "proses/berkas/page.php?action=searchopd",
                    type: "POST",
                    dataType: "json",
                    data: {
                        dsearch: dsearch
                    },
                    success: function(response) {
                        var data = response.data;

                        // $("#tablespm").hide();

                        $.each(data, function(index, value) {

                            $("#tablespm").append(`
                             <div class="col-md-4 col-lg-4 col-xl-2  col-sm-4">
                            <div class="card" style="min-height: 350px; ">
                                <div class="card-body h-100">
                                    <div class="pro-img-box">
                                        <div class="product-sale">
                                            <!-- <div class="badge bg-pink">New</div> -->
                                            <!-- <a href="wish-list.html"><i class="mdi mdi-heart-outline ms-auto wishlist"></i></a> -->
                                        </div>
                                        <a href="spm/1"><img class="w-100 rounded-3" src=""
                                                alt="product-image">
                                        </a>
                                        <!-- <a href="product-cart.html" class="adtocart"> <i class="las la-shopping-cart "></i>
                                        </a> -->
                                    </div>
                                    <div class="text-center pt-3">
                                 
                                        <h3 class="h6 mb-2 mt-4 fw-bold text-uppercase">` + value.nama_opd + `
                                        </h3> 
                                      
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
                                    
                                    <div class="text-center pt-3">
                                    <button class="btn btn-outline-primary ms-auto float-center cariBtn"
                                        data-bs-placement="top" data-bs-toggle="tooltip"  value="` + value.id_sipd + `" title="View Task">Cari SPM</button>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        `)
                            // .draw(false);
                        });
                    }
                });
            } else {
                fetchData();

            }

        });


    });
</script>