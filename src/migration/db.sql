-- Adminer 4.8.1 PostgreSQL 16.0 (Debian 16.0-1.pgdg120+1) dump

DROP TABLE IF EXISTS "fakultas";
CREATE TABLE "public"."fakultas" (
    "kode" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    CONSTRAINT "fakultas_kode" PRIMARY KEY ("kode")
) WITH (oids = false);

INSERT INTO "fakultas" ("kode", "nama") VALUES
('STEI',	'Sekolah Teknik Elektro dan Informatika'),
('FTI',	'Fakultas Teknik Industri');

DROP TABLE IF EXISTS "mata_kuliah";
CREATE TABLE "public"."mata_kuliah" (
    "kode" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    "deskripsi" text NOT NULL,
    "kode_program_studi" character varying(10),
    CONSTRAINT "mata_kuliah_kode" PRIMARY KEY ("kode")
) WITH (oids = false);


DROP TABLE IF EXISTS "materi_kelas";
DROP SEQUENCE IF EXISTS materi_kelas_id_seq;
CREATE SEQUENCE materi_kelas_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."materi_kelas" (
    "id" integer DEFAULT nextval('materi_kelas_id_seq') NOT NULL,
    "no_urut_modul" integer NOT NULL,
    "kode_mata_kuliah" character varying(10) NOT NULL,
    "judul_topik" character varying(100) NOT NULL,
    "tipe" smallint NOT NULL,
    "deskripsi" text NOT NULL,
    "nama_file" character(255) NOT NULL,
    CONSTRAINT "materi_kelas_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "modul";
CREATE TABLE "public"."modul" (
    "no_urut" integer NOT NULL,
    "kode_mata_kuliah" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    "deskripsi" text NOT NULL,
    CONSTRAINT "modul_no_urut_kode_mata_kuliah" PRIMARY KEY ("no_urut", "kode_mata_kuliah")
) WITH (oids = false);


DROP TABLE IF EXISTS "pengguna";
DROP SEQUENCE IF EXISTS pengguna_id_seq;
CREATE SEQUENCE pengguna_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."pengguna" (
    "id" integer DEFAULT nextval('pengguna_id_seq') NOT NULL,
    "username" character varying(50) NOT NULL,
    "email" character varying(100) NOT NULL,
    "nama" character varying(50) NOT NULL,
    "tipe" smallint NOT NULL,
    "kode_program_studi" character varying(3),
    "foto_profil" character varying(255),
    CONSTRAINT "pengguna_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "pengguna_username" UNIQUE ("username")
) WITH (oids = false);


DROP TABLE IF EXISTS "program_studi";
CREATE TABLE "public"."program_studi" (
    "kode" character varying(3) NOT NULL,
    "kode_fakultas" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    CONSTRAINT "program_studi_kode" PRIMARY KEY ("kode")
) WITH (oids = false);

INSERT INTO "program_studi" ("kode", "kode_fakultas", "nama") VALUES
('IF',	'STEI',	'Teknik Informatika'),
('II',	'STEI',	'Sistem Teknologi dan Informasi'),
('TI',	'FTI',	'Teknik Industri');

ALTER TABLE ONLY "public"."mata_kuliah" ADD CONSTRAINT "mata_kuliah_kode_fkey" FOREIGN KEY (kode) REFERENCES program_studi(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."materi_kelas" ADD CONSTRAINT "materi_kelas_no_urut_modul_kode_mata_kuliah_fkey" FOREIGN KEY (no_urut_modul, kode_mata_kuliah) REFERENCES modul(no_urut, kode_mata_kuliah) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."modul" ADD CONSTRAINT "modul_kode_mata_kuliah_fkey" FOREIGN KEY (kode_mata_kuliah) REFERENCES mata_kuliah(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."pengguna" ADD CONSTRAINT "pengguna_kode_program_studi_fkey" FOREIGN KEY (kode_program_studi) REFERENCES program_studi(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."program_studi" ADD CONSTRAINT "program_studi_kode_fakultas_fkey" FOREIGN KEY (kode_fakultas) REFERENCES fakultas(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

-- 2023-10-03 13:54:02.748538+00
