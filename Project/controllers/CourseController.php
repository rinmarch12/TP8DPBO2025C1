<?php
require_once "config/Database.php";
require_once "models/Course.php";

class CourseController {
    private $course;
    private $db;
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Koneksi database
        $database = new Database();
        $db = $database->getConnection();
        
        // Instansiasi objek course
        $this->course = new Course($db);
        $this->db = $db;
    }
    
    // Halaman utama (daftar mata kuliah)
    public function index() {
        // Mendapatkan semua data mata kuliah
        $result = $this->course->getAll();
        
        // Menampilkan view
        include_once "views/templates/header.php";
        include_once "views/courses/index.php";
        include_once "views/templates/footer.php";
    }
    
    // Halaman tambah mata kuliah
    public function create() {
        // Jika form di-submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Set nilai properti dari form input
            $this->course->code = $_POST["code"];
            $this->course->name = $_POST["name"];
            $this->course->credits = $_POST["credits"];
            $this->course->description = $_POST["description"];
            
            // Proses tambah mata kuliah
            if ($this->course->create()) {
                // Set notifikasi sukses
                $_SESSION['success'] = "Data mata kuliah berhasil ditambahkan";
                // Redirect ke halaman utama
                header("Location: index.php?action=courses");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menambahkan data mata kuliah";
            }
        }
        
        // Menampilkan form tambah
        include_once "views/templates/header.php";
        include_once "views/courses/create.php";
        include_once "views/templates/footer.php";
    }
    
    // Halaman edit mata kuliah
    public function edit($id) {
        // Set ID
        $this->course->id = $id;
        
        // Jika form di-submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Set nilai properti dari form input
            $this->course->code = $_POST["code"];
            $this->course->name = $_POST["name"];
            $this->course->credits = $_POST["credits"];
            $this->course->description = $_POST["description"];
            
            // Proses update mata kuliah
            if ($this->course->update()) {
                // Set notifikasi sukses
                $_SESSION['success'] = "Data mata kuliah berhasil diperbarui";
                // Kembali ke halaman utama
                header("Location: index.php?action=courses");
                exit();
            } else {
                $_SESSION['error'] = "Gagal mengupdate data mata kuliah";
            }
        } else {
            // Mendapatkan data mata kuliah yang akan diedit
            if (!$this->course->getById()) {
                // Jika mata kuliah tidak ditemukan
                $_SESSION['error'] = "Data mata kuliah tidak ditemukan";
                header("Location: index.php?action=courses");
                exit();
            }
        }
        
        // Menampilkan form edit
        include_once "views/templates/header.php";
        include_once "views/courses/edit.php";
        include_once "views/templates/footer.php";
    }
    
    // Hapus mata kuliah
    public function delete($id) {
        // Set ID
        $this->course->id = $id;
        
        // Cek apakah mata kuliah digunakan dalam pendaftaran
        if ($this->course->hasEnrollments()) {
            // Tampilkan pesan error jika mata kuliah digunakan
            $_SESSION['error'] = "Tidak dapat menghapus mata kuliah karena masih digunakan dalam pendaftaran mata kuliah (enrollments). Hapus terlebih dahulu data pendaftaran terkait.";
            header("Location: index.php?action=courses");
            exit();
        } else {
            // Proses hapus mata kuliah jika tidak digunakan
            if ($this->course->delete()) {
                $_SESSION['success'] = "Data mata kuliah berhasil dihapus";
                header("Location: index.php?action=courses");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menghapus data mata kuliah";
                header("Location: index.php?action=courses");
                exit();
            }
        }
    }
}