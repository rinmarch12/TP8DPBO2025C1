<h1 class="mb-4">Tambah Mata Kuliah</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Tambah Mata Kuliah</h5>
    </div>
    <div class="card-body">
        <form action="index.php?action=courses&method=create" method="post">
            <div class="mb-3">
                <label for="code" class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="mb-3">
                <label for="credits" class="form-label">Jumlah SKS</label>
                <input type="number" class="form-control" id="credits" name="credits" min="1" max="6" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                <a href="index.php?action=courses" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>