<?php

class Seeder {
    private $host = DB_HOST;
    private $name = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $port = DB_PORT;

    private $handle;

    public function __construct($rebuild = false) {
        $this->handle = pg_connect("host=" . $this->host . " dbname=" . $this->name . " user=" . $this->user . " password=" . $this->pass . " port=" . $this->port, PGSQL_CONNECT_FORCE_NEW);

        if ($rebuild) {
            pg_query($this->handle, "DROP SCHEMA public CASCADE");
            pg_query($this->handle, "CREATE SCHEMA public");
            pg_query($this->handle, "GRANT ALL ON SCHEMA public TO postgres");
            pg_query($this->handle, "GRANT ALL ON SCHEMA public TO public");
        }
    }

    public function __destruct() {
        pg_close($this->handle);
    }

    public function seed() {
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/tabel.sql"));
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/fakultas.sql"));
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/prodi.sql"));
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/mata_kuliah.sql"));
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/pengguna.sql"));
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/pendaftaran.sql"));
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/modul.sql"));
        pg_query($this->handle, file_get_contents(__DIR__ . "/../../migration/materi_kelas.sql"));
    }
}

