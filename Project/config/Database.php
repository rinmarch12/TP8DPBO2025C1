<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "tp_mvc";
    private $conn;

    // Method untuk mendapatkan koneksi database
    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                throw new Exception("Koneksi database gagal: " . $this->conn->connect_error);
            }
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
        return $this->conn;
    }
}