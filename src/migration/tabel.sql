-- Adminer 4.8.1 PostgreSQL 16.0 (Debian 16.0-1.pgdg120+1) dump

CREATE OR REPLACE FUNCTION update_created_updated_timestamp()
RETURNS TRIGGER AS $$
BEGIN
  IF TG_OP = 'INSERT' THEN
    NEW.created_at = NOW();
    NEW.updated_at = NOW();
  ELSIF TG_OP = 'UPDATE' THEN
    NEW.updated_at = NOW();
  END IF;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TABLE IF EXISTS "fakultas";
CREATE TABLE "public"."fakultas" (
    "kode" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "fakultas_kode" PRIMARY KEY ("kode")
) WITH (oids = false);

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."fakultas" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();

DROP TABLE IF EXISTS "mata_kuliah";
CREATE TABLE "public"."mata_kuliah" (
    "kode" character varying(10) NOT NULL,
    "nama" character varying(250) NOT NULL,
    "deskripsi" text,
    "kode_program_studi" character varying(10) NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "mata_kuliah_kode" PRIMARY KEY ("kode")
) WITH (oids = false);

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."mata_kuliah" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();

DROP TABLE IF EXISTS "materi_kelas";
DROP SEQUENCE IF EXISTS materi_kelas_id_seq;
CREATE SEQUENCE materi_kelas_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."materi_kelas" (
    "id" integer DEFAULT nextval('materi_kelas_id_seq') NOT NULL,
    "id_modul" integer NOT NULL,
    "judul_topik" character varying(100) NOT NULL,
    "nama_file" character(255) NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    "tipe" smallint NOT NULL,
    CONSTRAINT "materi_kelas_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."materi_kelas" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();

DROP TABLE IF EXISTS "modul";
DROP SEQUENCE IF EXISTS modul_id_seq;
CREATE SEQUENCE modul_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."modul" (
    "id" integer DEFAULT nextval('modul_id_seq') NOT NULL,
    "kode_mata_kuliah" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    "deskripsi" text NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "modul_id" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."modul" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();

DROP TABLE IF EXISTS "pendaftaran_mata_kuliah";
DROP SEQUENCE IF EXISTS pendaftaran_modul_id_seq;
CREATE SEQUENCE pendaftaran_modul_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."pendaftaran_mata_kuliah" (
    "id" integer DEFAULT nextval('pendaftaran_modul_id_seq') NOT NULL,
    "id_pengguna" integer NOT NULL,
    "kode_mata_kuliah" character varying(6) NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "pendaftaran_modul_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."pendaftaran_mata_kuliah" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();

DROP TABLE IF EXISTS "pengguna";
DROP SEQUENCE IF EXISTS pengguna_id_seq;
CREATE SEQUENCE pengguna_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."pengguna" (
    "id" integer DEFAULT nextval('pengguna_id_seq') NOT NULL,
    "username" character varying(50) NOT NULL,
    "email" character varying(100) NOT NULL,
    "nama" character varying(50) NOT NULL,
    "tipe" smallint NOT NULL,
    "password_hash" character varying(255) NOT NULL,
    "gambar_profil" character varying(255),
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "pengguna_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "pengguna_username" UNIQUE ("username"),
    CONSTRAINT "pengguna_email" UNIQUE ("email")
) WITH (oids = false);

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."pengguna" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();

DROP TABLE IF EXISTS "program_studi";
CREATE TABLE "public"."program_studi" (
    "kode" character varying(3) NOT NULL,
    "kode_fakultas" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "program_studi_kode" PRIMARY KEY ("kode")
) WITH (oids = false);

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."program_studi" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();

ALTER TABLE ONLY "public"."mata_kuliah" ADD CONSTRAINT "mata_kuliah_kode_program_studi_fkey" FOREIGN KEY (kode_program_studi) REFERENCES program_studi(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."materi_kelas" ADD CONSTRAINT "materi_kelas_id_modul_fkey" FOREIGN KEY (id_modul) REFERENCES modul(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."modul" ADD CONSTRAINT "modul_kode_mata_kuliah_fkey" FOREIGN KEY (kode_mata_kuliah) REFERENCES mata_kuliah(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."pendaftaran_mata_kuliah" ADD CONSTRAINT "pendaftaran_mata_kuliah_id_pengguna_fkey" FOREIGN KEY (id_pengguna) REFERENCES pengguna(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."pendaftaran_mata_kuliah" ADD CONSTRAINT "pendaftaran_mata_kuliah_kode_mata_kuliah_fkey" FOREIGN KEY (kode_mata_kuliah) REFERENCES mata_kuliah(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."program_studi" ADD CONSTRAINT "program_studi_kode_fakultas_fkey" FOREIGN KEY (kode_fakultas) REFERENCES fakultas(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

-- 2023-10-04 08:52:00.206518+00
