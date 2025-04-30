<h2>Daftar Mahasiswa</h2>

<div class="mb-3">
    <a href="index.php?action=students&method=create" class="btn btn-primary">Tambah Mahasiswa</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Tanggal Bergabung</th>
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
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['join_date'] . "</td>";
                    echo "<td>
                            <a href='index.php?action=students&method=edit&id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='index.php?action=students&method=delete&id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Anda yakin ingin menghapus data mahasiswa ini?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Tidak ada data mahasiswa</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>