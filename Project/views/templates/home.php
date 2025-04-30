<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Load header
include_once 'header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm mb-5">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4 text-dark">Selamat Datang di Sistem Manajemen Akademik</h1>
                    
                    <p class="text-center mb-5 lead">
                        Kelola mahasiswa, mata kuliah, dan pendaftaran dengan efisien dan mudah.
                    </p>
                    
                    <div class="row justify-content-center text-center">
                        <div class="col-md-4 mb-3">
                            <a href="index.php?action=students" class="btn btn-primary w-100 py-3">
                                Lihat Mahasiswa
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="index.php?action=courses" class="btn btn-primary w-100 py-3">
                                Lihat Mata Kuliah
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="index.php?action=enrollments" class="btn btn-primary w-100 py-3">
                                Lihat Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include_once 'footer.php';
?>

<!-- JavaScript Bootstrap -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>