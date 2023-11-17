# Milestone 2 WBD Kelompok 9 [PHP APP]

## Deskripsi
Aplikasi LearnIt! adalah sebuah aplikasi LMS yang sisusun untuk memenuhi Tugas Milestone 2 IF3110 Pengembangan Aplikasi Berbasis Web. Aplikasi dapat diakses dengan 3 tipe pengguna: Admin, Pengajar, Pelajar. Admin memiliki kemampuan untuk mengubah semua data. Pengajar bisa membuat, membaca, mengubah, dan menghapus mata kuliah, modul, dan materi. Pelajar dapat mendaftar suatu mata kuliah dan membaca modul serta materi. <br><br>
Aplikasi ini memiliki mode premium dimana pelajar harus melakukan langganan terlebih dahulu dan di-approve oleh Admin. Pengajar yang ingin membuat mata kuliah premium harus melakukan apply yang harus di-approve oleh Admin. Kelebihan dari mata kuliah premium adalah adanya sertifikat penyelesaian yang dapat dikirimkan oleh pengajar mata kuliah berkait. <br><br>
PHP App merupakan aplikasi utama dari aplikasi ini

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
![SignIn Screenshot](screenshots/SignIn.png)
![SignUp Screenshot](screenshots/SignUp.png)
![Profil Screenshot](screenshots/UserProfil.png)
![UbahProfil Screenshot](screenshots/UserUbahProfil.png)
![UserKatalog Screenshot](screenshots/UserKatalog.png)
![UserMyCourses Screenshot](screenshots/UserMyCourses.png)
![UserDetailMatKul Screenshot](screenshots/UserDetailMatKul.png)
![UserDetailModul Screenshot](screenshots/UserDetailModul.png)
![DosenMyCourses Screenshot](screenshots/DosenMyCourses.png)
![DosenDetailMatkul Screenshot](screenshots/DosenDetailMatkul.png)
![DosenAddMatkul Screenshot](screenshots/DosenAddMatkul.png)
![DosenEditMatkul Screenshot](screenshots/DosenEditMatkul.png)
![DosenDetailModul Screenshot](screenshots/DosenDetailModul.png)
![DosenAddModul Screenshot](screenshots/DosenAddModul.png)
![DosenEditModul Screenshot](screenshots/DosenEditModul.png)
![DosenAddMateri Screenshot](screenshots/DosenAddMateri.png)
![DosenEditMateri Screenshot](screenshots/DosenEditMateri.png)
![AdminUserManager Screenshot](screenshots/AdminUserManager.png)
![AdminAddUser Screenshot](screenshots/AdminAddUser.png)
![AdminEditUser Screenshot](screenshots/AdminEditUser.png)
![AdminFakultasManager Screenshot](screenshots/AdminFakultasManager.png)
![AdminAddFakultas Screenshot](screenshots/AdminAddFakultas.png)
![AdminEditFakultas Screenshot](screenshots/AdminEditFakultas.png)

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
      <td>Halaman Admin Pengguna</td>
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
      <td>Halaman Admin Pengguna</td>
      <td>13521083</td>
    </tr>
    <tr>
      <td>Halaman Error</td>
      <td>13521083</td>
    </tr>
  </tbody>
</table>

## Perubahan
- Menghapus prefix `/admin`
- Bug fixes
    - Admin add user
    - Homepage admin menjadi `/users`, bukan `/courses`
- Merapikan routing table, misalkan url API disimpan di `/api/...`
- Button yang berupa hyperlink menjadi benar-benar hyperlink, bukan mengubah `window.location` saat diklik
- Mengubah font size menjadi sesuai dengan desain di Figma
- Mengubah `/profile` dan `/profile/edit` menjadi `/users/:id` dan `/users/:id/edit`
- Mengubah table admin menjadi benar-benar table, bukan div
- Menambahkan halaman detail entitas yang muncul saat baris entitas diklik
