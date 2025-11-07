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
                <div class="col-md-6">
                    <h2 class="mb-4">LIST PENGUJI</h2>
                    <h5 class="mb-4">Filter</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a type="button" href="/kertaskerja" class="btn btn-warning-gradient btn-wave" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali Ke Kertas Kerja">
                        <-- Kembali
                            </a>
                </div>
            </div>

            <!-- Filter Section -->
            <form class="row g-3 mb-4" method="POST">
                <!-- Text Input 1 -->
                <div class="col-md-4">
                    <label for="keyword" class="form-label">Nomor Penguji</label>
                    <input type="text" class="form-control" id="sp2d" placeholder="Masukkan Nomor Penguji">
                </div>


                <!-- Text Input 2 -->


                <!-- ComboBox 1 -->


                <!-- ComboBox 2 -->



                <!-- ComboBox 3 -->
                <div class="col-md-4">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select class="form-select" id="bulan" name="bulan">
                        <option selected disabled>Pilih bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>

                </div>

                <!-- Submit Button -->
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </form>

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="mytable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nomor Penguji</th>
                            <th>Item Sp2d</th>
                            <th>Pejabat TTD</th>
                            <th>Tanggal</th>
                            <th>Total Nilai</th>
                            <th>action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <!-- Tambahkan baris data lainnya di sini -->
                    </tbody>
                </table>
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
                                '<label>000' + value.nomor + '/MANDIRI/BPKAD/2025 </label>',
                                value.count + '-' + 'ITEM',
                                value.pejabat,
                                value.tanggal,
                                '<td class="text-end">' + formatRupiah(value.nilai) + '</td>',

                                '<Button type="button" class="btn btn-sm btn-success viewsBtn" value="' +
                                value.id +
                                '"><i class="las la-eye"></i></Button>'
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