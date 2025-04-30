<?php
require_once "config/Database.php";
require_once "models/Enrollment.php";

class EnrollmentController {
    private $enrollment;
    private $db;
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Koneksi database
        $database = new Database();
        $db = $database->getConnection();
        
        // Instansiasi objek enrollment
        $this->enrollment = new Enrollment($db);
        $this->db = $db;
    }
    
    // Halaman utama (daftar pendaftaran mata kuliah)
    public function index() {
        // Mendapatkan semua data pendaftaran
        $result = $this->enrollment->getAll();
        
        // Menampilkan view
        include_once "views/templates/header.php";
        include_once "views/enrollments/index.php";
        include_once "views/templates/footer.php";
    }
    
    // Halaman tambah pendaftaran
    public function create() {
        // Mendapatkan daftar siswa dan mata kuliah untuk dropdown
        $students = $this->enrollment->getAllStudents();
        $courses = $this->enrollment->getAllCourses();
        
        // Jika form di-submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Set nilai properti dari form input
            $this->enrollment->student_id = $_POST["student_id"];
            $this->enrollment->course_id = $_POST["course_id"];
            $this->enrollment->enrollment_date = $_POST["enrollment_date"];
            $this->enrollment->grade = !empty($_POST["grade"]) ? $_POST["grade"] : null;
            
            // Proses tambah pendaftaran
            if ($this->enrollment->create()) {
                // Set notifikasi sukses
                $_SESSION['success'] = "Data pendaftaran mata kuliah berhasil ditambahkan";
                // Kembali ke halaman utama
                header("Location: index.php?action=enrollments");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menambahkan data pendaftaran mata kuliah";
            }
        }
        
        // Menampilkan form tambah
        include_once "views/templates/header.php";
        include_once "views/enrollments/create.php";
        include_once "views/templates/footer.php";
    }
    
    // Halaman edit pendaftaran
    public function edit($id) {
        // Set ID
        $this->enrollment->id = $id;
        
        // Mendapatkan daftar siswa dan mata kuliah untuk dropdown
        $students = $this->enrollment->getAllStudents();
        $courses = $this->enrollment->getAllCourses();
        
        // Jika form di-submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Set nilai properti dari form input
            $this->enrollment->student_id = $_POST["student_id"];
            $this->enrollment->course_id = $_POST["course_id"];
            $this->enrollment->enrollment_date = $_POST["enrollment_date"];
            $this->enrollment->grade = !empty($_POST["grade"]) ? $_POST["grade"] : null;
            
            // Proses update pendaftaran
            if ($this->enrollment->update()) {
                // Set notifikasi sukses
                $_SESSION['success'] = "Data pendaftaran mata kuliah berhasil diperbarui";
                // Redirect ke halaman utama
                header("Location: index.php?action=enrollments");
                exit();
            } else {
                $_SESSION['error'] = "Gagal mengupdate data pendaftaran mata kuliah";
            }
        } else {
            // Mendapatkan data pendaftaran yang akan diedit
            if (!$this->enrollment->getById()) {
                // Jika pendaftaran tidak ditemukan
                $_SESSION['error'] = "Data pendaftaran mata kuliah tidak ditemukan";
                header("Location: index.php?action=enrollments");
                exit();
            }
        }
        
        // Menampilkan form edit
        include_once "views/templates/header.php";
        include_once "views/enrollments/edit.php";
        include_once "views/templates/footer.php";
    }
    
    // Hapus pendaftaran
    public function delete($id) {
        // Set ID
        $this->enrollment->id = $id;
        
        // Proses hapus pendaftaran
        if ($this->enrollment->delete()) {
            // Set notifikasi sukses
            $_SESSION['success'] = "Data pendaftaran mata kuliah berhasil dihapus";
            // Redirect ke halaman utama
            header("Location: index.php?action=enrollments");
            exit();
        } else {
            $_SESSION['error'] = "Gagal menghapus data pendaftaran mata kuliah";
            header("Location: index.php?action=enrollments");
            exit();
        }
    }
}