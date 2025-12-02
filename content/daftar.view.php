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
                    <h2 class="mb-4">LIST SP2D</h2>
                    <h5 class="mb-4">Filter</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a type="button" href="/kertaskerja" class="btn btn-success-gradient btn-wave" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali Ke Kertas Kerja">
                        <-- Kembali
                            </a>
                </div>
            </div>


            <!-- Filter Section -->
            <form class="row g-3 mb-4" method="POST" id="formcari" action="">
                <!-- Text Input 1 -->
                <div class="col-md-4">
                    <label for="keyword" class="form-label">Nomor SPM</label>
                    <input type="text" class="form-control" id="sp2d" name="sp2d" placeholder="Masukkan Nomor SP2D langsung pencarian">
                </div>
                <div class="col-md-4">
                    <label for="category" class="form-label">Jenis Dokumen</label>
                    <select class="form-select" id="jenis" name="jenis">
                        <option selected disabled>Pilih kategori</option>
                        <option value="LS">LS</option>
                        <option value="GU">GU</option>
                        <option value="UP">UP</option>
                    </select>
                </div>

                <!-- Text Input 2 -->


                <!-- ComboBox 1 -->
                <div class="col-md-4">
                    <label for="category" class="form-label">status Berkas</label>
                    <select class="form-select" id="status_berkas" name="status_berkas">
                        <option selected disabled>Pilih kategori</option>
                        <option value="1">GAJI</option>
                        <option value="2">TPP PNS</option>
                        <option value="3">TPP PPPK</option>
                        <option value="4">LAINNYA</option>
                    </select>
                </div>

                <!-- ComboBox 2 -->
                <div class="col-md-4">
                    <label for="status" class="form-label">Status Verifikasi</label>
                    <select class="form-select" id="statuspenguji">
                        <option selected disabled>Pilih status</option>
                        <option value="1">BELUM VERIFIKASI</option>
                        <option value="3">SUDAH VERIFIKASI</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Sumber Dana</label>
                    <select class="form-select" id="sumberdana">
                        <option selected disabled>Pilih status</option>
                        <?php
                        // include '../../lib/conn.php';
                        $menu = mysqli_query($koneksi, "SELECT * from t_sumberdana");
                        while ($fetch = mysqli_fetch_array($menu)) {
                            echo '<option value="' . $fetch['id'] . '">' . $fetch['namasumberdana'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

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
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary-gradient w-100" id="cari">Cari</button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-success-gradient btn-wave w-100" id="print">Cetak</button>
                </div>
            </form>

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="mytable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nomor SPM</th>
                            <th>Keterangan Sp2d</th>
                            <th>Nilai Sp2d</th>
                            <th>Jenis</th>
                            <th>Potongan</th>
                            <th>Status Berkas</th>
                            <th>Nomor SP2D</th>
                            <th>Nomor Penguji</th>
                        </tr>
                    </thead>
                    <tbody id="tes">

                        <!-- Tambahkan baris data lainnya di sini -->
                    </tbody>


                </table>
                <br>
                <div id="pagination"></div>
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

        // let tbody = new DataTable("#mytable #tes");
        // var table = $('#mytable').DataTable();

        function statusberkas(x) {

            if (x == 1) {
                status = "GAJI";
            } else if (x == 2) {
                status = "TPP PNS";
            } else if (x == 3) {
                status = "TPP PPPK";
            } else {
                status = "LAINNYA";
            }
            return (status);
        }
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

        function fetchData(page = 1, itemsPerPage = 5, spm = '', jenis = '') {
            $.ajax({
                url: "proses/sp2d/listsp2d.php?action=fetchData",
                type: "POST",
                dataType: "json",
                data: {
                    page: page,
                    itemsPerPage: itemsPerPage,
                    spm: spm,
                    jenis: jenis
                },
                success: function(response) {
                    var tbody = $('#mytable #tes');
                    tbody.empty();

                    var data = response.data;
                    var totalItems = response.totalItems;
                    var totalPages = Math.ceil(totalItems / itemsPerPage);
                    var counter = (page - 1) * itemsPerPage + 1;

                    $.each(data, function(index, value) {
                        var row = `
                    <tr>
                        <td>${counter}</td>
                        <td>${value.nomor_spm}</td>
                        <td>${value.keterangan_spm}</td>
                        <td class="text-end">${formatRupiah(value.nilai_spm)}</td>
                        <td>${value.jenis}</td>
                        <td class="text-end">${formatRupiah(value.potongan)}</td>
                        <td>${statusberkas(value.status_berkas)}</td>
                        <td class="text-end">${value.id_sp2d}</td>
                        <td class="text-end">${value.nomorpenguji}</td>
                    </tr>
                `;
                        counter++;
                        tbody.append(row);
                    });

                    var pagination = $('#pagination');
                    pagination.empty();

                    const maxVisiblePages = 10;
                    let startPage = Math.floor((page - 1) / maxVisiblePages) * maxVisiblePages + 1;
                    let endPage = Math.min(startPage + maxVisiblePages - 1, totalPages);

                    // Tombol Previous
                    if (page > 1) {
                        pagination.append(`<button class="page-btn" data-page="${page - 1}">Previous</button> `);
                    }

                    // Tombol halaman terbatas
                    for (let i = startPage; i <= endPage; i++) {
                        const activeClass = (i === page) ? 'active' : '';
                        pagination.append(`<button class="page-btn ${activeClass}" data-page="${i}">${i}</button> `);
                    }

                    // Tombol Next
                    if (page < totalPages) {
                        pagination.append(`<button class="page-btn" data-page="${page + 1}">Next</button>`);
                    }

                    $('.page-btn').off('click').on('click', function() {
                        var selectedPage = $(this).data('page');
                        fetchData(selectedPage, itemsPerPage, spm, jenis);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Gagal memuat data: " + status + " - " + error);
                    $('#mytable #tes').html('<tr><td colspan="9">Gagal memuat data dari server.</td></tr>');
                }
            });
        }

        // Trigger pencarian
        $('#formcari').on('submit', function(e) {
            e.preventDefault();
            var keyword = $('#sp2d').val();
            var jenis = $('#jenis').val();
            fetchData(1, 5, keyword, jenis);
        });

        function renderPagination(page, totalPages) {
            const pagination = $('#pagination');
            pagination.empty();

            const maxVisiblePages = 10;
            let startPage = Math.floor((page - 1) / maxVisiblePages) * maxVisiblePages + 1;
            let endPage = Math.min(startPage + maxVisiblePages - 1, totalPages);

            // Tombol "First" dan "Previous"
            if (page > 1) {
                pagination.append(`<button class="page-btn" data-page="1">⏮️</button>`);
                pagination.append(`<button class="page-btn" data-page="${page - 1}">Previous</button>`);
            }

            // Jika ada halaman sebelum window aktif
            if (startPage > 1) {
                pagination.append(`<button class="page-btn disabled">...</button>`);
            }

            // Tombol halaman aktif
            for (let i = startPage; i <= endPage; i++) {
                const activeClass = (i === page) ? 'active' : '';
                pagination.append(`<button class="page-btn ${activeClass}" data-page="${i}">${i}</button>`);
            }

            // Jika ada halaman setelah window aktif
            if (endPage < totalPages) {
                pagination.append(`<button class="page-btn disabled">...</button>`);
            }

            // Tombol "Next" dan "Last"
            if (page < totalPages) {
                pagination.append(`<button class="page-btn" data-page="${page + 1}">Next</button>`);
                pagination.append(`<button class="page-btn" data-page="${totalPages}">⏭️</button>`);
            }

            // Event klik
            $('.page-btn').off('click').on('click', function() {
                const selectedPage = $(this).data('page');
                if (!selectedPage || $(this).hasClass('disabled')) return;
                const keyword = $('#sp2d').val();
                const jenis = $('#jenis').val();
                fetchData(selectedPage, itemsPerPage, spm, jenis);
            });
        }



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