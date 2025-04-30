<h2>Daftar Mata Kuliah</h2>

<div class="mb-3">
    <a href="index.php?action=courses&method=create" class="btn btn-primary">Tambah Mata Kuliah</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>SKS</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['code'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['credits'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>
                            <a href='index.php?action=courses&method=edit&id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='index.php?action=courses&method=delete&id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Anda yakin ingin menghapus mata kuliah ini?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Tidak ada data mata kuliah</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>