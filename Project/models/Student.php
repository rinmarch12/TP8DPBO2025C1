<?php
class Student {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "students";

    // Properti objek
    public $id;
    public $name;
    public $nim;
    public $phone;
    public $join_date;

    // Konstruktor dengan parameter koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Mengambil semua data mahasiswa
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    // Mengambil satu data mahasiswa berdasarkan ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->name = $row['name'];
            $this->nim = $row['nim'];
            $this->phone = $row['phone'];
            $this->join_date = $row['join_date'];
            return true;
        }
        return false;
    }

    // Menambahkan data mahasiswa baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, nim, phone, join_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $this->name, $this->nim, $this->phone, $this->join_date);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Memperbarui data mahasiswa
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = ?, nim = ?, phone = ?, join_date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $this->name, $this->nim, $this->phone, $this->join_date, $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Menghapus data mahasiswa
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Mengecek apakah mahasiswa memiliki data pendaftaran (enrollments)
    public function hasEnrollments() {
        $query = "SELECT COUNT(*) as enrollment_count FROM enrollments WHERE student_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // Mengembalikan true jika mahasiswa memiliki pendaftaran
        return ($row['enrollment_count'] > 0);
    }
}
