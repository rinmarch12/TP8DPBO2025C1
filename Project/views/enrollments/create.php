<h1 class="mb-4">Tambah Pendaftaran Mata Kuliah</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Tambah Pendaftaran</h5>
    </div>
    <div class="card-body">
        <form action="index.php?action=enrollments&method=create" method="post">
            <div class="mb-3">
                <label for="student_id" class="form-label">Mahasiswa</label>
                <select class="form-select" id="student_id" name="student_id" required>
                    <option value="">Pilih Mahasiswa</option>
                    <?php
                    while ($student = $students->fetch_assoc()) {
                        echo "<option value='{$student['id']}'>{$student['name']} ({$student['nim']})</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="course_id" class="form-label">Mata Kuliah</label>
                <select class="form-select" id="course_id" name="course_id" required>
                    <option value="">Pilih Mata Kuliah</option>
                    <?php
                    while ($course = $courses->fetch_assoc()) {
                        echo "<option value='{$course['id']}'>{$course['code']} - {$course['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="enrollment_date" class="form-label">Tanggal Pendaftaran</label>
                <input type="date" class="form-control" id="enrollment_date" name="enrollment_date" required>
            </div>
            
            <div class="mb-3">
                <label for="grade" class="form-label">Nilai (opsional)</label>
                <select class="form-select" id="grade" name="grade">
                    <option value="">Belum ada nilai</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                <a href="index.php?action=enrollments" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>