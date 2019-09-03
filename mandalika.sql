-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2019 at 02:18 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandalika`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_log`
--

CREATE TABLE `tabel_log` (
  `log_id` int(11) NOT NULL,
  `log_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_user` varchar(255) DEFAULT NULL,
  `log_tipe` int(11) DEFAULT NULL COMMENT '0=login, 11 = logout, 12=update_password, 1= edit, 2 = hapus, 3 = tambah',
  `log_desc` varchar(255) DEFAULT NULL,
  `old_value` longtext NOT NULL,
  `new_value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_log`
--

INSERT INTO `tabel_log` (`log_id`, `log_time`, `log_user`, `log_tipe`, `log_desc`, `old_value`, `new_value`) VALUES
(1, '2019-09-03 10:59:26', '26', 0, 'user has logined', '', '{\"username\":\"nurdiana\",\"nama\":\"Nurdiana\",\"level\":\"Admin\",\"id_user\":\"26\",\"is_logedin\":false}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `level` varchar(20) DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `level`, `password_changed`, `aktif`) VALUES
(26, 'nurdiana', 'f2236cde04bd2f79f5566473614f17e7', 'Nurdiana', 'Admin', 0, 1),
(44, 'muis', 'd33c0a8c3870a644d482a382623903dd', 'M. Nur Muis', 'Admin', 0, 1),
(45, 'yushi', '7378c2bfcb385d9f8c5c1c7822cfd1d4', 'M. Yushi Ansani', 'Admin', 0, 1),
(46, 'Oka', '1abd0eda64436843398c234af4f30a81', 'I Made Oka Suwartana', 'Admin', 0, 1),
(47, 'kep', '94da4376f0d738db16804f11001b0284', 'PIC  kepatuhan testing', 'PIC', 0, 1),
(48, 'kep2', '94da4376f0d738db16804f11001b0284', 'user kepatuhan testing', 'User', 0, 0),
(49, 'cabang', 'f74e4339be40ffd3b2a263873e653be4', 'user cabang', 'User', 0, 1),
(89, 'oka.tsi@gmail.com', '3c9f45d59981f2e6ab9926e613e6f6bf', 'mas oka', 'Admin', 0, 1),
(90, 'diananur550@gmail.com', '5f830029e51abc4155a5f91ce3738aa2', 'diana', 'Admin', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id_log` int(11) NOT NULL,
  `id_pic` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aksi` longtext NOT NULL,
  `old_value` longtext DEFAULT NULL,
  `new_value` longtext DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE `values` (
  `id_values` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `text_values` longtext NOT NULL,
  `link` varchar(250) NOT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` text NOT NULL,
  `publish` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`id_values`, `judul`, `text_values`, `link`, `tanggal_post`, `keterangan`, `publish`) VALUES
(1, 'Bayar Pajak Kendaraan Bisa via ATM Bank NTB Syariah', '<p><strong>Mataram (Lombok Post)</strong>&nbsp;&ndash; Para pemilik kendaraan bermotor kini bisa membayar pajak lewat ATM Bank NTB Syariah. Sistem pembayaran pajak kendaraan secara online atau e-Samsat itu diluncurkan Badan Pengelolaan Pendapatan Daerah (Bappenda) NTB Syariah, dalam peringatan HUT RI ke-72 di Kantor Gubernur NTB, kemarin (17/8).</p>\r\n\r\n<p>Kepadal Bappenda NTB H. Iswandi menjelaskan, e-Samsat merupakan salah satu fasilitas untuk pembayaran pajak kendaraan bermotor menggunakan ATM Bank NTB Syariah. Artinya, warga sudah bisa dilayani 24 jam untuk pembayaran pajak. Pelayanan itu sudah bisa diakses warga sejak diluncurkan, kemarin.</p>\r\n\r\n<p>&ldquo;Jadi program unggulan Bappenda untuk mewujudkan non stop service seduah terwujud,&rdquo; katanya. Selain itu, dengan e-Samsat bertujuan untuk mendorong masyarakat melakukan transaksi non-tunai. Sehingga wajib pajak akan mendapatkan kemudahan dalam membayar pajak, dan nilai pajak yang akan dibayarkan itu bisa langsung diketahui di dalam mesin ATM.</p>\r\n\r\n<p>Saat ini, kerja sama baru dilakukan dengan Bank NTB&nbsp;Syariah sebagai bank yang mengelola kas daerah. &ldquo;Warga cukup membayar pajak lewat ATM Bank NTB Syariah,&rdquo; katanya.</p>\r\n\r\n<p>Sementara itu, Direktur Utama Bank NTB&nbsp;Syariah H. Komari Subakir menambahkan, e-Samsat dikembangkan untuk memberikan kemudahan. Pihaknya menyiapkan aplikasi di ATM, sehingga warga tidak perlu membayar dengan uang tunai.</p>\r\n', 'Bayar-Pajak-Kendaraan-Bisa-via-ATM-Bank-NTB-Syariah', '2019-01-21 02:38:04', 'siaran_pers', '1'),
(2, 'Bank NTB Syariah Bagi Dividen Sebesar Rp.142 Miliar', '<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><strong><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Mataram (Lombok Post)</span></span></strong><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">&nbsp;&ndash; PT. Bank NTB SYARIAH tahun ini akan membagikan dividen sebesar Rp 142 miliar kepada seluruh pemegang saham. Besaran dividen tersebut disetujui dalam Rapat Umum Pemegang Saham (RUPS) Bank NTB SYARIAH tahun buku 2016, yang dihadiri Wakil Gubernur NTB SYARIAH H. Muhammad Amin di Hotel Golden Tulip Mataram, kemarin (23/5).</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Dari dividen sebesar Rp 142 miliar itu, RUPS juga menyetujui sebanyak Rp 71 miliar dividen tersebut menjadi modal yang disetorkan kembali pemegang saham ke Bank NTB SYARIAH.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">&ldquo;Pemegang saham mengapresiasi kinerja Bank NTB SYARIAH. Diharapkan kinerja ke depan lebih baik lagi,&rdquo; kata Wakil Gubernur NTB SYARIAH H. Muhammad Amin usai mengikuti RUPS kemarin.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">RUPS tersebut kata dia merupakan agenda pengesahan atas laporan pertanggungjawaban direksi PT. Bank NTB SYARIAH tahun buku 2016 kepada pemegang saham dan digelar pada setiap akhir tahun buku. Selain Wagub, RUPS dihadiri oleh seluruh pemegang saham atau pejabat yang diberi kuasa. Seperti diketahui, saham Bank NTB SYARIAH dimiliki Pemprov NTB SYARIAH dan seluruh pemerintah daerah di NTB SYARIAH.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">&ldquo;Catatan penting yang perlu diperhatikan bagaimana memberikan pelayanan terbaik dan harus kompetitif dengan bank lain,&rdquo; tandas Wagub lagi.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Pihaknya melihat dari hasil paparan dalam RUPS, kinerja Bank NTB SYARIAH sudah cukup baik dan progresif. Dan karena itu kata Wagub, semua yang sudah mengalami pertumbuhan tentunya harus bisa ditingkatkan dengan mempertahankan yang sudah baik. &ldquo;Yang penting penting memperbaiki dan meyempurnakan terutama memperluas ekspansi peluang bisnis perbankan yang lebih luar,&rdquo; jelasnya.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Di tempat yang sama, Direktur Utama Bank NTB SYARIAH H. Komari Subakir mengatakan dalam Tahun Buku 2016 sampai dengan triwlan I 2017, secara keseluruhan hasil kinerja bank menunjukkan pertumbuhan yang positif. Aset bank tahun 2016 meningkat 25,17 persen dari Rp 6,11 triliun pada 2015 menjadi Rp 7,649 triliun. Sementara pada triwulan I 2017 sudah meingkat 15,66 persen pada triwulan I 2017 menjadi Rp 8,846 triliun. &ldquo;Peningkatan tersebut terutama disebabkan oleh peningkatan Dana Pihak Ketiga (DPK) dan modal khususnya dana tambahan modal disetor.&rdquo; jelasnya.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Ia menjelaskan DPK merupakan simpanan nasabah yang dipercayakan kepada Bank dalam bentuk giro, tabungan dan deposito. Jumlah DPK pada tahun 2016 meningkat 14,26 persen dari Rp 4,561 triliun pda tahun 2015 menjadi Rp 5,211 triliun. Sementara pada triwulan I 2017 juga telah tumbuh mejadi Rp 7,263 triliun.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Komari menegaskan, kebijakan dalam pengelolaan simpanan nasabah adalah meningkatkan daya saing dengan tetap berorientasi pada penghimpunan dana murah yaitu dana retail. Termasuk meingkatkan penghimpunan dana di luar dana pemerintah daerah dengan tetap mempertahankan dana-dana pemda. Dari sisi kredit yang diberikan, apabila dibandingkan dengan periode yang sama tahun sebelumnya juga meingkat hingga 10,62 persen. Tahun 2015, jumlah kredit yang disalurkan Rp 4,6 triliun. Sementara akhir 2016 telah mencapai Rp 5 triliun. Dari jumlah kredit yang disalurkan tersebut, sebanyak Rp 791 miliar merupakan pembiayaan produktif. Sementara Rp 4,29 triliun merupakan kredit konsumtif.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Sejalan dengan upaya lebih menyalurkan kredit pada sektor produktif, maka pada triwulan I 2017 kata Komari, khusus sektor produktif mengalami peningkatan dengan capaian Rp 795 miliar. Yang berarti pencairan kredit secara bulanan mencapai Rp 157 miliar dengan komposisi kredit produktif Rp 31 miliar dan kredit konsumtif Rp 125 miliar. &ldquo;Produk kredit yang menjadi prioritas penyaluran dalam tahun 2016 adalah kredit program pemerintah yang merupakan program pemerintah pusat yaitu Kredit Usaha Rakyat (KUR) dan KPR-FLPP,&rdquo; tambahnya.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Bank NTB SYARIAH ditetapkan Bank Penyalur KUR dalam tahun 2016 pada sektor 1 yaitu pertanian, perkebunan dan kehutanan. Selain itu juga untuk sektor 2 yaitu perikanan dan kelautan yang sejalan dengan prioritas program unggulan pemerintah daerah yaitu PIJAR (sapi, jagung, rumput laut).</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Tahun 2016 Bank NTB SYARIAH telah menyalurkan KUR sebesar Rp 31,887 miliar atau 79,72 persen dari target. KUR disalurkan kepada pelaku usaha mikro sebesar Rp 15,012 miliar yang realisasinya 100,08 persen dari target dan KUR Ritel sebesar Rp 16,875 miliar sebesar 67,50 persen dari target.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Komoditas yang dibiayai melalui KUR antara lain jagung, cabai, sapi, ikan, dan rumput laut. Fasilitas KUR dalam tahun 2017 terus berjalan dengan peningkatan target menjadi sebesar Rp 100 miliar. &ldquo;Share terbesar pada komoditas jagung mencapai 79 persen dengan pembiayaan tersebar di beberapa kabupaten yaitu Dompu, Bima, Sumbawa, Lombok Timur, dan Lombok Utara,&rdquo; terang Komari.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Fasilitas Kredit Pemilikan Rumah untuk masyarakat berpenghasilan rendah (KPR-FLPP) juga menjadi prioritas penyaluran kredit Bank NTB SYARIAH. Tahun 2012 dengan tahap awal sebagai pilot project adalah pembangunan perumahan untuk PNS di Kabupaten Sumbawa Barat yaitu kerja sama antara Pemkab Sumbawa Barat, Perum Perumnas dan Bank NTB SYARIAH. Dalam upaya percepatan penyaluran, Bank NTB SYARIAH telah melakukan kerja sama dengan beberapa developer. Saat ini dengan PT. Baiti Jannati untuk pembangunan perumahan KPR-FLPP dan perumahan komersial di Desa Moyo, Kecamatan Moyo Hilir, Kabupaten Sumbawa dengan rencana pembangunan sebanyak 1.058 unit rumah.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Dalam tahun 2017, produk kredit yang menjadi prioritas dalam penyalurannya pada tahun 2016 juga masih menjadi prioritas. Antara lain kredit pada pelaku usaha di beberapa desa wisata seperti Sembalun di Lombok Timur, Bile Bante di Lombok Tengah dan Sesaot di Lombok Barat yang merupakan mitra binaan dai kerja sama antara Universitas Mataram dan GIZ. Ada juga kerja sama dengan Lembaga Pengelola Dana Bergulir (LPDB) Kementerian Koperasi dan UMKM RI dalam rangka pinjaman dana untuk penyaluran kredit kepada pelaku KUMKM sebesar Rp 200 miliar. &ldquo;Program ini dimaksudkan untuk mendapatkan pendanaan murah dan penyaluran dapat juga dilakukan dengan sistem pembiayaan syariah,&rdquo; jelasnya.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Khusus untuk perolehan laba bank tahun 2016 meningkat 1,39 persen. Tahun 2015, laba Bank NTB SYARIAH sebesar Rp 225 miliar dan tahun 2016 ini menjadi 228 miliar. Rendahnya pertumbuhan laba usaha disebabkan pengaruh tingginya&nbsp;<em>cost of fund</em>&nbsp;dan belum optimalnya penggunaan modal karena sebagian besar setoran dilakukan pada akhir tahun. Sedangkan dalam pemenuhan modal inti, target tahun 2016 sesuai action plan sebesar Rp 1,15 triliun dan telah terpenuhi 106,86 persen atau sebesar Rp 1,229 triliun. Sementara pada triwulan I 2017 tercatat modal inti sebesar Rp 1,282 triliun. &ldquo;Terpenuhinya target modal inti adalah wujud dari dukungan pada pemegang saham dalam upaya untuk meningkatkan bisnis Bank sehingga mampi berperan dalam mendukung pertumbuhan perekonomian daerah,&rdquo; katanya.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Sementara itu, Rasio Kecukupan Modal (CAR) mencapai 31,17 persen pada tahun 2016, meningkat dibandingkan tahun 2015 yaitu sebesar 27,12 persen. Besarnya rasio CAR menunjukkan Bank memiliki ketahanan modal yang kuat dalam meng-<em>cover</em>&nbsp;risiko yang mungkin timbul. Rasio LDR Keberadaan Bank NTB SYARIAH sebagai lembaga intermediasi keuangan ditunjukkan dengan besarnya rasio LDR yang tercatat sebesar 97,66 persen pada tahun 2016.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Turunnya besaran rasio LDR dibandingkan pada tahun 2015 yaitu sebesar 100,87 persen menunjukkan rasio LDR yang semakin baik. &ldquo;Dalam melakukan ekspansi penyaluran kredit, maka Bank mengimbangi dengan meningkatkan penghimpunan dana,&rdquo; terangnya. Besarnya rasio profitabilitas (ROA dan ROE) pada tahun 2016 tercatat 3,95 persen dan 20,76 persen. Ini turun dari besarnya rasio ROA dan ROE tahun 2016 yaitu 4,27 persen dan 26,48 persen yang disebabkan masih besarnya beban&nbsp;<em>cost of fund</em>.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Tentunya ini berpengaruh pada pertumbuhan laba bank, dan belum dapat dimanfaatkannya modal secara maksimal dikarenakan setoran yang diterima pada akhir tahun. &ldquo;Terakhir Rasio Biaya Operasional terhadap Pendapatan Operasional (BOPO) pada tahun 2016 tercatat sebesar 68,69 persen, rasio BOPO terjaga dengan baik yakni lebih baik dari rata-rata industri yaitu 75 persen,&rdquo; tandasnya. (<strong>nur/adv/r8</strong>)</span></span></span></span></p>\r\n', 'Bank-NTB-Syariah-Bagi-Dividen-Sebesar-Rp.142-Miliar', '2019-01-21 03:07:33', 'siaran_pers', '1'),
(6, 'Lelang Pengadaan Mesin ATM Bank NTB Syariah 2019', '<p><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">PT. Bank NTB Syariah mengacu pada peraturan-peraturan yang berlaku di PT. Bank NTB Syariah akan mengadakan &ldquo;Pelelangan Umum&rdquo; dengan ketentuan sebagai berikut :</span></span></span></span></span></p>\r\n\r\n<ol>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Lingkup Pekerjaan<br />\r\n	Pekerjaan : Pengadaan 64 unit Mesin ATM PT. Bank NTB Syariah<br />\r\n	Sumber Dana : Dana Internal PT. Bank NTB Syariah</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Syarat-Syarat Peserta Lelang antara lain</span></span></span></span></span><br />\r\n	<span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">a. Menyerahkan copy Akte Pendirian dan Perubahan Terakhir</span></span></span></span></span><br />\r\n	<span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">b. Menyerahkan copy SIUP yang masih berlaku</span></span></span></span></span><br />\r\n	<span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">c. Menyerahkan copy TDP yang masih berlaku</span></span></span></span></span><br />\r\n	<span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">d. Menyerahkan copy NPWP yang masih berlaku</span></span></span></span></span><br />\r\n	<span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">e. Mempunyai tenaga service tetap yang berdomisili di Mataram</span></span></span></span></span><br />\r\n	<span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">f. Merk yang ditawarkan adalah merk yang saat ini dipakai di Bank NTB Syariah</span></span></span></span></span><br />\r\n	<span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">g. Syarat lainnya dapat dilihat pada Dokumen Pengadaan (RKS) yang sekaligus berfungsi sebagai penjelasan pekerjaan</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Pendaftaran serta pengambilan Dokumen Pengadaan (RKS) dilaksanakan sampai dengan tanggal 31 Januari 2019 melalui email divisiumumbankntb@gmail.com</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Pemberian penjelasan Dokumen Pengadaan (Aanwizjing):<br />\r\n	Hari / Tanggal : Kamis, 31 Januari 2019<br />\r\n	Pukul&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 14:00 WITA<br />\r\n	Tempat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Ruang Rapat Kantor Pusat PT. Bank NTB Syariah</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Informasi lebih lanjut dapat menghubungi :<br />\r\n	Panitia Pengadaan Barang/Jasa PT. Bank NTB Syariah<br />\r\n	Cq. Divisi Umum Bank NTB, Jl. Pejanggik No.30 Mataram<br />\r\n	Telepon : 0370-636331, Fax : 0370-648794</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Pengumuman Pelelangan Umum dan Dokumen Pengadaan (RKS) dapat diunduh melalui link di bawah.</span></span></span></span></span></li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n', 'Lelang-Pengadaan-Mesin-ATM-Bank-NTB-Syariah-2019', '2019-01-25 04:32:08', 'lelang_pengadaan', '1'),
(9, 'Lelang Ulang Renovasi Rumah Dinas dan Pembangunan Gedung Arsip KC. Sumbawa', '<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Menunjuk Berita Acara Pemasukan dan Pembukaan Penawaran Pekerjaan Renovasi Rumah Dinas dan Pembangunan Gedung Arsip KC. Sumbawa Nomor BA/01.10/60/0061/2017 tanggal 23 Maret 2017, bahwa yang melakukan penawaran kurang dari persyaratan, maka PT. Bank NTB Syariah akan mengadakan ulang Pemilihan Langsung.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Adapun untuk pasca kualifikasi serta serta syarat peserta silahkan download pengumuman di bawah</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Lelang-Ulang-Renovasi-Rumah-Dinas-dan-Pembangunan-Gedung-Arsip-KC.-Sumbawa', '2019-01-25 08:58:58', 'lelang_pengadaan', '1'),
(10, 'Kesempatan Mengembangkan Karir di Bank NTB Syariah', '<p>Assalamualaikum warrahmatullahi wabarakatuh</p>\r\n\r\n<p>Pada tahun 2018 ini Bank NTB Syariah membuka kesempatan untuk berkarir di Bank NTB Syariah, adapaun posisi yang dibuka adalah Asisten Administrasi serta Analis Pembiayaan. Untuk persyaratan dan waktu penerimaan silahkan unduh pengumuman di bawah. Terima kasih.</p>\r\n\r\n<p>Wassalamualaikum warrahmatullahi wabarakatuh</p>\r\n', 'Kesempatan-Mengembangkan-Karir-di-Bank-NTB-Syariah', '2019-01-25 09:00:44', 'lowongan', '1'),
(11, 'Meriah, Gebyar Undian Tambora Bank NTB Syariah Banjir Hadiah', '<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><strong><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Mataram (suarantb.com)</span></span></strong><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">&nbsp;&ndash; Bank NTB Syariah kembali memberikan apresiasi kepada para nasabah melalui Gebyar Undian Tabungan Tambora Bank NTB Syariah (Tabungan Masyarakat Bumi Gora) yang diselenggarakan pada Sabtu, 25 Februari 2017.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Berbeda dari tahun sebelumnya, agenda gebyar penarikan undian tahun ini berlangsung lebih meriah, karena Bank NTB Syariah mempersembakan mobil All New Pajero Sport sebagai hadiah utama. Para nasabah juga dimanjakan dengan hadiah tambahan menarik lainnya seperti 5 unit mobil Honda Mobilio, 3 unit mobil Honda Brio, 30 unit sepeda motor Honda Vario, 30 unit TV 32 inch, 30 unit lemari es, 30 unit smartphone, 30 unit sepedah gunung dan 30 unit rice cooker.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Bertempat di Lombok Epicentrum Mall, agenda kegiatan yang rutin diselenggarakan setiap tahun ini dihadiri oleh ratusan nasabah setia Bank NTB Syariah. Turut hadir dalam acara tersebut Sekda&nbsp; NTB Syariah, Ir. H. Rosiady H. Sayuti, M.Sc, Ph.D, Asisten I Setda Kota Mataram, Lalu Martawang, Ketua DPRD Kota Mataram H. Didi Sumardi, SH, Kepala&nbsp; Biro Perekonomian Setda NTB Syariah, Dr. H. Manggaukang Raba, Kepala Bank Indonesia Perwakilan NTB Syariah Prijono dan Kabag Pengawasan OJK NTB Syariah, Hj. Aprillah, HS.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Manurut Direktur Utama Bank NTB Syariah, H. Komari Subakir, pemberian hadiah spesial tersebut merupakan bentuk&nbsp; apresiasi Bank NTB Syariah kepada para nasabah setianya.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">&ldquo;Terutama karena tren tabungan kita terus meningkat, maka kita ingin memberikan apresiasi dan daya tarik kepada para nasabah,&rdquo; ujarnya.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Menurutnya, sebagai upaya dalam menghimpun Dana Pihak Ketiga (DPK) Bank NTB Syariah telah mengembangkan berbagai macam fitur produk seperti laku pandai, mobile banking, serta kartu kredit yang mendukung gerakan nasional non tunai.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">&ldquo;Jadi apa yang dipunyai bank-bank lain maka kita harus punya,&rdquo; ujarnya.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Selanjutnya Bank NTB Syariah juga berupaya meningkatkan kredit di sektor produktif. Diantaranya melalui Kredit Usaha Rakyat (KUR) khususnya di sektor pertanian, peternakan dan kelautan. Bank NTB Syariah juga mendukung program sejuta rumah dengan menyalurkan kredit perumahan bersubsidi melalui KPR FLPP (Faslitas Likuiditas Pembiayaan Perumahan).</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Menurut Kepala Bagian Pengawasan Otoritas Jasa Keuangan (OJK) NTB Syariah, Hj. Aprillah, HS, Bank NTB Syariah mengalami pertumbuhan pesat dalam lima tahun terakhir.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Terhitung&nbsp; pada Desember 2016, aset Bank NTB Syariah tumbuh 25,23 persen dibanding tahun sebelumnya. Pertumbuhan tersebut didorong oleh dana pihak ketiga (DPK) sebesar Rp 656,42 miliar pada Desember 2016 atau tumbuh sebesar 14,26 persen dari tahun sebelumnya.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Di tahun 2016 kredit Bank NTB Syariah berjumlahRp 5,08 triliun. Mengalami pertumbuhan sebesar Rp 491 miliar atau tumbuh 10,69 persen dibanding tahun 2015. Sedangkan untuk laba bersih pada Desember 2016 sebesar Rp 225,8 miliar, tumbuh&nbsp; 7,33 persen dibanding&nbsp; sebelumnya.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">Terkait program dan produk baru di tahun 2017, Komari menyatakan bahwa saat ini pihaknya sedang mempersiapkan rencana konversi dari PT Bank NTB Syariah menjadi PT Bank NTB Syariah Syariah.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-size:10.5pt\"><span style=\"color:#666666\">&ldquo;Kita sedang siapkan secara komprehensif konversi ke syariah itu, minggu depan kami umumkan konsultan yang akan membantu kita,&rdquo; pungkasnya.&nbsp;&nbsp;<strong>(hvy/*)</strong></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Meriah-Gebyar-Undian-Tambora-Bank-NTB-Syariah-Banjir-Hadiah', '2019-01-27 05:24:00', 'event', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_log`
--
ALTER TABLE `tabel_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `values`
--
ALTER TABLE `values`
  ADD PRIMARY KEY (`id_values`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_log`
--
ALTER TABLE `tabel_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `values`
--
ALTER TABLE `values`
  MODIFY `id_values` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
