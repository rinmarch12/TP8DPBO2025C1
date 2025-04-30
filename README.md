Janji
---
Saya Ririn Marchelina dengan NIM 2303662 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

---
Diagram
---
![diagram mvc](https://github.com/user-attachments/assets/1bb08656-9cfb-47ba-94b8-47abcf4f1801)

---
Alur Program
---
1. Inisialisasi Data:
- Program dimulai dengan file utama yang berfungsi sebagai front controller
- Session dimulai dan controller yang sesuai diinisialisasi berdasarkan URL
2. Menampilkan Halaman:
- Program menentukan halaman yang akan ditampilkan berdasarkan URL
- Jika tidak ada parameter atau mengarah ke halaman utama, menampilkan beranda dengan tombol navigasi
- Jika mengarah ke halaman mahasiswa, mata kuliah, atau pendaftaran, menampilkan daftar masing-masing
- Setiap halaman daftar menampilkan data dalam bentuk tabel dan tombol untuk operasi CRUD
3. Operasi Tambah Data:
- User mengklik tombol tambah data baru
- Sistem menampilkan form untuk input data
- User mengisi form dan submit
- Controller memproses data form dan menyimpannya ke database
- Sistem menampilkan pesan sukses/error dan kembali ke halaman daftar
4. Operasi Edit Data:
- User mengklik tombol edit pada data tertentu
- Controller mengambil data yang akan diedit dari database
- Sistem menampilkan form yang sudah terisi dengan data sebelumnya
- User mengubah data dan submit
- Controller memproses perubahan dan menyimpan ke database
- Sistem menampilkan pesan sukses/error dan kembali ke halaman daftar
5. Operasi Hapus Data:
- User mengklik tombol hapus pada data tertentu
- Controller mengecek relasi data sebelum menghapus, jika pada tabel mahasiswa cek terlebih dahulu apakah masih memiliki pendaftaran mata kuliah dan pada tabel  mata kuliah cek apakah masih ada mahasiswa yang terdaftar
- Jika data masih digunakan, sistem menampilkan pesan error
- Jika tidak digunakan, controller menghapus data dan menampilkan pesan sukses
- Sistem kembali ke halaman daftar
6. Manajemen Notifikasi:
- Semua pesan sukses/error disimpan dalam session
- Sistem menampilkan notifikasi dari session
7. Alur Relasi dan Integritas Data:
- Sistem mencegah penghapusan data yang masih memiliki relasi
- Data pendaftaran mengandung relasi antara mahasiswa dan mata kuliah
- Saat menampilkan daftar pendaftaran, sistem menggabungkan data dari beberapa tabel
8. Template:
- Setiap halaman menggunakan template dasar yang terdiri dari header dan footer
- Header berisi navigasi utama
- Setiap tampilan ditampilkan di dalam struktur template untuk konsistensi

---
Dokumentasi
---
1. Beranda
---
![Screenshot 2025-04-19 184327](https://github.com/user-attachments/assets/29eba61f-f0c2-49f3-ac24-522ea2bd53a1)
---
2. Mahasiswa
---
![Screenshot 2025-04-30 133120](https://github.com/user-attachments/assets/4ba883ec-bcce-46a2-8346-8aec11d19f99)
---
3. Mata Kuliah
---
![Screenshot 2025-04-30 133131](https://github.com/user-attachments/assets/208da61b-3654-465c-921f-e552f3a7c4ca)
---
4. Pendaftaran
---
![Screenshot 2025-04-30 133140](https://github.com/user-attachments/assets/4a9a84c0-ba77-4cf9-8185-a1045c364945)



