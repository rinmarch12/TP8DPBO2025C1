<?php
class Course {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "courses";

    // Properti objek
    public $id;
    public $code;
    public $name;
    public $credits;
    public $description;

    // Konstruktor dengan koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Membaca semua data mata kuliah
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    // Membaca satu data mata kuliah berdasarkan ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->code = $row['code'];
            $this->name = $row['name'];
            $this->credits = $row['credits'];
            $this->description = $row['description'];
            return true;
        }
        return false;
    }

    // Menambahkan data mata kuliah
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (code, name, credits, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssis", $this->code, $this->name, $this->credits, $this->description);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Memperbarui data mata kuliah
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET code = ?, name = ?, credits = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisi", $this->code, $this->name, $this->credits, $this->description, $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Menghapus data mata kuliah
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Mengecek apakah mata kuliah memiliki mahasiswa yang mendaftar
    public function hasEnrollments() {
        $query = "SELECT COUNT(*) as enrollment_count FROM enrollments WHERE course_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // Mengembalikan true jika ada mahasiswa yang mendaftar pada mata kuliah ini
        return ($row['enrollment_count'] > 0);
    }
}
