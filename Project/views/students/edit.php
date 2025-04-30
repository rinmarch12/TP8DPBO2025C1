<h1 class="mb-4">Edit Mahasiswa</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Form Edit Mahasiswa</h5>
    </div>
    <div class="card-body">
        <form action="index.php?action=students&method=edit&id=<?php echo $this->student->id; ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->student->name; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $this->student->nim; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $this->student->phone; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="join_date" class="form-label">Tanggal Bergabung</label>
                <input type="date" class="form-control" id="join_date" name="join_date" value="<?php echo $this->student->join_date; ?>" required>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                <a href="index.php?action=students" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>