# Panduan Pengerjaan

## Daftar Requirement
1. Docker

## Cara Instalasi
1. Clone _repository_ ini dengan menggunakan perintah `git clone https://github.com/Altair1618/WBD-TB-1-K09.git` (GitHub) atau `https://gitlab.informatika.org/if3110-2023-01-09/wbd-tb-1-k-09.git` (GitLab) pada terminal.
2. Lakukan pembuatan _image_ Docker dengan menjalankan perintah `docker build -t tubes-1:latest .` pada terminal di dalam folder repository.
3. Buatlah sebuah file `.env` yang bersesuaian dengan penggunaan (contoh file tersebut dapat dilihat pada `.env.example`).

## Cara Menjalankan Server
1. Jalankan perintah `docker compose up -d` pada folder repository untuk menjalankan aplikasi dan Adminer
2. Aplikasi dapat dijalankan pada `http://localhost:8008`.
3. Adminer dapat dijalankan pada `http://localhost:8080`.
4. Hentikan aplikasi dengan perintah `docker compose down` pada folder repository.

## Aturan Commit
1. Isi pesan commit dengan pesan yang bermakna
2. Jangan melakukan commit yang terlalu besar
3. Panduan commit: [semantic commit](https://gist.github.com/joshbuchea/6f47e86d2510bce28f8e7f42ae84c716).
