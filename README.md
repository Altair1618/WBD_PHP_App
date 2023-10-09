# Milestone 1 WBD Kelompok 9

## Deskripsi
Aplikasi LearnIt! adalah sebuah aplikasi LMS yang sisusun untuk memenuhi Tugas Milestone 1 IF3110 Pengembangan Aplikasi Berbasis Web. Aplikasi dapat diakses dengan 3 tipe pengguna: Admin, Pengajar, Mahasiswa. Admin memiliki kemampuan untuk mengubah semua data. Pengajar bisa membuat, membaca, mengubah, dan menghapus mata kuliah, modul, dan materi. Mahasiswa dapat mendaftar suatu mata kuliah dan membaca modul serta materi.

## Dibuat Oleh:
- [Moch. Sofyan Firdaus (13521083)](https://github.com/msfir)
- [Farhan Nabil Suryono (13521114)](https://github.com/Altair1618)

## Daftar Requirement
1. Docker untuk menjalankan aplikasi
2. Browser untuk membuka aplikasi

## Cara Instalasi
1. Clone _repository_ ini dengan menggunakan perintah `git clone https://github.com/Altair1618/WBD-TB-1-K09.git` (GitHub) atau `https://gitlab.informatika.org/if3110-2023-01-09/wbd-tb-1-k-09.git` (GitLab) pada terminal.
2. Lakukan pembuatan _image_ Docker dengan menjalankan perintah `docker build -t tubes-1:latest .` pada terminal di dalam folder repository.
3. Buatlah sebuah file `.env` yang bersesuaian dengan penggunaan (contoh file tersebut dapat dilihat pada `.env.example`).

## Cara Menjalankan Server
1. Jalankan perintah `docker compose up -d` pada folder repository untuk menjalankan aplikasi dan Adminer
2. Aplikasi dapat dijalankan pada `http://localhost:8008`.
3. Adminer dapat dijalankan pada `http://localhost:8080`.
4. Hentikan aplikasi dengan perintah `docker compose down` pada folder repository.

## Tangkapan Layar Aplikasi

## Pembagian Tugas
### Setup
<table>
  <tbody>
    <tr>
      <td>Docker</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Framework Pengerjaan</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Database</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Models</td>
      <td>13521083</td>
    </tr>
  </tbody>
</table>

### Client-Side
<table>
  <tbody>
    <tr>
      <td>Login</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Register</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Mata Kuliah Saya</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Buat Mata Kuliah</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Ubah Mata Kuliah</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Detail Mata Kuliah</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Buat Modul</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Ubah Modul</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Detail Modul</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Buat Materi</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Ubah Materi</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Katalog</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Profil</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Ubah Profil</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Fakultas</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Prodi</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Mata Kuliah</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Modul</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Materi</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Pengguna</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Pendaftaran</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Error</td>
      <td>13521083</td>
    </tr>
  </tbody>
</table>

### Server-Side
<table>
  <tbody>
    <tr>
      <td>Login</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Register</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Mata Kuliah Saya</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Buat Mata Kuliah</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Ubah Mata Kuliah</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Detail Mata Kuliah</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Buat Modul</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Ubah Modul</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Detail Modul</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Buat Materi</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Ubah Materi</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Katalog</td>
      <td>13521114</td>
    </tr>
    <tr>
      <td>Halaman Profil</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Ubah Profil</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Fakultas</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Prodi</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Mata Kuliah</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Modul</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Materi</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Pengguna</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Admin Pendaftaran</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Error</td>
      <td>13521083</td>
    </tr>
  </tbody>
</table>
