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

INSERT INTO "fakultas" ("kode", "nama") VALUES
('STEI',	'Sekolah Teknik Elektro dan Informatika'),
('FTI',	'Fakultas Teknik Industri'),
('FITB',	'Fakultas Ilmu dan Teknologi Kebumian'),
('FMIPA',	'Fakultas Matematika dan Ilmu Pengetahuan Alam'),
('FSRD',	'Fakultas Seni Rupa dan Desain'),
('FTMD',	'Fakultas Teknik Mesin dan Dirgantara'),
('FTTM',	'Fakultas Teknik Pertambangan dan Perminyakan'),
('FTSL',	'Fakultas Teknik Sipil dan Lingkungan'),
('SAPPK',	'Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan'),
('SBM',	'Sekolah Bisnis dan Manajemen'),
('SF',	'Sekolah Farmasi'),
('SITH',	'Sekolah Ilmu dan Teknologi Hayati'),
('SPS', 'Sekolah Pascasarjana'),
('NONFS', 'Non Fakultas');

DELIMITER ;;

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."fakultas" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();;

DELIMITER ;

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


DELIMITER ;;

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."mata_kuliah" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();;

DELIMITER ;

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


DELIMITER ;;

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."materi_kelas" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();;

DELIMITER ;

DROP TABLE IF EXISTS "modul";
CREATE TABLE "public"."modul" (
    "id" integer NOT NULL,
    "kode_mata_kuliah" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    "deskripsi" text NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "modul_id" PRIMARY KEY ("id")
) WITH (oids = false);


DELIMITER ;;

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."modul" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();;

DELIMITER ;

