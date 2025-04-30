<h2>Daftar Pendaftaran Mata Kuliah</h2>

<div class="mb-3">
    <a href="index.php?action=enrollments&method=create" class="btn btn-primary">Tambah Pendaftaran</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Tanggal Pendaftaran</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nim'] . "</td>";
                    echo "<td>" . $row['student_name'] . "</td>";
                    echo "<td>" . $row['course_code'] . "</td>";
                    echo "<td>" . $row['course_name'] . "</td>";
                    echo "<td>" . $row['enrollment_date'] . "</td>";
                    echo "<td>" . ($row['grade'] ?: '-') . "</td>";
                    echo "<td>
                            <a href='index.php?action=enrollments&method=edit&id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='index.php?action=enrollments&method=delete&id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Anda yakin ingin menghapus data pendaftaran ini?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Tidak ada data pendaftaran</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>