<?php
require_once "config/Database.php";
require_once "models/Student.php";

class StudentController {
    private $student;
    private $db;
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Koneksi database
        $database = new Database();
        $db = $database->getConnection();
        
        // Instansiasi objek student
        $this->student = new Student($db);
        $this->db = $db;
    }
    
    // Halaman utama (daftar siswa)
    public function index() {
        // Mendapatkan semua data siswa
        $result = $this->student->getAll();
        
        // Menampilkan view
        include_once "views/templates/header.php";
        include_once "views/students/index.php";
        include_once "views/templates/footer.php";
    }
    
    // Halaman tambah siswa
    public function create() {
        // Jika form di-submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Set nilai properti dari form input
            $this->student->name = $_POST["name"];
            $this->student->nim = $_POST["nim"];
            $this->student->phone = $_POST["phone"];
            $this->student->join_date = $_POST["join_date"];
            
            // Proses tambah siswa
            if ($this->student->create()) {
                // Set notifikasi sukses
                $_SESSION['success'] = "Data mahasiswa berhasil ditambahkan";
                // Kembali ke halaman utama
                header("Location: index.php?action=students");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menambahkan data mahasiswa";
                // Tetap tampilkan form dengan pesan error
            }
        }
        
        // Menampilkan form tambah
        include_once "views/templates/header.php";
        include_once "views/students/create.php";
        include_once "views/templates/footer.php";
    }
    
    // Halaman edit siswa
    public function edit($id) {
        // Set ID
        $this->student->id = $id;
        
        // Jika form di-submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Set nilai properti dari form input
            $this->student->name = $_POST["name"];
            $this->student->nim = $_POST["nim"];
            $this->student->phone = $_POST["phone"];
            $this->student->join_date = $_POST["join_date"];
            
            // Proses update siswa
            if ($this->student->update()) {
                // Set notifikasi sukses
                $_SESSION['success'] = "Data mahasiswa berhasil diperbarui";
                // Redirect ke halaman utama
                header("Location: index.php?action=students");
                exit();
            } else {
                $_SESSION['error'] = "Gagal mengupdate data mahasiswa";
            }
        } else {
            // Mendapatkan data siswa yang akan diedit
            if (!$this->student->getById()) {
                // Jika siswa tidak ditemukan
                $_SESSION['error'] = "Data mahasiswa tidak ditemukan";
                header("Location: index.php?action=students");
                exit();
            }
        }
        
        // Menampilkan form edit
        include_once "views/templates/header.php";
        include_once "views/students/edit.php";
        include_once "views/templates/footer.php";
    }
    
    // Hapus siswa
    public function delete($id) {
        // Set ID
        $this->student->id = $id;
        
        // Cek apakah siswa memiliki pendaftaran mata kuliah
        if ($this->student->hasEnrollments()) {
            // Tampilkan pesan error jika siswa memiliki pendaftaran
            $_SESSION['error'] = "Tidak dapat menghapus mahasiswa karena masih terdaftar dalam pendaftaran mata kuliah (enrollments). Hapus terlebih dahulu data pendaftaran terkait.";
            header("Location: index.php?action=students");
            exit();
        } else {
            // Proses hapus siswa jika tidak memiliki pendaftaran
            if ($this->student->delete()) {
                $_SESSION['success'] = "Data mahasiswa berhasil dihapus";
                header("Location: index.php?action=students");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menghapus data mahasiswa";
                header("Location: index.php?action=students");
                exit();
            }
        }
    }
}