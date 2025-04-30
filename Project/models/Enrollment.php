<?php
class Enrollment {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "enrollments";

    // Properti objek
    public $id;
    public $student_id;
    public $course_id;
    public $enrollment_date;
    public $grade;

    // Konstruktor dengan koneksi database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua data pendaftaran dengan detail mahasiswa dan mata kuliah
    public function getAll() {
        $query = "SELECT e.id, e.student_id, e.course_id, e.enrollment_date, e.grade, 
                  s.name as student_name, s.nim, 
                  c.code as course_code, c.name as course_name
                  FROM " . $this->table_name . " e
                  LEFT JOIN students s ON e.student_id = s.id
                  LEFT JOIN courses c ON e.course_id = c.id
                  ORDER BY e.id ASC";
                  
        $result = $this->conn->query($query);
        return $result;
    }

    // Ambil satu data pendaftaran berdasarkan ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->student_id = $row['student_id'];
            $this->course_id = $row['course_id'];
            $this->enrollment_date = $row['enrollment_date'];
            $this->grade = $row['grade'];
            return true;
        }
        return false;
    }

    // Buat data pendaftaran baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (student_id, course_id, enrollment_date, grade) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiss", $this->student_id, $this->course_id, $this->enrollment_date, $this->grade);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Perbarui data pendaftaran
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET student_id = ?, course_id = ?, enrollment_date = ?, grade = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iissi", $this->student_id, $this->course_id, $this->enrollment_date, $this->grade, $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hapus data pendaftaran
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Ambil semua data mahasiswa untuk pilihan dropdown
    public function getAllStudents() {
        $query = "SELECT id, name, nim FROM students ORDER BY name";
        $result = $this->conn->query($query);
        return $result;
    }
    
    // Ambil semua data mata kuliah untuk pilihan dropdown
    public function getAllCourses() {
        $query = "SELECT id, code, name FROM courses ORDER BY code";
        $result = $this->conn->query($query);
        return $result;
    }
}
