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
            <div class="container py-5">
                <div class="row">
                    <!-- Sidebar: File List -->
                    <div class="col-lg-4 mb-4">
                        <div class="card p-4">
                            <h5 class="fw-bold mb-4"><i class="fas fa-folder-open me-2 text-primary"></i>Daftar Berkas</h5>
                            <div id="file-list" class="list-group list-group-flush">
                                <!-- Files will be injected here -->
                            </div>
                        </div>
                    </div>

                    <!-- Main Content: Status Details -->
                    <div class="col-lg-8">
                        <div id="tracking-detail" class="hidden">
                            <div class="card p-5 mb-4">
                                <h4 class="fw-bold mb-4" id="detail-title">Detail Pelacakan</h4>

                                <div class="stepper-wrapper" id="stepper">
                                    <!-- Stepper content will be injected here -->
                                </div>

                                <div class="text-center mt-3">
                                    <div class="alert alert-info d-inline-block px-4" id="status-text">
                                        Silakan pilih berkas untuk melihat status
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card p-4 h-100">
                                        <h5 class="fw-bold mb-4">Informasi Berkas</h5>
                                        <div class="row mb-3">
                                            <div class="col-5 text-muted small">Nomor Berkas</div>
                                            <div class="col-7 fw-semibold" id="info-id">-</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-5 text-muted small">Jenis Layanan</div>
                                            <div class="col-7 fw-semibold" id="info-service">-</div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-5 text-muted small">Tanggal Masuk</div>
                                            <div class="col-7 fw-semibold" id="info-date">-</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card p-4 h-100 bg-primary text-white">
                                        <h5 class="fw-bold mb-4">Progress</h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span id="progress-label">0%</span>
                                            <span id="progress-percent">0%</span>
                                        </div>
                                        <div class="progress mb-4" style="height: 8px;">
                                            <div class="progress-bar bg-success" id="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <p class="small mb-0">Estimasi: <br><strong id="info-estimate">-</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State -->
                        <div id="empty-state" class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-search text-muted" style="font-size: 4rem; opacity: 0.2;"></i>
                            </div>
                            <h5 class="text-muted">Pilih berkas dari daftar di samping <br>untuk melihat status detail.</h5>
                        </div>
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
    const files = [
        { id: '#BRK-2025-001', service: 'Izin Usaha Mikro', date: '15 Des 2025', status: 'Payment', progress: 100, estimate: 'Selesai' },
        { id: '#BRK-2025-042', service: 'IMB Rumah Tinggal', date: '20 Des 2025', status: 'Validation', progress: 66, estimate: '29 Des 2025' },
        { id: '#BRK-2025-088', service: 'Izin Reklame', date: '25 Des 2025', status: 'Verification', progress: 33, estimate: '02 Jan 2026' },
        { id: '#BRK-2025-102', service: 'SIUP Baru', date: '28 Des 2025', status: 'Verification', progress: 33, estimate: '05 Jan 2026' }
    ];

    function renderFileList() {
        const list = $('#file-list');
        files.forEach((file, index) => {
            const statusClass = file.status === 'Payment' ? 'bg-success' : (file.status === 'Validation' ? 'bg-primary' : 'bg-warning text-dark');
            list.append(`
                <div class="list-group-item list-group-item-action border-0 mb-2 rounded-3 file-item p-3" onclick="showDetail(${index})">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold text-primary">${file.id}</span>
                        <span class="badge status-badge ${statusClass}">${file.status}</span>
                    </div>
                    <div class="text-muted small">${file.service}</div>
                    <div class="text-muted" style="font-size: 0.7rem;">${file.date}</div>
                </div>
            `);
        });
    }

    function showDetail(index) {
        const file = files[index];
        $('#empty-state').hide();
        $('#tracking-detail').removeClass('hidden').hide().fadeIn();
        
        $('#detail-title').text('Pelacakan ' + file.id);
        $('#info-id').text(file.id);
        $('#info-service').text(file.service);
        $('#info-date').text(file.date);
        $('#info-estimate').text(file.estimate);
        
        $('#progress-percent').text(file.progress + '%');
        $('#progress-bar').css('width', file.progress + '%');

        // Update Stepper
        const stepper = $('#stepper');
        stepper.empty();
        
        const stages = ['Verification', 'Validation', 'Payment'];
        stages.forEach((stage, i) => {
            let state = '';
            const currentIdx = stages.indexOf(file.status);
            
            if (i < currentIdx) state = 'completed';
            else if (i === currentIdx) state = 'active';

            const icon = state === 'completed' ? '<i class="fas fa-check"></i>' : (i + 1);
            
            stepper.append(`
                <div class="stepper-item ${state}">
                    <div class="step-counter">${icon}</div>
                    <div class="step-name">${stage}</div>
                </div>
            `);
        });

        const statusMsg = {
            'Verification': 'Berkas sedang dalam tahap <strong>Verifikasi Dokumen</strong>',
            'Validation': 'Berkas sedang dalam tahap <strong>Validasi Teknis</strong>',
            'Payment': 'Berkas telah disetujui, silakan lakukan <strong>Pembayaran</strong>'
        };
        $('#status-text').html('<i class="fas fa-info-circle me-2"></i> ' + statusMsg[file.status]);
    }

    $(document).ready(() => {
        renderFileList();
    });
</script>