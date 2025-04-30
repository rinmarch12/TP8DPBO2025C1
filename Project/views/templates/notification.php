<?php
// Cek apakah ada pesan sukses
if(isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> ' . $_SESSION['success'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    // Hapus pesan setelah ditampilkan
    unset($_SESSION['success']);
}

// Cek apakah ada pesan error
if(isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $_SESSION['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    // Hapus pesan setelah ditampilkan
    unset($_SESSION['error']);
}
?>