DROP TABLE IF EXISTS "pendaftaran_mata_kuliah";
DROP SEQUENCE IF EXISTS pendaftaran_modul_id_seq;
CREATE SEQUENCE pendaftaran_modul_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."pendaftaran_mata_kuliah" (
    "id" integer DEFAULT nextval('pendaftaran_modul_id_seq') NOT NULL,
    "id_pengguna" integer NOT NULL,
    "kode_mata_kuliah" character varying(3) NOT NULL,
    "created_at" integer,
    "updated_at" integer,
    CONSTRAINT "pendaftaran_modul_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DELIMITER ;;

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."pendaftaran_mata_kuliah" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();;

DELIMITER ;

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


DELIMITER ;;

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."pengguna" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();;

DELIMITER ;

DROP TABLE IF EXISTS "program_studi";
CREATE TABLE "public"."program_studi" (
    "kode" character varying(3) NOT NULL,
    "kode_fakultas" character varying(10) NOT NULL,
    "nama" character varying(100) NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    CONSTRAINT "program_studi_kode" PRIMARY KEY ("kode")
) WITH (oids = false);

INSERT INTO program_studi (kode, kode_fakultas, nama) VALUES
('101', 'FMIPA', 'Matematika'),
('102', 'FMIPA', 'Fisika'),
('103', 'FMIPA', 'Astronomi'),
('105', 'FMIPA', 'Kimia'),
('108', 'FMIPA', 'Aktuaria'),
('160', 'FMIPA', 'Tahap Tahun Pertama FMIPA'),
('201', 'FMIPA', 'Matematika'),
('202', 'FMIPA', 'Fisika'),
('203', 'FMIPA', 'Astronomi'),
('205', 'FMIPA', 'Kimia'),
('208', 'FMIPA', 'Aktuaria'),
('209', 'FMIPA', 'Sains Komputasi'),
('246', 'FMIPA', 'Pengajaran Matematika'),
('247', 'FMIPA', 'Pengajaran Fisika'),
('248', 'FMIPA', 'Pengajaran Kimia'),
('249', 'FMIPA', 'Ilmu dan Rekayasa Nuklir'),
('301', 'FMIPA', 'Matematika'),
('302', 'FMIPA', 'Fisika'),
('303', 'FMIPA', 'Astronomi'),
('305', 'FMIPA', 'Kimia'),
('349', 'FMIPA', 'Rekayasa Nuklir'),
('104', 'SITH', 'Mikrobiologi'),
('106', 'SITH', 'Biologi'),
('112', 'SITH', 'Rekayasa Hayati'),
('114', 'SITH', 'Rekayasa Pertanian'),
('115', 'SITH', 'Rekayasa Kehutanan'),
('119', 'SITH', 'Teknologi Pasca Panen'),
('161', 'SITH', 'Tahap Tahun Pertama SITH'),
('198', 'SITH', 'Tahap Tahun Pertama SITH'),
('206', 'SITH', 'Biologi'),
('211', 'SITH', 'Bioteknologi'),
('213', 'SITH', 'Biomanajemen'),
('306', 'SITH', 'Biologi'),
('107', 'SF', 'Sains dan Teknologi Farmasi'),
('116', 'SF', 'Farmasi Klinik dan Komunitas'),
('162', 'SF', 'Tahap Tahun Pertama SF'),
('907', 'SF', 'Profesi Apoteker'),
('207', 'SF', 'Farmasi'),
('217', 'SF', 'Keolahragaan'),
('218', 'SF', 'Farmasi Industri'),
('307', 'SF', 'Farmasi'),
('121', 'FTTM', 'Teknik Pertambangan'),
('122', 'FTTM', 'Teknik Perminyakan'),
('123', 'FTTM', 'Teknik Geofisika'),
('125', 'FTTM', 'Teknik Metalurgi'),
('164', 'FTTM', 'Tahap Tahun Pertama FTTM'),
('221', 'FTTM', 'Rekayasa Pertambangan'),
('222', 'FTTM', 'Teknik Perminyakan'),
('223', 'FTTM', 'Teknik Geofisika'),
('225', 'FTTM', 'Teknik Metalurgi'),
('226', 'FTTM', 'Teknik Geotermal'),
('321', 'FTTM', 'Rekayasa Pertambangan'),
('322', 'FTTM', 'Teknik Perminyakan'),
('323', 'FTTM', 'Teknik Geofisika'),
('120', 'FITB', 'Teknik Geologi'),
('128', 'FITB', 'Meteorologi'),
('129', 'FITB', 'Oseanografi'),
('151', 'FITB', 'Teknik Geodesi dan Geomatika'),
('163', 'FITB', 'Tahap Tahun Pertama FITB'),
('220', 'FITB', 'Teknik Geologi'),
('224', 'FITB', 'Sains Kebumian'),
('227', 'FITB', 'Teknik Air Tanah'),
('251', 'FITB', 'Teknik Geodesi dan Geomatika'),
('320', 'FITB', 'Teknik Geologi'),
('324', 'FITB', 'Sains Kebumian'),
('351', 'FITB', 'Teknik Geodesi dan Geomatika'),
('130', 'FTI', 'Teknik Kimia'),
('133', 'FTI', 'Teknik Fisika'),
('134', 'FTI', 'Teknik Industri'),
('143', 'FTI', 'Teknik Pangan'),
('144', 'FTI', 'Manajemen Rekayasa'),
('145', 'FTI', 'Teknik Bioenergi dan Kemurgi'),
('167', 'FTI', 'Tahap Tahun Pertama FTI'),
('230', 'FTI', 'Teknik Kimia'),
('233', 'FTI', 'Teknik Fisika'),
('234', 'FTI', 'Teknik dan Manajemen Industri'),
('238', 'FTI', 'Instrumentasi dan Kontrol'),
('294', 'FTI', 'Logistik'),
('330', 'FTI', 'Teknik Kimia'),
('333', 'FTI', 'Teknik Fisika'),
('334', 'FTI', 'Teknik dan Manajemen Industri'),
('132', 'STEI', 'Teknik Elektro'),
('135', 'STEI', 'Teknik Informatika'),
('165', 'STEI', 'Tahap Tahun Pertama STEI'),
('180', 'STEI', 'Teknik Tenaga Listrik'),
('181', 'STEI', 'Teknik Telekomunikasi'),
('182', 'STEI', 'Sistem dan Teknologi Informasi'),
('183', 'STEI', 'Teknik Biomedis'),
('196', 'STEI', 'Tahap Tahun Pertama STEI'),
('232', 'STEI', 'Teknik Elektro'),
('235', 'STEI', 'Informatika'),
('332', 'STEI', 'Teknik Elektro dan Informatika'),
('131', 'FTMD', 'Teknik Mesin'),
('136', 'FTMD', 'Teknik Dirgantara'),
('137', 'FTMD', 'Teknik Material'),
('169', 'FTMD', 'Tahap Tahun Pertama FTMD'),
('231', 'FTMD', 'Teknik Mesin'),
('236', 'FTMD', 'Teknik Dirgantara'),
('237', 'FTMD', 'Ilmu dan Teknik Material'),
('331', 'FTMD', 'Teknik Mesin'),
('336', 'FTMD', 'Teknik Dirgantara'),
('337', 'FTMD', 'Ilmu dan Teknik Material'),
('150', 'FTSL', 'Teknik Sipil'),
('153', 'FTSL', 'Teknik Lingkungan'),
('155', 'FTSL', 'Teknik Kelautan'),
('157', 'FTSL', 'Rekayasa Infrastruktur Lingkungan'),
('158', 'FTSL', 'Teknik dan Pengelolaan Sumber Daya Air'),
('166', 'FTSL', 'Tahap Tahun Pertama FTSL'),
('250', 'FTSL', 'Teknik Sipil'),
('253', 'FTSL', 'Teknik Lingkungan'),
('255', 'FTSL', 'Teknik Kelautan'),
('257', 'FTSL', 'Pengelolaan Infrastruktur Air Bersih dan Sanitasi'),
('258', 'FTSL', 'Pengelolaan Sumberdaya Air (PSDA)'),
('269', 'FTSL', 'Sistem dan Teknik Jalan Raya'),
('350', 'FTSL', 'Teknik Sipil'),
('353', 'FTSL', 'Teknik Lingkungan'),
('152', 'SAPPK', 'Arsitektur'),
('154', 'SAPPK', 'Perencanaan Wilayah dan Kota'),
('199', 'SAPPK', 'Tahap Tahun Pertama SAPPK'),
('240', 'SAPPK', 'Studi Pembangunan'),
('242', 'SAPPK', 'Transportasi'),
('252', 'SAPPK', 'Arsitektur'),
('254', 'SAPPK', 'Perencanaan Wilayah dan Kota'),
('256', 'SAPPK', 'Rancang Kota'),
('288', 'SAPPK', 'Perencanaan Kepariwisataan'),
('289', 'SAPPK', 'Arsitektur Lanskap'),
('342', 'SAPPK', 'Transportasi'),
('352', 'SAPPK', 'Arsitektur'),
('354', 'SAPPK', 'Perencanaan Wilayah dan Kota'),
('168', 'FSRD', 'Tahap Tahun Pertama FSRD'),
('170', 'FSRD', 'Seni Rupa'),
('172', 'FSRD', 'Kriya'),
('173', 'FSRD', 'Desain Interior'),
('174', 'FSRD', 'Desain Komunikasi Visual'),
('175', 'FSRD', 'Desain Produk'),
('270', 'FSRD', 'Seni Rupa'),
('271', 'FSRD', 'Desain'),
('370', 'FSRD', 'Ilmu Seni Rupa dan Desain'),
('190', 'SBM', 'Manajemen'),
('192', 'SBM', 'Kewirausahaan'),
('197', 'SBM', 'Tahap Tahun Pertama SBM'),
('290', 'SBM', 'Sains Manajemen'),
('291', 'SBM', 'Administrasi Bisnis'),
('293', 'SBM', 'Administrasi Bisnis (Kampus Jakarta)'),
('390', 'SBM', 'Sains Manajemen'),
('287', 'SPS', 'Teknologi Nano'),
('387', 'SPS', 'Sains dan Teknologi Nano'),
('100', 'NONFS', 'Non Reguler S1'),
('179', 'NONFS', 'Mata Kuliah Umum (MKU)'),
('800', 'NONFS', 'IVC'),
('900', 'NONFS', 'Program Profesi Insinyur'),
('914', 'NONFS', 'PPI'),
('915', 'NONFS', 'PPI'),
('920', 'NONFS', 'PPI'),
('921', 'NONFS', 'PPI'),
('922', 'NONFS', 'PPI'),
('923', 'NONFS', 'PPI'),
('925', 'NONFS', 'PPI'),
('930', 'NONFS', 'PPI'),
('931', 'NONFS', 'PPI'),
('932', 'NONFS', 'PPI'),
('933', 'NONFS', 'PPI'),
('934', 'NONFS', 'PPI'),
('935', 'NONFS', 'PPI'),
('936', 'NONFS', 'PPI'),
('937', 'NONFS', 'PPI'),
('950', 'NONFS', 'PPI'),
('951', 'NONFS', 'PPI'),
('953', 'NONFS', 'PPI'),
('954', 'NONFS', 'PPI'),
('955', 'NONFS', 'PPI'),
('200', 'NONFS', 'Non Reguler S2');

DELIMITER ;;

CREATE TRIGGER "add_created_updated_timestamp" BEFORE INSERT OR UPDATE ON "public"."program_studi" FOR EACH ROW EXECUTE FUNCTION update_created_updated_timestamp();;

DELIMITER ;

ALTER TABLE ONLY "public"."mata_kuliah" ADD CONSTRAINT "mata_kuliah_kode_program_studi_fkey" FOREIGN KEY (kode_program_studi) REFERENCES program_studi(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."materi_kelas" ADD CONSTRAINT "materi_kelas_id_modul_fkey" FOREIGN KEY (id_modul) REFERENCES modul(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."modul" ADD CONSTRAINT "modul_kode_mata_kuliah_fkey" FOREIGN KEY (kode_mata_kuliah) REFERENCES mata_kuliah(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."pendaftaran_mata_kuliah" ADD CONSTRAINT "pendaftaran_mata_kuliah_id_fkey" FOREIGN KEY (id) REFERENCES pengguna(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."pendaftaran_mata_kuliah" ADD CONSTRAINT "pendaftaran_mata_kuliah_kode_mata_kuliah_fkey" FOREIGN KEY (kode_mata_kuliah) REFERENCES mata_kuliah(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."program_studi" ADD CONSTRAINT "program_studi_kode_fakultas_fkey" FOREIGN KEY (kode_fakultas) REFERENCES fakultas(kode) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

-- 2023-10-04 08:52:00.206518+00
