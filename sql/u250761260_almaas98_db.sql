-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 18, 2023 at 11:35 PM
-- Server version: 10.6.14-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u250761260_almaas98_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_banner`
--

CREATE TABLE `a_banner` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `type` enum('kustomer','partner') NOT NULL DEFAULT 'kustomer',
  `deskripsi` text NOT NULL,
  `cdate` datetime NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_banner`
--

INSERT INTO `a_banner` (`id`, `nama`, `slug`, `type`, `deskripsi`, `cdate`, `gambar`, `is_active`, `is_deleted`) VALUES
(1, 'RCTI OKE', 'rcti-oke', 'kustomer', 'Tes', '0000-00-00 00:00:00', 'media/kategori/2023/05/62-1-.png', 1, 1),
(2, 'SCTV', 'sctv', 'partner', 'tes', '0000-00-00 00:00:00', 'media/partner/2023/05/62-2-.png', 1, 1),
(3, 'The Leader In Quality Custom', 'the-leader-in-quality-custom', '', 'Lorem ipsum dolor sit amet consectetur adipiscing elit suspendisse, metus mattis urna senectus cursus himenaeos fermentum dictum, auctor nostra eros erat dapibus phasellus placerat. Etiam ac mus auctor gravida urna senectus ante, vulputate aptent ligula nunc quisque eros mauris hac, nascetur nullam tempus ullamcorper lacus elementum. Class bibendum consequat dictumst urna ad cursus, eu mauris parturient dapibus placerat senectus, tellus euismod nullam facilisis at. Posuere vulputate phasellus risus platea eu a massa, aliquet proin penatibus vel habitasse scelerisque eros tempor, etiam natoque primis integer vivamus sodales. Erat parturient vulputate porta libero sed imperdiet donec feugiat mi convallis, rutrum praesent augue pellentesque ante vel dui fringilla habitasse, ullamcorper nisl in natoque eget hac penatibus eleifend cubilia. Cubilia senectus enim aenean congue quam massa vestibulum laoreet, id varius felis tristique ultricies cum ultrices nisi, mus nullam metus molestie sed arcu nisl.', '0000-00-00 00:00:00', 'media/banner/2023/06/62-3-.jpeg', 1, 1),
(4, 'Design Image Just Go Easy', 'design-image-just-go-easy', '', '<p>Lorem ipsum dolor sit amet <a href=\"http://localhost/karyaabadi/produk/buku-tulis\">consectetur </a>adipiscing elit suspendisse, metus mattis urna senectus cursus himenaeos fermentum dictum, auctor nostra eros erat dapibus phasellus placerat. Etiam ac mus auctor gravida urna senectus ante, vulputate aptent ligula nunc quisque eros mauris hac, nascetur nullam tempus ullamcorper lacus elementum. Class bibendum consequat dictumst urna ad cursus, eu mauris parturient dapibus placerat senectus, tellus euismod nullam facilisis at. Posuere vulputate phasellus risus platea eu a massa, aliquet proin penatibus vel habitasse scelerisque eros tempor, etiam natoque primis integer vivamus sodales. Erat parturient vulputate porta libero sed imperdiet donec feugiat mi convallis, rutrum praesent augue pellentesque ante vel dui fringilla habitasse, ullamcorper nisl in natoque eget hac penatibus eleifend cubilia. Cubilia senectus enim aenean congue quam massa vestibulum laoreet, id varius felis tristique ultricies cum ultrices nisi, mus nullam metus molestie sed arcu nisl.</p>', '0000-00-00 00:00:00', 'media/banner/2023/06/62-4-.jpeg', 1, 1),
(5, 'tes', 'tes', 'kustomer', '<p>alksdaklsmndklasnlkd</p>', '2023-06-20 10:35:10', 'media/banner/2023/06/62-5-.jpg', 1, 1),
(6, 'tes', 'tes', 'kustomer', '<p>tesasdjkankcjnajksnclasnlkdasnkldnasd</p>', '2023-06-20 10:37:21', 'media/banner/2023/06/62-6-.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `a_blog`
--

CREATE TABLE `a_blog` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `kategori` varchar(128) NOT NULL,
  `meta_desc` varchar(160) NOT NULL,
  `meta_keyword` varchar(128) NOT NULL,
  `count_read` int(3) NOT NULL,
  `cdate` datetime NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_blog`
--

INSERT INTO `a_blog` (`id`, `judul`, `slug`, `text`, `gambar`, `kategori`, `meta_desc`, `meta_keyword`, `count_read`, `cdate`, `is_active`, `is_deleted`) VALUES
(1, 'Kartu Perusahaan Mencerminkan Seberapa Serius Dirimu', 'kartu-perusahaan-mencerminkan-seberapa-serius-dirimu', '<p>Lorem ipsum dolor sit amet <a href=\"http://localhost/karyaabadi/produk/buku-tulis\">consectetur </a>adipiscing elit suspendisse, metus mattis urna senectus cursus himenaeos fermentum dictum, auctor nostra eros erat dapibus phasellus placerat. Etiam ac mus auctor gravida urna senectus ante, vulputate aptent ligula nunc quisque eros mauris hac, nascetur nullam tempus ullamcorper lacus elementum. Class bibendum consequat dictumst urna ad cursus, eu mauris parturient dapibus placerat senectus, tellus euismod nullam facilisis at. Posuere vulputate phasellus risus platea eu a massa, aliquet proin penatibus vel habitasse scelerisque eros tempor, etiam natoque primis integer vivamus sodales. Erat parturient vulputate porta libero sed imperdiet donec feugiat mi convallis, rutrum praesent augue pellentesque ante vel dui fringilla habitasse, ullamcorper nisl in natoque eget hac penatibus eleifend cubilia. Cubilia senectus enim aenean congue quam massa vestibulum laoreet, id varius felis tristique ultricies cum ultrices nisi, mus nullam metus molestie sed arcu nisl.</p>', 'media/blog/2023/06/62-1-.jpg', 'Usaha', '', '', 0, '2023-07-03 16:11:56', 1, 1),
(2, 'Sebarkan Kebahagiaan Dengan Undangan Terbaikmu', 'sebarkan-kebahagiaan-dengan-undangan-terbaikmu', '<p>Lorem ipsum dolor sit amet consectetur adipiscing elit at phasellus, parturient neque bibendum sollicitudin consequat habitant faucibus cum, viverra scelerisque leo aptent blandit velit taciti pretium. Suspendisse ante tellus sem interdum fames arcu felis semper aliquam velit, elementum curae nisl maecenas varius senectus suscipit neque vulputate, ut tincidunt mollis viverra nam facilisi egestas ad gravida. Venenatis aliquet ante dictumst morbi platea torquent augue sed risus class feugiat, varius imperdiet diam habitant iaculis magna egestas justo interdum etiam, nostra pretium integer potenti et commodo est eros blandit pharetra. Bibendum gravida torquent leo pretium metus duis ante senectus facilisi eleifend facilisis, sodales et urna in semper nec etiam commodo venenatis risus. Viverra montes imperdiet leo netus nisl phasellus commodo primis et habitasse, faucibus dictumst sem etiam mattis inceptos sodales fringilla accumsan. Dapibus varius quis lacus porttitor proin metus arcu, fusce per vitae convallis justo aliquam, blandit netus donec gravida taciti nisl. Imperdiet mattis maecenas nibh consequat senectus lectus pulvinar potenti turpis sollicitudin, dis ac odio velit facilisis felis volutpat mauris.</p><p>Quam vel justo aliquam habitant sem natoque urna, facilisi vulputate hendrerit a molestie in convallis curae, fames elementum quis class est montes. Odio luctus eu bibendum neque magna integer tellus suspendisse, netus velit curabitur elementum non fusce vehicula, placerat nec habitasse hac viverra ad molestie. Gravida elementum aliquam parturient magnis fames nascetur hendrerit euismod dis sociis augue quam integer, congue ornare est tortor accumsan nisi vivamus placerat bibendum sociosqu nam.</p>', 'media/blog/2023/06/62-2-.jpg', 'Undangan Pernikahan', '', '', 0, '2023-07-04 00:00:00', 1, 1),
(3, 'Pemilihan Warna Dalam Color Grading', 'pemilihan-warna-dalam-color-grading', '<p>Lorem ipsum dolor sit amet consectetur adipiscing elit at phasellus, parturient neque bibendum sollicitudin consequat habitant faucibus cum, viverra scelerisque leo aptent blandit velit taciti pretium. Suspendisse ante tellus sem interdum fames arcu felis semper aliquam velit, elementum curae nisl maecenas varius senectus suscipit neque vulputate, ut tincidunt mollis viverra nam facilisi egestas ad gravida. Venenatis aliquet ante dictumst morbi platea torquent augue sed risus class feugiat, varius imperdiet diam habitant iaculis magna egestas justo interdum etiam, nostra pretium integer potenti et commodo est eros blandit pharetra. Bibendum gravida torquent leo pretium metus duis ante senectus facilisi eleifend facilisis, sodales et urna in semper nec etiam commodo venenatis risus. Viverra montes imperdiet leo netus nisl phasellus commodo primis et habitasse, faucibus dictumst sem etiam mattis inceptos sodales fringilla accumsan. Dapibus varius quis lacus porttitor proin metus arcu, fusce per vitae convallis justo aliquam, blandit netus donec gravida taciti nisl. Imperdiet mattis maecenas nibh consequat senectus lectus pulvinar potenti turpis sollicitudin, dis ac odio velit facilisis felis volutpat mauris.</p><p>Quam vel justo aliquam habitant sem natoque urna, facilisi vulputate hendrerit a molestie in convallis curae, fames elementum quis class est montes. Odio luctus eu bibendum neque magna integer tellus suspendisse, netus velit curabitur elementum non fusce vehicula, placerat nec habitasse hac viverra ad molestie. Gravida elementum aliquam parturient magnis fames nascetur hendrerit euismod dis sociis augue quam integer, congue ornare est tortor accumsan nisi vivamus placerat bibendum sociosqu nam.</p>', 'media/blog/2023/06/62-3-.jpg', 'Buku', '', '', 0, '2023-01-03 00:00:00', 1, 1),
(4, 'Ukuran Buku terlaris tahun 2023', 'ukuran-buku-terlaris-tahun-2023', '<p>Lorem ipsum dolor sit amet consectetur adipiscing elit at phasellus, parturient neque bibendum sollicitudin consequat habitant faucibus cum, viverra scelerisque leo aptent blandit velit taciti pretium. Suspendisse ante tellus sem interdum fames arcu felis semper aliquam velit, elementum curae nisl maecenas varius senectus suscipit neque vulputate, ut tincidunt mollis viverra nam facilisi egestas ad gravida. Venenatis aliquet ante dictumst morbi platea torquent augue sed risus class feugiat, varius imperdiet diam habitant iaculis magna egestas justo interdum etiam, nostra pretium integer potenti et commodo est eros blandit pharetra. Bibendum gravida torquent leo pretium metus duis ante senectus facilisi eleifend facilisis, sodales et urna in semper nec etiam commodo venenatis risus. Viverra montes imperdiet leo netus nisl phasellus commodo primis et habitasse, faucibus dictumst sem etiam mattis inceptos sodales fringilla accumsan. Dapibus varius quis lacus porttitor proin metus arcu, fusce per vitae convallis justo aliquam, blandit netus donec gravida taciti nisl. Imperdiet mattis maecenas nibh consequat senectus lectus pulvinar potenti turpis sollicitudin, dis ac odio velit facilisis felis volutpat mauris.</p><p>Quam vel justo aliquam habitant sem natoque urna, facilisi vulputate hendrerit a molestie in convallis curae, fames elementum quis class est montes. Odio luctus eu bibendum neque magna integer tellus suspendisse, netus velit curabitur elementum non fusce vehicula, placerat nec habitasse hac viverra ad molestie. Gravida elementum aliquam parturient magnis fames nascetur hendrerit euismod dis sociis augue quam integer, congue ornare est tortor accumsan nisi vivamus placerat bibendum sociosqu nam.</p>', 'media/blog/2023/06/62-4-.jpg', 'Buku', '', '', 0, '2023-01-03 00:00:00', 1, 1),
(5, 'Ukuran Buku terlaris tahun 2023', 'ukuran-buku-terlaris-tahun-2023', '<p>jhb</p>', 'media/blog/2023/06/62-5-.jpeg', 'hj', '', '', 0, '2023-06-15 06:49:06', 1, 1),
(6, 'Kartu Perusahaan Mencerminkan Seberapa Serius Dirimu', 'kartu-perusahaan-mencerminkan-seberapa-serius-dirimu', '<p>tes</p>', 'media/blog/2023/06/62-6-.png', 'tes', '', '', 0, '2023-06-15 10:06:11', 1, 1),
(7, 'tes', 'tes', '<p>asdjanslkcnalsncklnasklD</p>', 'media/blog/2023/06/62-7-.jpeg', '', '', '', 0, '2023-06-20 10:48:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `a_kategori`
--

CREATE TABLE `a_kategori` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `siteplan` varchar(255) NOT NULL,
  `data_siteplan` text NOT NULL,
  `cdate` datetime NOT NULL,
  `count_read` int(8) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_kategori`
--

INSERT INTO `a_kategori` (`id`, `nama`, `slug`, `deskripsi`, `gambar`, `siteplan`, `data_siteplan`, `cdate`, `count_read`, `is_active`, `is_deleted`) VALUES
(16, 'AlMaas 4 Residence', 'almaas-4-residence', 'Tes', 'media/kategori/2023/09/62-16-.jpeg', 'media/siteplan/2023/09/62-16-.svg', '{\"path13\":null,\"path22\":null,\"path50\":{\"data\":\"ID-1|TP-90/70|LT-70|LB-45|L-2|K-2|T-1|G-1|B-E|N-48|PS-hook\",\"status\":\"terjual\",\"b_user_id\":\"1\",\"posisi\":\"hook\"},\"path55\":null,\"path60\":null,\"path51\":null,\"path56\":null,\"path52\":null,\"path58\":null,\"path49\":{\"data\":\"ID-2|TP-60/60|LT-60|LB-30|L-2|K-2|T-1|G-1|B-A|N-49|PS-sayap\",\"status\":\"tersedia\"},\"path48\":{\"data\":\"ID-5|TP-60/60|LT-60|LB-30|L-2|K-2|T-1|G-1|B-A|N-45|PS-sayap\",\"status\":\"tersedia\"},\"path18\":{\"data\":\"ID-3|TP-60/60|LT-60|LB-30|L-2|K-2|T-1|G-1|B-B|N-50|PS-utama\",\"status\":\"tersedia\"},\"path17\":{\"data\":\"ID-6|TP-60/62|LT-62|LB-30|L-2|K-2|T-1|G-1|B-D|N-18|PS-hook\",\"status\":\"tersedia\"}}', '2023-08-30 15:09:20', 0, 1, 0),
(17, 'AlMaas 3 Residence', 'almaas-3-residence', '', 'media/kategori/2023/09/62-17-.jpeg', '', '', '2023-09-16 06:58:39', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `a_modules`
--

CREATE TABLE `a_modules` (
  `identifier` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT '',
  `level` int(1) NOT NULL DEFAULT 0 COMMENT 'depth level of menu, 0 mean outer 3 deeper submenu',
  `has_submenu` int(1) NOT NULL DEFAULT 0 COMMENT '1 mempunyai submenu, 2 tidak mempunyai submenu',
  `children_identifier` varchar(255) DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_default` enum('allowed','denied') NOT NULL DEFAULT 'denied',
  `is_visible` int(1) NOT NULL DEFAULT 1,
  `priority` int(3) NOT NULL DEFAULT 0 COMMENT '0 mean higher 999 lower',
  `fa_icon` varchar(255) NOT NULL DEFAULT 'fa fa-home' COMMENT 'font-awesome icon on menu',
  `utype` varchar(48) NOT NULL DEFAULT 'internal' COMMENT 'type module : internal, external'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='list modul yang ada dimenu atau tidak ada dimenu';

--
-- Dumping data for table `a_modules`
--

INSERT INTO `a_modules` (`identifier`, `name`, `path`, `level`, `has_submenu`, `children_identifier`, `is_active`, `is_default`, `is_visible`, `priority`, `fa_icon`, `utype`) VALUES
('admin_akun_user', 'Kustomer', 'admin/akun/user', 1, 0, 'akun', 1, 'denied', 1, 90, 'fa fa-users', 'internal'),
('admin_api_doc', 'Dokumentasi', 'admin/api/doc', 1, 0, 'api', 1, 'denied', 1, 1, 'fa fa-book', 'internal'),
('akun', 'Akun', '#', 0, 1, NULL, 1, 'denied', 1, 20, 'fa fa-users', 'internal'),
('akun_pengguna', 'Administrator', 'akun/pengguna', 1, 0, 'akun', 1, 'denied', 1, 90, 'fa fa-users', 'internal'),
('akun_user', 'Kustomer', 'akun/user', 1, 0, 'akun', 1, 'denied', 1, 90, 'fa fa-users', 'internal'),
('api', 'API', '#', 0, 1, NULL, 1, 'denied', 1, 80, 'fa fa-cog', 'internal'),
('api_doc', 'Dokumentasi', 'api/doc', 1, 0, 'api', 1, 'denied', 1, 1, 'fa fa-book', 'internal'),
('dashboard', 'Dashboard', '#', 0, 1, NULL, 1, 'denied', 1, 0, 'fa fa-home', 'internal'),
('laporan', 'Laporan', '#', 0, 1, NULL, 1, 'denied', 1, 90, 'fa fa-book', 'internal'),
('laporan_order', 'Order', 'laporan/order', 1, 0, 'laporan', 1, 'denied', 1, 1, 'fa fa-cogs', 'internal'),
('laporan_pengiriman', 'Pengiriman', 'laporan/pengiriman', 1, 0, 'laporan', 1, 'denied', 1, 1, 'fa fa-cogs', 'internal'),
('order', 'Kirim Paket', 'order', 0, 1, NULL, 1, 'denied', 1, 20, 'fa fa-exchange', 'internal'),
('partner', 'Partner', '#', 0, 1, NULL, 1, 'denied', 1, 20, 'fa fa-handshake-o', 'internal'),
('partner_reseller', 'Reseller', 'admin/partner/reseller', 1, 0, 'partner', 1, 'denied', 1, 90, 'fa fa-users', 'internal'),
('pengaturan', 'Pengaturan', 'pengaturan', 0, 1, NULL, 1, 'denied', 1, 90, 'fa fa-cogs', 'internal'),
('pengaturan_alamat', 'Alamat', 'pengaturan/alamat', 1, 0, 'pengaturan', 1, 'denied', 1, 5, 'fa fa-home', 'internal'),
('pengaturan_env', 'Environment', 'pengaturan/env', 1, 0, 'pengaturan', 1, 'denied', 1, 1, 'fa fa-cogs', 'internal'),
('pengaturan_perusahaan', 'Perusahaan', 'pengaturan/perusahaan', 1, 0, 'pengaturan', 1, 'denied', 1, 1, 'fa fa-users', 'internal'),
('pengaturan_user', 'User', 'pengaturan/user', 1, 0, 'pengaturan', 1, 'denied', 1, 1, 'fa fa-users', 'internal'),
('tracking', 'Tracking', 'tracking', 0, 1, NULL, 1, 'denied', 1, 20, 'fa fa-truck', 'internal');

-- --------------------------------------------------------

--
-- Table structure for table `a_partner`
--

CREATE TABLE `a_partner` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `type` enum('kustomer','partner') NOT NULL DEFAULT 'kustomer',
  `deskripsi` text NOT NULL,
  `cdate` datetime NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_partner`
--

INSERT INTO `a_partner` (`id`, `nama`, `slug`, `type`, `deskripsi`, `cdate`, `gambar`, `is_active`, `is_deleted`) VALUES
(1, 'Pemerintahan Kabupaten Bandung Barat', 'pemerintahan-kabupaten-bandung-barat', 'kustomer', 'Lorem ipsum dolor sit amet consectetur adipiscing elit augue ut, class tempor per tincidunt orci nisl pretium hendrerit, pulvinar congue auctor fermentum in semper volutpat est. Senectus sociis tristique dapibus cras nec est nunc, felis magna facilisi nisi etiam interdum torquent, orci parturient habitant neque netus nisl. Justo tempor morbi sollicitudin ullamcorper suspendisse dapibus nulla augue, vel montes dignissim pulvinar eleifend pretium blandit ultrices felis, leo natoque sociis faucibus nullam platea libero. Inceptos at consequat libero ultrices netus nisl imperdiet posuere, turpis malesuada porta fermentum mollis primis torquent rhoncus venenatis, pellentesque nec pretium habitant dictum dui nostra risus, gravida cras sed bibendum placerat montes sem. Dignissim ac risus arcu semper dictumst lobortis, habitasse blandit mi odio mollis primis, nisl velit at metus sociosqu.', '0000-00-00 00:00:00', 'media/partner/2023/06/62-1-.png', 1, 0),
(2, 'SCTV', 'sctv', 'partner', 'tes', '0000-00-00 00:00:00', 'media/partner/2023/05/62-2-.png', 1, 1),
(3, 'Syudais Media', 'syudais-media', 'kustomer', 'Lorem ipsum dolor sit amet consectetur adipiscing elit augue ut, class tempor per tincidunt orci nisl pretium hendrerit, pulvinar congue auctor fermentum in semper volutpat est. Senectus sociis tristique dapibus cras nec est nunc, felis magna facilisi nisi etiam interdum torquent, orci parturient habitant neque netus nisl. Justo tempor morbi sollicitudin ullamcorper suspendisse dapibus nulla augue, vel montes dignissim pulvinar eleifend pretium blandit ultrices felis, leo natoque sociis faucibus nullam platea libero. Inceptos at consequat libero ultrices netus nisl imperdiet posuere, turpis malesuada porta fermentum mollis primis torquent rhoncus venenatis, pellentesque nec pretium habitant dictum dui nostra risus, gravida cras sed bibendum placerat montes sem. Dignissim ac risus arcu semper dictumst lobortis, habitasse blandit mi odio mollis primis, nisl velit at metus sociosqu.', '0000-00-00 00:00:00', 'media/partner/2023/06/62-3-.png', 1, 0),
(4, 'Kustomer 1', 'kustomer-1', 'kustomer', 'Lorem ipsum dolor sit amet consectetur adipiscing elit magnis phasellus, auctor est vitae aptent faucibus elementum gravida et, penatibus morbi nascetur vivamus at risus sem pharetra. Lacinia torquent nostra platea congue cursus bibendum feugiat, tincidunt in semper id vulputate fusce praesent ligula, eros a libero imperdiet sociosqu ac. Cum id magnis massa nostra lectus scelerisque facilisis sociis tincidunt senectus non eros proin tortor, ac magna habitasse rutrum erat molestie condimentum metus faucibus vel sollicitudin donec. Mi lectus quis justo scelerisque volutpat semper molestie eu in parturient dapibus cursus, non mattis posuere ultrices pharetra fringilla leo nec ullamcorper tristique aliquam, metus viverra vel purus hac sociis fames vitae luctus egestas mauris. Montes augue malesuada purus mi vivamus volutpat orci ac, aptent platea cras sapien varius phasellus dictumst blandit, cubilia porttitor tellus cursus dictum congue fames. Nibh justo lobortis dignissim ante himenaeos fermentum curae, aliquet iaculis risus mattis luctus porta senectus id, a auctor magna penatibus gravida convallis. Fermentum sagittis consequat orci sodales ligula torquent mauris risus, enim scelerisque potenti blandit cubilia faucibus vehicula, etiam suspendisse ac nascetur hendrerit malesuada eleifend.', '0000-00-00 00:00:00', 'media/partner/2023/06/62-4-.png', 1, 0),
(5, 'Kustomer 2', 'kustomer-2', 'kustomer', 'Lorem ipsum dolor sit amet consectetur adipiscing elit sapien justo potenti venenatis quisque taciti curabitur, interdum maecenas posuere quis vulputate vivamus sollicitudin bibendum et varius tempus suspendisse lacinia. Volutpat felis ligula neque turpis venenatis sodales cum cubilia, fusce eget auctor per commodo nascetur mauris est consequat, parturient sollicitudin torquent ornare lacus orci platea. Non scelerisque tempus montes nec taciti purus in vulputate quisque, venenatis imperdiet habitasse nunc aliquam mattis himenaeos viverra eu, mi ut etiam hendrerit netus pulvinar id justo. Nunc maecenas cum suscipit condimentum placerat himenaeos vestibulum suspendisse vehicula nec, et gravida odio id platea cubilia ridiculus tincidunt libero. Praesent fermentum proin himenaeos lacus arcu montes malesuada neque donec inceptos felis ligula porta, sapien nullam tempor erat id imperdiet maecenas laoreet tortor penatibus eros. Malesuada sociis auctor montes sagittis sollicitudin orci condimentum ante netus quisque morbi cum, nibh himenaeos eget cursus lacinia lectus litora semper potenti curabitur sodales ad fusce, vitae justo porta natoque ultrices fames maecenas placerat interdum tortor consequat. Mi vitae eros posuere senectus accumsan donec montes in urna ligula, suscipit ultrices magnis sociis habitant id curae nunc.', '0000-00-00 00:00:00', 'media/partner/2023/06/62-5-.png', 1, 0),
(6, 'Kustomer 3', 'kustomer-3', 'kustomer', 'Lorem ipsum dolor sit amet consectetur adipiscing elit sapien justo potenti venenatis quisque taciti curabitur, interdum maecenas posuere quis vulputate vivamus sollicitudin bibendum et varius tempus suspendisse lacinia. Volutpat felis ligula neque turpis venenatis sodales cum cubilia, fusce eget auctor per commodo nascetur mauris est consequat, parturient sollicitudin torquent ornare lacus orci platea. Non scelerisque tempus montes nec taciti purus in vulputate quisque, venenatis imperdiet habitasse nunc aliquam mattis himenaeos viverra eu, mi ut etiam hendrerit netus pulvinar id justo. Nunc maecenas cum suscipit condimentum placerat himenaeos vestibulum suspendisse vehicula nec, et gravida odio id platea cubilia ridiculus tincidunt libero. Praesent fermentum proin himenaeos lacus arcu montes malesuada neque donec inceptos felis ligula porta, sapien nullam tempor erat id imperdiet maecenas laoreet tortor penatibus eros. Malesuada sociis auctor montes sagittis sollicitudin orci condimentum ante netus quisque morbi cum, nibh himenaeos eget cursus lacinia lectus litora semper potenti curabitur sodales ad fusce, vitae justo porta natoque ultrices fames maecenas placerat interdum tortor consequat. Mi vitae eros posuere senectus accumsan donec montes in urna ligula, suscipit ultrices magnis sociis habitant id curae nunc.', '0000-00-00 00:00:00', 'media/partner/2023/06/62-6-.png', 1, 0),
(7, 'tes', 'tes', 'kustomer', 'tes', '2023-06-15 06:48:11', 'media/partner/2023/06/62-7-.png', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `a_pengguna`
--

CREATE TABLE `a_pengguna` (
  `id` int(6) UNSIGNED NOT NULL,
  `a_company_id` int(3) UNSIGNED DEFAULT NULL COMMENT 'penempatan',
  `a_company_nama` varchar(78) NOT NULL DEFAULT '-',
  `a_company_kode` varchar(32) NOT NULL DEFAULT '-',
  `a_jabatan_id` int(3) UNSIGNED DEFAULT NULL,
  `a_jabatan_nama` varchar(255) NOT NULL DEFAULT 'Staff',
  `username` varchar(24) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `welcome_message` varchar(255) NOT NULL,
  `scope` enum('all','current_below','current_only','none') NOT NULL DEFAULT 'none',
  `nip` varchar(32) DEFAULT '-',
  `alamat` varchar(150) NOT NULL DEFAULT '',
  `alamat2` varchar(150) NOT NULL DEFAULT '',
  `alamat_kecamatan` varchar(150) NOT NULL DEFAULT '',
  `alamat_kabkota` varchar(150) NOT NULL DEFAULT '',
  `alamat_provinsi` varchar(150) NOT NULL DEFAULT '',
  `alamat_negara` varchar(150) NOT NULL DEFAULT '',
  `alamat_kodepos` varchar(12) NOT NULL DEFAULT ' ',
  `tempat_lahir` varchar(150) NOT NULL DEFAULT '',
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` int(1) UNSIGNED NOT NULL DEFAULT 1,
  `status_pernikahan` enum('belum menikah','menikah','duda','janda') NOT NULL DEFAULT 'belum menikah',
  `telp_rumah` varchar(25) DEFAULT NULL,
  `telp_hp` varchar(25) DEFAULT NULL,
  `bank_rekening_nomor` varchar(78) NOT NULL DEFAULT '',
  `bank_rekening_nama` varchar(150) NOT NULL DEFAULT '',
  `bank_nama` varchar(150) NOT NULL DEFAULT '',
  `npwp` varchar(128) NOT NULL DEFAULT '',
  `kerja_terakhir` varchar(150) NOT NULL DEFAULT '',
  `kerja_terakhir_jabatan` varchar(78) NOT NULL DEFAULT '',
  `kerja_terakhir_gaji` decimal(18,0) DEFAULT NULL,
  `pendidikan_terakhir` varchar(150) NOT NULL DEFAULT '',
  `pendidikan_terakhir_jenjang` enum('SD','SMP','SMA','S1','D3','D2','S2') NOT NULL DEFAULT 'SMA',
  `pendidikan_terakhir_tahun` year(4) NOT NULL DEFAULT 1971,
  `ibu_nama` varchar(150) NOT NULL DEFAULT '',
  `ibu_pekerjaan` varchar(78) NOT NULL DEFAULT '',
  `tgl_kerja_mulai` date DEFAULT NULL,
  `tgl_kerja_akhir` date DEFAULT NULL,
  `tgl_kontrak_akhir` date DEFAULT NULL,
  `karyawan_status` enum('Kontrak','Magang','Tetap','Harian Lepas') NOT NULL,
  `nama_perusahaan` varchar(128) NOT NULL DEFAULT '',
  `is_karyawan` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` int(1) UNSIGNED NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `a_pengguna_id` int(6) UNSIGNED DEFAULT NULL COMMENT 'atasan langsung',
  `is_admin_master` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='tabel pengguna';

--
-- Dumping data for table `a_pengguna`
--

INSERT INTO `a_pengguna` (`id`, `a_company_id`, `a_company_nama`, `a_company_kode`, `a_jabatan_id`, `a_jabatan_nama`, `username`, `password`, `email`, `nama`, `foto`, `welcome_message`, `scope`, `nip`, `alamat`, `alamat2`, `alamat_kecamatan`, `alamat_kabkota`, `alamat_provinsi`, `alamat_negara`, `alamat_kodepos`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `status_pernikahan`, `telp_rumah`, `telp_hp`, `bank_rekening_nomor`, `bank_rekening_nama`, `bank_nama`, `npwp`, `kerja_terakhir`, `kerja_terakhir_jabatan`, `kerja_terakhir_gaji`, `pendidikan_terakhir`, `pendidikan_terakhir_jenjang`, `pendidikan_terakhir_tahun`, `ibu_nama`, `ibu_pekerjaan`, `tgl_kerja_mulai`, `tgl_kerja_akhir`, `tgl_kontrak_akhir`, `karyawan_status`, `nama_perusahaan`, `is_karyawan`, `is_active`, `is_deleted`, `a_pengguna_id`, `is_admin_master`) VALUES
(1, NULL, 'Almaas98', '-', NULL, 'Admin', 'mimind', '$2y$10$bTB1dRnKfzVmP.Z3y1r2OuhkyotKFMhfxeAsAn7cpb/sY8LF00Zzi', 'admin@gmail.com', 'Administrator Almaas 98', 'media/pengguna/2023/09/62-1-.png', 'Selamat Beraktifitas', 'all', '-', '', '', '', '', '', '', '', '', NULL, 1, 'belum menikah', '', '', '', '', '', '', '', '', 0, '', 'SMA', '1971', '', '', '0000-00-00', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 1),
(406, NULL, 'Almaas98', '-', NULL, 'Sales', '', '', '', 'Zamzam Ramadhan', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '087893928384', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '0000-00-00', '0000-00-00', NULL, 'Tetap', '', 0, 1, 1, NULL, 0),
(407, NULL, 'Almaas98', '-', NULL, 'Sales', 'ujang', 'e10adc3949ba59abbe56e057f20f883e', '', 'Ujang', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '081923871298', '', '', '', '', '', '', NULL, 'S1', 'SMA', '1971', '', '', '2023-08-23', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 1, NULL, 0),
(411, NULL, 'Almaas98', '-', NULL, 'Marketing', 'muhammadhelmin.j', 'e10adc3949ba59abbe56e057f20f883e', '', 'Muhammad Helmi N.J', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085797441388', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '0000-00-00', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(419, NULL, 'Almaas98', '-', NULL, 'Marketing', 'mochamadzamzamramadhan', 'e10adc3949ba59abbe56e057f20f883e', '', 'Mochamad Zamzam Ramadhan', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '082219651903', '', '', '', '', '', '', NULL, 'S1', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(420, NULL, 'Almaas98', '-', NULL, 'Marketing', 'syahrulfebriant', 'e10adc3949ba59abbe56e057f20f883e', '', 'Syahrul Febriant', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '089649230205', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(421, NULL, 'Almaas98', '-', NULL, 'Marketing', 'harishidayat', 'e10adc3949ba59abbe56e057f20f883e', '', 'Haris Hidayat', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '083841336668', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(422, NULL, 'Almaas98', '-', NULL, 'Marketing', 'aldiaprianto', 'e10adc3949ba59abbe56e057f20f883e', '', 'Aldi aprianto', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '088802345300', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '0000-00-00', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(423, NULL, 'Almaas98', '-', NULL, 'Marketing', 'yogisetiawan', 'e10adc3949ba59abbe56e057f20f883e', '', 'Yogi setiawan', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085810500566', '', '', '', '', '', '', NULL, 'S1', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(424, NULL, 'Almaas98', '-', NULL, 'Marketing', 'rikoajipamungkas', 'e10adc3949ba59abbe56e057f20f883e', '', 'Riko aji pamungkas', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '85727493763', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(425, NULL, 'Almaas98', '-', NULL, 'Marketing', 'arishidayat', 'e10adc3949ba59abbe56e057f20f883e', '', 'Aris Hidayat', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085759693908', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(426, NULL, 'Almaas98', '-', NULL, 'Marketing', 'madamibrahim', 'e10adc3949ba59abbe56e057f20f883e', '', 'M Adam ibrahim', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085215220536', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '0000-00-00', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(427, NULL, 'Almaas98', '-', NULL, 'Marketing', 'ilhamedwarramadhan', 'e10adc3949ba59abbe56e057f20f883e', '', 'Ilham Edwar Ramadhan', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085559766045', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(428, NULL, 'Almaas98', '-', NULL, 'Marketing', 'jajangslamet', 'e10adc3949ba59abbe56e057f20f883e', '', 'Jajang slamet', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085759412607', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(429, NULL, 'Almaas98', '-', NULL, 'Marketing', 'irwansyahpramadita', 'e10adc3949ba59abbe56e057f20f883e', '', 'Irwansyah Pramadita', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '087739939741', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(430, NULL, 'Almaas98', '-', NULL, 'Marketing', 'dederismawan', 'e10adc3949ba59abbe56e057f20f883e', '', 'Dede Rismawan', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '081212066727', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(431, NULL, 'Almaas98', '-', NULL, 'Marketing', 'ruslan', 'e10adc3949ba59abbe56e057f20f883e', '', 'Ruslan', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '081315591066', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(432, NULL, 'Almaas98', '-', NULL, 'Marketing', 'abdiagnaputra', 'e10adc3949ba59abbe56e057f20f883e', '', 'Abdi agna putra', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '089525858833', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(433, NULL, 'Almaas98', '-', NULL, 'Marketing', 'ridwanrahayu', 'e10adc3949ba59abbe56e057f20f883e', '', 'Ridwan rahayu', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '0881022179650', '', '', '', '', '', '', NULL, 'S1', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(434, NULL, 'Almaas98', '-', NULL, 'Marketing', 'ferirahmat', 'e10adc3949ba59abbe56e057f20f883e', '', 'Feri Rahmat', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085175193377', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(435, NULL, 'Almaas98', '-', NULL, 'Marketing', 'acengibrahim', 'e10adc3949ba59abbe56e057f20f883e', '', 'Aceng Ibrahim', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '083879793647', '', '', '', '', '', '', NULL, 'SMA', 'SMA', '1971', '', '', '2023-05-08', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0),
(436, NULL, 'Almaas98', '-', NULL, 'Marketing', 'mikhsananugrah', 'e10adc3949ba59abbe56e057f20f883e', '', 'M Ikhsan anugrah ', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '0895110038222', '', '', '', '', '', '', NULL, 'SMK', 'SMA', '1971', '', '', '2023-07-18', '0000-00-00', NULL, 'Magang', '', 0, 1, 0, NULL, 0),
(437, NULL, 'Almaas98', '-', NULL, 'Direktur', 'payayat', '$2y$10$bdO1gGNMIhpt5yz.9nftL.ulvw4TsDyKdfXzv0iXgjwF5uV84sb76', '', 'Pa Yayat', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '87872838280', '', '', '', '', '', '', NULL, 'S1', 'SMA', '1971', '', '', '0000-00-00', '0000-00-00', NULL, 'Tetap', '', 0, 1, 0, NULL, 0),
(438, NULL, 'Almaas98', '-', NULL, 'Marketing', 'rezzamuhammadiqbal', 'e10adc3949ba59abbe56e057f20f883e', '', 'Rezza Muhammad Iqbal', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '085789701750', '', '', '', '', '', '', NULL, 'S1', 'SMA', '1971', '', '', '0000-00-00', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `a_pengguna_module`
--

CREATE TABLE `a_pengguna_module` (
  `id` int(8) UNSIGNED NOT NULL,
  `a_pengguna_id` int(6) UNSIGNED DEFAULT NULL,
  `a_modules_identifier` varchar(255) DEFAULT NULL,
  `rule` enum('allowed','disallowed','allowed_except','disallowed_except') NOT NULL DEFAULT 'allowed',
  `tmp_active` enum('N','Y') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='hak akses pengguna';

--
-- Dumping data for table `a_pengguna_module`
--

INSERT INTO `a_pengguna_module` (`id`, `a_pengguna_id`, `a_modules_identifier`, `rule`, `tmp_active`) VALUES
(1, 1, NULL, 'allowed_except', 'N'),
(3189, 403, 'akun', 'allowed', 'N'),
(3190, 403, 'admin_akun_user', 'allowed', 'N'),
(3191, 403, 'partner', 'allowed', 'N'),
(3192, 403, 'partner_reseller', 'allowed', 'N'),
(3193, 403, 'api', 'allowed', 'N'),
(3194, 403, 'admin_api_doc', 'allowed', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `a_rekening`
--

CREATE TABLE `a_rekening` (
  `id` int(2) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor` varchar(128) NOT NULL,
  `icon` varchar(56) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_rekening`
--

INSERT INTO `a_rekening` (`id`, `nama`, `nomor`, `icon`, `is_active`, `is_deleted`) VALUES
(1, 'Rezza Muhammad Iqbal', '7166999663', 'bsi', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `a_three_d`
--

CREATE TABLE `a_three_d` (
  `id` int(4) NOT NULL,
  `gambar` text NOT NULL,
  `deskripsi` text NOT NULL,
  `cdate` datetime NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_three_d`
--

INSERT INTO `a_three_d` (`id`, `gambar`, `deskripsi`, `cdate`, `is_active`, `is_deleted`) VALUES
(1, '<div class=\"sketchfab-embed-wrapper\"> <iframe title=\"Apartment RP\" frameborder=\"0\" allowfullscreen mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\" allow=\"autoplay; fullscreen; xr-spatial-tracking\" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src=\"https://sketchfab.com/models/8b31e163cccd4bafbdf186b6d26d283a/embed\"> </iframe>\r\n                        <p style=\"font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;\"> <a href=\"https://sketchfab.com/3d-models/apartment-rp-8b31e163cccd4bafbdf186b6d26d283a?utm_medium=embed&utm_campaign=share-popup&utm_content=8b31e163cccd4bafbdf186b6d26d283a\" target=\"_blank\" rel=\"nofollow\" style=\"font-weight: bold; color: #1CAAD9;\"> Apartment RP </a> by <a href=\"https://sketchfab.com/z1px3r?utm_medium=embed&utm_campaign=share-popup&utm_content=8b31e163cccd4bafbdf186b6d26d283a\" target=\"_blank\" rel=\"nofollow\" style=\"font-weight: bold; color: #1CAAD9;\"> Virtual Bakery </a> on <a href=\"https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=8b31e163cccd4bafbdf186b6d26d283a\" target=\"_blank\" rel=\"nofollow\" style=\"font-weight: bold; color: #1CAAD9;\">Sketchfab</a></p>\r\n                    </div>', 'Type 60', '2023-09-02 12:46:33', 1, 0),
(2, '<div class=\"sketchfab-embed-wrapper\"> <iframe title=\"Interior Design\" frameborder=\"0\" allowfullscreen mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\" allow=\"autoplay; fullscreen; xr-spatial-tracking\" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src=\"https://sketchfab.com/models/1a6896865ef7438f832f99924136c7a5/embed\"> </iframe> <p style=\"font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;\"> <a href=\"https://sketchfab.com/3d-models/interior-design-1a6896865ef7438f832f99924136c7a5?utm_medium=embed&utm_campaign=share-popup&utm_content=1a6896865ef7438f832f99924136c7a5\" target=\"_blank\" rel=\"nofollow\" style=\"font-weight: bold; color: #1CAAD9;\"> Interior Design </a> by <a href=\"https://sketchfab.com/ghjfyhjn?utm_medium=embed&utm_campaign=share-popup&utm_content=1a6896865ef7438f832f99924136c7a5\" target=\"_blank\" rel=\"nofollow\" style=\"font-weight: bold; color: #1CAAD9;\"> ghjfyhjn </a> on <a href=\"https://sketchfab.com?utm_medium=embed&utm_campaign=share-popup&utm_content=1a6896865ef7438f832f99924136c7a5\" target=\"_blank\" rel=\"nofollow\" style=\"font-weight: bold; color: #1CAAD9;\">Sketchfab</a></p></div>', 'Type 70', '2023-09-02 12:53:55', 1, 0),
(3, '', 'tes', '2023-09-02 12:57:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `b_produk`
--

CREATE TABLE `b_produk` (
  `id` int(5) NOT NULL,
  `a_kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `cdate` datetime NOT NULL,
  `spesifikasi` text NOT NULL,
  `harga` int(56) NOT NULL,
  `tipe` varchar(56) NOT NULL,
  `blok` varchar(56) NOT NULL,
  `status` varchar(128) NOT NULL,
  `nomor` varchar(56) NOT NULL,
  `luas_bangunan` int(18) NOT NULL,
  `luas_tanah` int(18) NOT NULL,
  `lantai` int(2) NOT NULL,
  `kamar_tidur` int(2) NOT NULL,
  `toilet` int(2) NOT NULL,
  `garasi` int(2) NOT NULL,
  `listrik` varchar(128) NOT NULL,
  `air` varchar(128) NOT NULL,
  `a_three_d_id` int(3) NOT NULL,
  `lat` varchar(128) NOT NULL,
  `lang` varchar(128) NOT NULL,
  `gmaps` varchar(128) NOT NULL,
  `count_read` int(8) DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b_produk`
--

INSERT INTO `b_produk` (`id`, `a_kategori_id`, `nama`, `slug`, `gambar`, `deskripsi`, `cdate`, `spesifikasi`, `harga`, `tipe`, `blok`, `status`, `nomor`, `luas_bangunan`, `luas_tanah`, `lantai`, `kamar_tidur`, `toilet`, `garasi`, `listrik`, `air`, `a_three_d_id`, `lat`, `lang`, `gmaps`, `count_read`, `is_active`, `is_deleted`) VALUES
(10, 16, 'Blok E 44', 'blok-e-44', 'media/produk/2023/09/62-10-1.jpeg', '<p><strong>Lorem ipsum dolor sit amet, c</strong>onsectetur adipiscing elit. Per nisl ullamcorper dis risus sed nascetur at tincidunt, elementum habitasse rhoncus fusce lacus lectus himenaeos nulla egestas, phasellus laoreet quis a feugiat mattis litora.</p>', '2023-06-07 23:09:15', '{\"Bahan\":[\"Bludru\",\"Kulit\"],\"QTY\":[\" < 30\",\"30 - 100\",\" > 100\"]}', 459000000, '60/60', '', 'Tersedia', '', 30, 60, 2, 2, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(12, 16, 'Blok E 42', 'blok-e-42', 'media/produk/2023/09/62-12-1.jpeg', '', '2023-09-10 11:32:31', '', 466650000, '60/62', '', 'Tersedia', '', 30, 62, 2, 2, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(21, 16, 'Blok C 55', 'blok-c-55', 'media/produk/2023/09/62-21-1.jpeg', '', '2023-09-10 12:52:32', '', 520200000, '72/64', '', 'Tersedia', '', 36, 64, 2, 2, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(31, 16, 'Blok F 21', 'blok-f-21', 'media/produk/2023/09/62-31-1.jpeg', '', '2023-09-10 13:29:20', '', 612000000, '90/70', '', 'Tersedia', '', 45, 70, 2, 2, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(37, 16, 'Blok B 09', 'blok-b-09', 'media/produk/2023/09/62-37-1.jpeg', '', '2023-09-10 13:39:03', '', 619650000, '90/72', '', 'Tersedia', '', 45, 72, 2, 2, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(50, 16, 'Jalan Utama 16', 'jalan-utama-16', 'media/produk/2023/09/62-50-1.jpeg', '', '2023-09-10 14:00:46', '', 638350000, '90/77', '', 'Tersedia', '', 45, 77, 2, 2, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(56, 16, 'Jalan Utama 02', 'jalan-utama-02', 'media/produk/2023/09/62-56-1.jpeg', '', '2023-09-10 14:07:33', '', 688500000, '100/80', '', 'Tersedia', '', 50, 80, 2, 3, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(66, 16, 'Blok F 27', 'blok-f-27', 'media/produk/2023/09/62-66-1.jpeg', '', '2023-09-10 14:17:02', '', 703800000, '100/84', '', 'Tersedia', '', 50, 84, 2, 3, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(67, 16, 'Blok A 06', 'blok-a-06', 'media/produk/2023/09/62-67-1.jpeg', '', '2023-09-10 14:20:36', '', 711450000, '100/86', '', 'Tersedia', '', 50, 86, 2, 3, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(68, 16, 'Blok H 28', 'blok-h-28', 'media/produk/2023/09/62-68-1.jpeg', '', '2023-09-10 14:23:03', '', 719100000, '100/88', '', 'Tersedia', '', 50, 88, 2, 3, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(71, 16, 'Jalan Utama 60', 'jalan-utama-60', 'media/produk/2023/09/62-71-1.jpeg', '', '2023-09-10 14:28:42', '', 765000000, '110/190', '', 'Tersedia', '', 55, 90, 2, 3, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0),
(76, 16, 'Blok D 18', 'blok-d-18', 'media/produk/2023/09/62-76-1.jpeg', '', '2023-09-10 14:34:33', '', 875925000, '120/109', '', 'Tersedia', '', 60, 109, 2, 3, 1, 1, '1300', 'Sibel', 1, '', '', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `b_produk_gambar`
--

CREATE TABLE `b_produk_gambar` (
  `id` int(11) NOT NULL,
  `b_produk_id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `ke` int(2) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `is_cover` int(1) NOT NULL DEFAULT 0,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b_produk_gambar`
--

INSERT INTO `b_produk_gambar` (`id`, `b_produk_id`, `gambar`, `ke`, `deskripsi`, `is_cover`, `is_active`, `is_deleted`) VALUES
(1, 5, 'media/produk/2023/06/62-5-1.png', 1, '', 0, 1, 0),
(2, 5, 'media/produk/2023/06/62-5-2.png', 2, '', 1, 1, 0),
(3, 5, 'media/produk/2023/06/62-5-3.jpeg', 3, '', 0, 1, 0),
(4, 2, 'media/produk/2023/06/62-2-2.png', 2, '', 0, 1, 0),
(5, 2, 'media/produk/2023/06/62-2-3.png', 3, '', 0, 1, 0),
(6, 2, 'media/produk/2023/06/62-2-4.png', 4, '', 0, 1, 0),
(7, 6, 'media/produk/2023/06/62-6-1.png', 1, '', 1, 1, 0),
(8, 6, 'media/produk/2023/06/62-6-2.png', 2, '', 0, 1, 0),
(9, 6, 'media/produk/2023/06/62-6-3.png', 3, '', 0, 1, 0),
(10, 7, 'media/produk/2023/06/62-7-1.png', 1, '', 1, 1, 0),
(11, 7, 'media/produk/2023/06/62-7-2.png', 2, '', 0, 1, 0),
(12, 7, 'media/produk/2023/06/62-7-3.png', 3, '', 0, 1, 0),
(13, 8, 'media/produk/2023/06/62-8-1.png', 1, '', 1, 1, 0),
(14, 8, 'media/produk/2023/06/62-8-2.png', 2, '', 0, 1, 0),
(15, 8, 'media/produk/2023/06/62-8-3.png', 3, '', 0, 1, 0),
(16, 8, 'media/produk/2023/06/62-8-4.png', 4, '', 0, 1, 0),
(17, 9, 'media/produk/2023/06/62-9-1.png', 1, '', 1, 1, 0),
(18, 10, 'media/produk/2023/09/62-10-1.jpeg', 1, '', 1, 1, 0),
(19, 10, 'media/produk/2023/09/62-10-2.jpeg', 2, '', 0, 1, 0),
(20, 11, 'media/produk/2023/09/62-11-2.jpeg', 2, '', 0, 1, 0),
(21, 11, 'media/produk/2023/09/62-11-1.jpeg', 1, '', 1, 1, 0),
(22, 11, 'media/produk/2023/09/62-11-3.jpeg', 3, '', 0, 1, 0),
(23, 11, 'media/produk/2023/09/62-11-4.jpeg', 4, '', 0, 1, 0),
(24, 10, 'media/produk/2023/09/62-10-3.jpeg', 3, '', 0, 1, 0),
(25, 10, 'media/produk/2023/09/62-10-4.jpeg', 4, '', 0, 1, 0),
(26, 77, 'media/produk/2023/09/62-77-1.jpeg', 1, '', 1, 1, 0),
(27, 77, 'media/produk/2023/09/62-77-2.jpeg', 2, '', 0, 1, 0),
(28, 77, 'media/produk/2023/09/62-77-3.jpeg', 3, '', 0, 1, 0),
(29, 76, 'media/produk/2023/09/62-76-1.jpeg', 1, '', 1, 1, 0),
(30, 76, 'media/produk/2023/09/62-76-2.jpeg', 2, '', 0, 1, 0),
(31, 76, 'media/produk/2023/09/62-76-3.jpeg', 3, '', 0, 1, 0),
(32, 76, 'media/produk/2023/09/62-76-4.jpeg', 4, '', 0, 1, 0),
(33, 75, 'media/produk/2023/09/62-75-1.jpeg', 1, '', 1, 1, 0),
(34, 75, 'media/produk/2023/09/62-75-2.jpeg', 2, '', 0, 1, 0),
(35, 75, 'media/produk/2023/09/62-75-3.jpeg', 3, '', 0, 1, 0),
(36, 75, 'media/produk/2023/09/62-75-4.jpeg', 4, '', 0, 1, 0),
(37, 74, 'media/produk/2023/09/62-74-1.jpeg', 1, '', 1, 1, 0),
(38, 74, 'media/produk/2023/09/62-74-2.jpeg', 2, '', 0, 1, 0),
(39, 74, 'media/produk/2023/09/62-74-3.jpeg', 3, '', 0, 1, 0),
(40, 74, 'media/produk/2023/09/62-74-4.jpeg', 4, '', 0, 1, 0),
(41, 73, 'media/produk/2023/09/62-73-1.jpeg', 1, '', 1, 1, 0),
(42, 73, 'media/produk/2023/09/62-73-2.jpeg', 2, '', 0, 1, 0),
(43, 73, 'media/produk/2023/09/62-73-3.jpeg', 3, '', 0, 1, 0),
(44, 73, 'media/produk/2023/09/62-73-4.jpeg', 4, '', 0, 1, 0),
(45, 72, 'media/produk/2023/09/62-72-1.jpeg', 1, '', 1, 1, 0),
(46, 72, 'media/produk/2023/09/62-72-2.jpeg', 2, '', 0, 1, 0),
(47, 72, 'media/produk/2023/09/62-72-3.jpeg', 3, '', 0, 1, 0),
(48, 72, 'media/produk/2023/09/62-72-4.jpeg', 4, '', 0, 1, 0),
(49, 71, 'media/produk/2023/09/62-71-1.jpeg', 1, '', 1, 1, 0),
(50, 71, 'media/produk/2023/09/62-71-2.jpeg', 2, '', 0, 1, 0),
(51, 71, 'media/produk/2023/09/62-71-3.jpeg', 3, '', 0, 1, 0),
(52, 71, 'media/produk/2023/09/62-71-4.jpeg', 4, '', 0, 1, 0),
(53, 70, 'media/produk/2023/09/62-70-1.jpeg', 1, '', 1, 1, 0),
(54, 70, 'media/produk/2023/09/62-70-2.jpeg', 2, '', 0, 1, 0),
(55, 70, 'media/produk/2023/09/62-70-3.jpeg', 3, '', 0, 1, 0),
(56, 70, 'media/produk/2023/09/62-70-4.jpeg', 4, '', 0, 1, 0),
(57, 69, 'media/produk/2023/09/62-69-1.jpeg', 1, '', 1, 1, 0),
(58, 69, 'media/produk/2023/09/62-69-2.jpeg', 2, '', 0, 1, 0),
(59, 69, 'media/produk/2023/09/62-69-3.jpeg', 3, '', 0, 1, 0),
(60, 69, 'media/produk/2023/09/62-69-4.jpeg', 4, '', 0, 1, 0),
(61, 68, 'media/produk/2023/09/62-68-1.jpeg', 1, '', 1, 1, 0),
(62, 68, 'media/produk/2023/09/62-68-2.jpeg', 2, '', 0, 1, 0),
(63, 68, 'media/produk/2023/09/62-68-3.jpeg', 3, '', 0, 1, 0),
(64, 68, 'media/produk/2023/09/62-68-4.jpeg', 4, '', 0, 1, 0),
(65, 67, 'media/produk/2023/09/62-67-1.jpeg', 1, '', 1, 1, 0),
(66, 67, 'media/produk/2023/09/62-67-2.jpeg', 2, '', 0, 1, 0),
(67, 67, 'media/produk/2023/09/62-67-3.jpeg', 3, '', 0, 1, 0),
(68, 67, 'media/produk/2023/09/62-67-4.jpeg', 4, '', 0, 1, 0),
(69, 66, 'media/produk/2023/09/62-66-1.jpeg', 1, '', 1, 1, 0),
(70, 66, 'media/produk/2023/09/62-66-2.jpeg', 2, '', 0, 1, 0),
(71, 66, 'media/produk/2023/09/62-66-3.jpeg', 3, '', 0, 1, 0),
(72, 66, 'media/produk/2023/09/62-66-4.jpeg', 4, '', 0, 1, 0),
(73, 65, 'media/produk/2023/09/62-65-1.jpeg', 1, '', 1, 1, 0),
(74, 65, 'media/produk/2023/09/62-65-2.jpeg', 2, '', 0, 1, 0),
(75, 65, 'media/produk/2023/09/62-65-3.jpeg', 3, '', 0, 1, 0),
(76, 65, 'media/produk/2023/09/62-65-4.jpeg', 4, '', 0, 1, 0),
(77, 64, 'media/produk/2023/09/62-64-1.jpeg', 1, '', 1, 1, 0),
(78, 64, 'media/produk/2023/09/62-64-2.jpeg', 2, '', 0, 1, 0),
(79, 64, 'media/produk/2023/09/62-64-3.jpeg', 3, '', 0, 1, 0),
(80, 64, 'media/produk/2023/09/62-64-4.jpeg', 4, '', 0, 1, 0),
(81, 63, 'media/produk/2023/09/62-63-1.jpeg', 1, '', 1, 1, 0),
(82, 63, 'media/produk/2023/09/62-63-2.jpeg', 2, '', 0, 1, 0),
(83, 63, 'media/produk/2023/09/62-63-3.jpeg', 3, '', 0, 1, 0),
(84, 63, 'media/produk/2023/09/62-63-4.jpeg', 4, '', 0, 1, 0),
(85, 62, 'media/produk/2023/09/62-62-1.jpeg', 1, '', 1, 1, 0),
(86, 62, 'media/produk/2023/09/62-62-2.jpeg', 2, '', 0, 1, 0),
(87, 62, 'media/produk/2023/09/62-62-3.jpeg', 3, '', 0, 1, 0),
(88, 62, 'media/produk/2023/09/62-62-4.jpeg', 4, '', 0, 1, 0),
(89, 61, 'media/produk/2023/09/62-61-1.jpeg', 1, '', 1, 1, 0),
(90, 61, 'media/produk/2023/09/62-61-2.jpeg', 2, '', 0, 1, 0),
(91, 61, 'media/produk/2023/09/62-61-3.jpeg', 3, '', 0, 1, 0),
(92, 61, 'media/produk/2023/09/62-61-4.jpeg', 4, '', 0, 1, 0),
(93, 60, 'media/produk/2023/09/62-60-1.jpeg', 1, '', 1, 1, 0),
(94, 60, 'media/produk/2023/09/62-60-2.jpeg', 2, '', 0, 1, 0),
(95, 60, 'media/produk/2023/09/62-60-3.jpeg', 3, '', 0, 1, 0),
(96, 60, 'media/produk/2023/09/62-60-4.jpeg', 4, '', 0, 1, 0),
(97, 59, 'media/produk/2023/09/62-59-1.jpeg', 1, '', 1, 1, 0),
(98, 59, 'media/produk/2023/09/62-59-2.jpeg', 2, '', 0, 1, 0),
(99, 59, 'media/produk/2023/09/62-59-3.jpeg', 3, '', 0, 1, 0),
(100, 59, 'media/produk/2023/09/62-59-4.jpeg', 4, '', 0, 1, 0),
(101, 58, 'media/produk/2023/09/62-58-1.jpeg', 1, '', 1, 1, 0),
(102, 58, 'media/produk/2023/09/62-58-2.jpeg', 2, '', 0, 1, 0),
(103, 58, 'media/produk/2023/09/62-58-3.jpeg', 3, '', 0, 1, 0),
(104, 58, 'media/produk/2023/09/62-58-4.jpeg', 4, '', 0, 1, 0),
(105, 57, 'media/produk/2023/09/62-57-1.jpeg', 1, '', 1, 1, 0),
(106, 57, 'media/produk/2023/09/62-57-2.jpeg', 2, '', 0, 1, 0),
(107, 57, 'media/produk/2023/09/62-57-3.jpeg', 3, '', 0, 1, 0),
(108, 57, 'media/produk/2023/09/62-57-4.jpeg', 4, '', 0, 1, 0),
(109, 56, 'media/produk/2023/09/62-56-1.jpeg', 1, '', 1, 1, 0),
(110, 56, 'media/produk/2023/09/62-56-2.jpeg', 2, '', 0, 1, 0),
(111, 56, 'media/produk/2023/09/62-56-3.jpeg', 3, '', 0, 1, 0),
(112, 56, 'media/produk/2023/09/62-56-4.jpeg', 4, '', 0, 1, 0),
(113, 55, 'media/produk/2023/09/62-55-1.jpeg', 1, '', 1, 1, 0),
(114, 55, 'media/produk/2023/09/62-55-2.jpeg', 2, '', 0, 1, 0),
(115, 55, 'media/produk/2023/09/62-55-3.jpeg', 3, '', 0, 1, 0),
(116, 55, 'media/produk/2023/09/62-55-4.jpeg', 4, '', 0, 1, 0),
(117, 54, 'media/produk/2023/09/62-54-1.jpeg', 1, '', 1, 1, 0),
(118, 54, 'media/produk/2023/09/62-54-2.jpeg', 2, '', 0, 1, 0),
(119, 54, 'media/produk/2023/09/62-54-3.jpeg', 3, '', 0, 1, 0),
(120, 54, 'media/produk/2023/09/62-54-4.jpeg', 4, '', 0, 1, 0),
(121, 53, 'media/produk/2023/09/62-53-1.jpeg', 1, '', 1, 1, 0),
(122, 53, 'media/produk/2023/09/62-53-2.jpeg', 2, '', 0, 1, 0),
(123, 53, 'media/produk/2023/09/62-53-3.jpeg', 3, '', 0, 1, 0),
(124, 53, 'media/produk/2023/09/62-53-4.jpeg', 4, '', 0, 1, 0),
(125, 52, 'media/produk/2023/09/62-52-1.jpeg', 1, '', 1, 1, 0),
(126, 52, 'media/produk/2023/09/62-52-2.jpeg', 2, '', 0, 1, 0),
(127, 52, 'media/produk/2023/09/62-52-3.jpeg', 3, '', 0, 1, 0),
(128, 52, 'media/produk/2023/09/62-52-4.jpeg', 4, '', 0, 1, 0),
(129, 51, 'media/produk/2023/09/62-51-1.jpeg', 1, '', 1, 1, 0),
(130, 51, 'media/produk/2023/09/62-51-2.jpeg', 2, '', 0, 1, 0),
(131, 51, 'media/produk/2023/09/62-51-3.jpeg', 3, '', 0, 1, 0),
(132, 51, 'media/produk/2023/09/62-51-4.jpeg', 4, '', 0, 1, 0),
(133, 50, 'media/produk/2023/09/62-50-1.jpeg', 1, '', 1, 1, 0),
(134, 50, 'media/produk/2023/09/62-50-2.jpeg', 2, '', 0, 1, 0),
(135, 50, 'media/produk/2023/09/62-50-3.jpeg', 3, '', 0, 1, 0),
(136, 50, 'media/produk/2023/09/62-50-4.jpeg', 4, '', 0, 1, 0),
(137, 49, 'media/produk/2023/09/62-49-1.jpeg', 1, '', 1, 1, 0),
(138, 49, 'media/produk/2023/09/62-49-2.jpeg', 2, '', 0, 1, 0),
(139, 49, 'media/produk/2023/09/62-49-3.jpeg', 3, '', 0, 1, 0),
(140, 49, 'media/produk/2023/09/62-49-4.jpeg', 4, '', 0, 1, 0),
(141, 48, 'media/produk/2023/09/62-48-1.jpeg', 1, '', 1, 1, 0),
(142, 48, 'media/produk/2023/09/62-48-2.jpeg', 2, '', 0, 1, 0),
(143, 48, 'media/produk/2023/09/62-48-3.jpeg', 3, '', 0, 1, 0),
(144, 48, 'media/produk/2023/09/62-48-4.jpeg', 4, '', 0, 1, 0),
(145, 47, 'media/produk/2023/09/62-47-1.jpeg', 1, '', 1, 1, 0),
(146, 47, 'media/produk/2023/09/62-47-2.jpeg', 2, '', 0, 1, 0),
(147, 47, 'media/produk/2023/09/62-47-3.jpeg', 3, '', 0, 1, 0),
(148, 47, 'media/produk/2023/09/62-47-4.jpeg', 4, '', 0, 1, 0),
(149, 46, 'media/produk/2023/09/62-46-1.jpeg', 1, '', 1, 1, 0),
(150, 46, 'media/produk/2023/09/62-46-2.jpeg', 2, '', 0, 1, 0),
(151, 46, 'media/produk/2023/09/62-46-3.jpeg', 3, '', 0, 1, 0),
(152, 46, 'media/produk/2023/09/62-46-4.jpeg', 4, '', 0, 1, 0),
(153, 45, 'media/produk/2023/09/62-45-1.jpeg', 1, '', 1, 1, 0),
(154, 45, 'media/produk/2023/09/62-45-2.jpeg', 2, '', 0, 1, 0),
(155, 45, 'media/produk/2023/09/62-45-3.jpeg', 3, '', 0, 1, 0),
(156, 45, 'media/produk/2023/09/62-45-4.jpeg', 4, '', 0, 1, 0),
(157, 44, 'media/produk/2023/09/62-44-1.jpeg', 1, '', 1, 1, 0),
(158, 44, 'media/produk/2023/09/62-44-2.jpeg', 2, '', 0, 1, 0),
(159, 44, 'media/produk/2023/09/62-44-3.jpeg', 3, '', 0, 1, 0),
(160, 44, 'media/produk/2023/09/62-44-4.jpeg', 4, '', 0, 1, 0),
(161, 43, 'media/produk/2023/09/62-43-1.jpeg', 1, '', 1, 1, 0),
(162, 43, 'media/produk/2023/09/62-43-2.jpeg', 2, '', 0, 1, 0),
(163, 43, 'media/produk/2023/09/62-43-3.jpeg', 3, '', 0, 1, 0),
(164, 43, 'media/produk/2023/09/62-43-4.jpeg', 4, '', 0, 1, 0),
(165, 42, 'media/produk/2023/09/62-42-1.jpeg', 1, '', 1, 1, 0),
(166, 42, 'media/produk/2023/09/62-42-2.jpeg', 2, '', 0, 1, 0),
(167, 42, 'media/produk/2023/09/62-42-3.jpeg', 3, '', 0, 1, 0),
(168, 42, 'media/produk/2023/09/62-42-4.jpeg', 4, '', 0, 1, 0),
(169, 41, 'media/produk/2023/09/62-41-1.jpeg', 1, '', 1, 1, 0),
(170, 41, 'media/produk/2023/09/62-41-2.jpeg', 2, '', 0, 1, 0),
(171, 41, 'media/produk/2023/09/62-41-3.jpeg', 3, '', 0, 1, 0),
(172, 41, 'media/produk/2023/09/62-41-4.jpeg', 4, '', 0, 1, 0),
(173, 40, 'media/produk/2023/09/62-40-1.jpeg', 1, '', 1, 1, 0),
(174, 40, 'media/produk/2023/09/62-40-2.jpeg', 2, '', 0, 1, 0),
(175, 40, 'media/produk/2023/09/62-40-3.jpeg', 3, '', 0, 1, 0),
(176, 40, 'media/produk/2023/09/62-40-4.jpeg', 4, '', 0, 1, 0),
(177, 39, 'media/produk/2023/09/62-39-1.jpeg', 1, '', 1, 1, 0),
(178, 39, 'media/produk/2023/09/62-39-2.jpeg', 2, '', 0, 1, 0),
(179, 39, 'media/produk/2023/09/62-39-3.jpeg', 3, '', 0, 1, 0),
(180, 39, 'media/produk/2023/09/62-39-4.jpeg', 4, '', 0, 1, 0),
(181, 38, 'media/produk/2023/09/62-38-1.jpeg', 1, '', 1, 1, 0),
(182, 38, 'media/produk/2023/09/62-38-2.jpeg', 2, '', 0, 1, 0),
(183, 38, 'media/produk/2023/09/62-38-3.jpeg', 3, '', 0, 1, 0),
(184, 38, 'media/produk/2023/09/62-38-4.jpeg', 4, '', 0, 1, 0),
(185, 37, 'media/produk/2023/09/62-37-1.jpeg', 1, '', 1, 1, 0),
(186, 37, 'media/produk/2023/09/62-37-2.jpeg', 2, '', 0, 1, 0),
(187, 37, 'media/produk/2023/09/62-37-3.jpeg', 3, '', 0, 1, 0),
(188, 37, 'media/produk/2023/09/62-37-4.jpeg', 4, '', 0, 1, 0),
(189, 36, 'media/produk/2023/09/62-36-1.jpeg', 1, '', 1, 1, 0),
(190, 36, 'media/produk/2023/09/62-36-2.jpeg', 2, '', 0, 1, 0),
(191, 36, 'media/produk/2023/09/62-36-3.jpeg', 3, '', 0, 1, 0),
(192, 36, 'media/produk/2023/09/62-36-4.jpeg', 4, '', 0, 1, 0),
(193, 35, 'media/produk/2023/09/62-35-1.jpeg', 1, '', 1, 1, 0),
(194, 35, 'media/produk/2023/09/62-35-2.jpeg', 2, '', 0, 1, 0),
(195, 35, 'media/produk/2023/09/62-35-3.jpeg', 3, '', 0, 1, 0),
(196, 35, 'media/produk/2023/09/62-35-4.jpeg', 4, '', 0, 1, 0),
(197, 34, 'media/produk/2023/09/62-34-1.jpeg', 1, '', 1, 1, 0),
(198, 34, 'media/produk/2023/09/62-34-2.jpeg', 2, '', 0, 1, 0),
(199, 34, 'media/produk/2023/09/62-34-3.jpeg', 3, '', 0, 1, 0),
(200, 34, 'media/produk/2023/09/62-34-4.jpeg', 4, '', 0, 1, 0),
(201, 33, 'media/produk/2023/09/62-33-1.jpeg', 1, '', 1, 1, 0),
(202, 33, 'media/produk/2023/09/62-33-2.jpeg', 2, '', 0, 1, 0),
(203, 33, 'media/produk/2023/09/62-33-3.jpeg', 3, '', 0, 1, 0),
(204, 33, 'media/produk/2023/09/62-33-4.jpeg', 4, '', 0, 1, 0),
(205, 32, 'media/produk/2023/09/62-32-1.jpeg', 1, '', 1, 1, 0),
(206, 32, 'media/produk/2023/09/62-32-2.jpeg', 2, '', 0, 1, 0),
(207, 32, 'media/produk/2023/09/62-32-3.jpeg', 3, '', 0, 1, 0),
(208, 32, 'media/produk/2023/09/62-32-4.jpeg', 4, '', 0, 1, 0),
(209, 31, 'media/produk/2023/09/62-31-1.jpeg', 1, '', 1, 1, 0),
(210, 31, 'media/produk/2023/09/62-31-2.jpeg', 2, '', 0, 1, 0),
(211, 31, 'media/produk/2023/09/62-31-3.jpeg', 3, '', 0, 1, 0),
(212, 31, 'media/produk/2023/09/62-31-4.jpeg', 4, '', 0, 1, 0),
(213, 30, 'media/produk/2023/09/62-30-1.jpeg', 1, '', 1, 1, 0),
(214, 30, 'media/produk/2023/09/62-30-2.jpeg', 2, '', 0, 1, 0),
(215, 30, 'media/produk/2023/09/62-30-3.jpeg', 3, '', 0, 1, 0),
(216, 30, 'media/produk/2023/09/62-30-4.jpeg', 4, '', 0, 1, 0),
(217, 29, 'media/produk/2023/09/62-29-1.jpeg', 1, '', 1, 1, 0),
(218, 29, 'media/produk/2023/09/62-29-2.jpeg', 2, '', 0, 1, 0),
(219, 29, 'media/produk/2023/09/62-29-3.jpeg', 3, '', 0, 1, 0),
(220, 29, 'media/produk/2023/09/62-29-4.jpeg', 4, '', 0, 1, 0),
(221, 28, 'media/produk/2023/09/62-28-1.jpeg', 1, '', 1, 1, 0),
(222, 28, 'media/produk/2023/09/62-28-2.jpeg', 2, '', 0, 1, 0),
(223, 28, 'media/produk/2023/09/62-28-3.jpeg', 3, '', 0, 1, 0),
(224, 28, 'media/produk/2023/09/62-28-4.jpeg', 4, '', 0, 1, 0),
(225, 27, 'media/produk/2023/09/62-27-1.jpeg', 1, '', 1, 1, 0),
(226, 27, 'media/produk/2023/09/62-27-2.jpeg', 2, '', 0, 1, 0),
(227, 27, 'media/produk/2023/09/62-27-3.jpeg', 3, '', 0, 1, 0),
(228, 27, 'media/produk/2023/09/62-27-4.jpeg', 4, '', 0, 1, 0),
(229, 26, 'media/produk/2023/09/62-26-1.jpeg', 1, '', 1, 1, 0),
(230, 26, 'media/produk/2023/09/62-26-2.jpeg', 2, '', 0, 1, 0),
(231, 26, 'media/produk/2023/09/62-26-3.jpeg', 3, '', 0, 1, 0),
(232, 26, 'media/produk/2023/09/62-26-4.jpeg', 4, '', 0, 1, 0),
(233, 25, 'media/produk/2023/09/62-25-1.jpeg', 1, '', 1, 1, 0),
(234, 25, 'media/produk/2023/09/62-25-2.jpeg', 2, '', 0, 1, 0),
(235, 25, 'media/produk/2023/09/62-25-3.jpeg', 3, '', 0, 1, 0),
(236, 25, 'media/produk/2023/09/62-25-4.jpeg', 4, '', 0, 1, 0),
(237, 24, 'media/produk/2023/09/62-24-1.jpeg', 1, '', 1, 1, 0),
(238, 24, 'media/produk/2023/09/62-24-2.jpeg', 2, '', 0, 1, 0),
(239, 24, 'media/produk/2023/09/62-24-3.jpeg', 3, '', 0, 1, 0),
(240, 24, 'media/produk/2023/09/62-24-4.jpeg', 4, '', 0, 1, 0),
(241, 23, 'media/produk/2023/09/62-23-1.jpeg', 1, '', 1, 1, 0),
(242, 23, 'media/produk/2023/09/62-23-2.jpeg', 2, '', 0, 1, 0),
(243, 23, 'media/produk/2023/09/62-23-3.jpeg', 3, '', 0, 1, 0),
(244, 23, 'media/produk/2023/09/62-23-4.jpeg', 4, '', 0, 1, 0),
(245, 22, 'media/produk/2023/09/62-22-1.jpeg', 1, '', 1, 1, 0),
(246, 22, 'media/produk/2023/09/62-22-2.jpeg', 2, '', 0, 1, 0),
(247, 22, 'media/produk/2023/09/62-22-3.jpeg', 3, '', 0, 1, 0),
(248, 22, 'media/produk/2023/09/62-22-4.jpeg', 4, '', 0, 1, 0),
(249, 21, 'media/produk/2023/09/62-21-1.jpeg', 1, '', 1, 1, 0),
(250, 21, 'media/produk/2023/09/62-21-2.jpeg', 2, '', 0, 1, 0),
(251, 21, 'media/produk/2023/09/62-21-3.jpeg', 3, '', 0, 1, 0),
(252, 21, 'media/produk/2023/09/62-21-4.jpeg', 4, '', 0, 1, 0),
(253, 20, 'media/produk/2023/09/62-20-1.jpeg', 1, '', 1, 1, 0),
(254, 20, 'media/produk/2023/09/62-20-2.jpeg', 2, '', 0, 1, 0),
(255, 20, 'media/produk/2023/09/62-20-3.jpeg', 3, '', 0, 1, 0),
(256, 20, 'media/produk/2023/09/62-20-4.jpeg', 4, '', 0, 1, 0),
(257, 19, 'media/produk/2023/09/62-19-1.jpeg', 1, '', 1, 1, 0),
(258, 19, 'media/produk/2023/09/62-19-2.jpeg', 2, '', 0, 1, 0),
(259, 19, 'media/produk/2023/09/62-19-3.jpeg', 3, '', 0, 1, 0),
(260, 19, 'media/produk/2023/09/62-19-4.jpeg', 4, '', 0, 1, 0),
(261, 18, 'media/produk/2023/09/62-18-1.jpeg', 1, '', 1, 1, 0),
(262, 18, 'media/produk/2023/09/62-18-2.jpeg', 2, '', 0, 1, 0),
(263, 18, 'media/produk/2023/09/62-18-3.jpeg', 3, '', 0, 1, 0),
(264, 18, 'media/produk/2023/09/62-18-4.jpeg', 4, '', 0, 1, 0),
(265, 12, 'media/produk/2023/09/62-12-1.jpeg', 1, '', 1, 1, 0),
(266, 12, 'media/produk/2023/09/62-12-2.jpeg', 2, '', 0, 1, 0),
(267, 12, 'media/produk/2023/09/62-12-3.jpeg', 3, '', 0, 1, 0),
(268, 12, 'media/produk/2023/09/62-12-4.jpeg', 4, '', 0, 1, 0),
(269, 17, 'media/produk/2023/09/62-17-1.jpeg', 1, '', 1, 1, 0),
(270, 17, 'media/produk/2023/09/62-17-2.jpeg', 2, '', 0, 1, 0),
(271, 17, 'media/produk/2023/09/62-17-3.jpeg', 3, '', 0, 1, 0),
(272, 17, 'media/produk/2023/09/62-17-4.jpeg', 4, '', 0, 1, 0),
(273, 16, 'media/produk/2023/09/62-16-1.jpeg', 1, '', 1, 1, 0),
(274, 16, 'media/produk/2023/09/62-16-2.jpeg', 2, '', 0, 1, 0),
(275, 16, 'media/produk/2023/09/62-16-3.jpeg', 3, '', 0, 1, 0),
(276, 16, 'media/produk/2023/09/62-16-4.jpeg', 4, '', 0, 1, 0),
(277, 15, 'media/produk/2023/09/62-15-1.jpeg', 1, '', 1, 1, 0),
(278, 15, 'media/produk/2023/09/62-15-2.jpeg', 2, '', 0, 1, 0),
(279, 15, 'media/produk/2023/09/62-15-3.jpeg', 3, '', 0, 1, 0),
(280, 15, 'media/produk/2023/09/62-15-4.jpeg', 4, '', 0, 1, 0),
(281, 14, 'media/produk/2023/09/62-14-1.jpeg', 1, '', 1, 1, 0),
(282, 14, 'media/produk/2023/09/62-14-2.jpeg', 2, '', 0, 1, 0),
(283, 14, 'media/produk/2023/09/62-14-3.jpeg', 3, '', 0, 1, 0),
(284, 14, 'media/produk/2023/09/62-14-4.jpeg', 4, '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `b_produk_harga`
--

CREATE TABLE `b_produk_harga` (
  `id` int(11) NOT NULL,
  `b_produk_id` int(11) NOT NULL,
  `spesifikasi` text DEFAULT NULL,
  `dari_qty` int(11) DEFAULT NULL,
  `ke_qty` int(11) DEFAULT NULL,
  `opr` varchar(3) DEFAULT NULL,
  `harga` decimal(18,2) DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b_produk_harga`
--

INSERT INTO `b_produk_harga` (`id`, `b_produk_id`, `spesifikasi`, `dari_qty`, `ke_qty`, `opr`, `harga`, `is_active`, `is_deleted`) VALUES
(48, 5, '[\"4:3\",\" > 0\"]', 0, 0, '>', 12000.00, 1, 0),
(49, 5, '[\"16:9\",\" > 0\"]', 0, 0, '>', 12000.00, 1, 0),
(50, 2, '[\"A4\",\" < 10\"]', 0, 10, '<', 25000.00, 1, 0),
(51, 2, '[\"A4\",\"10 - 50\"]', 10, 50, '-', 18000.00, 1, 0),
(52, 2, '[\"A4\",\" > 50\"]', 0, 50, '>', 17500.00, 1, 0),
(53, 2, '[\"A5\",\" < 10\"]', 0, 10, '<', 21000.00, 1, 0),
(54, 2, '[\"A5\",\"10 - 50\"]', 10, 50, '-', 20000.00, 1, 0),
(55, 2, '[\"A5\",\" > 50\"]', 0, 50, '>', 19000.00, 1, 0),
(56, 2, '[\"F4\",\" < 10\"]', 0, 10, '<', 22000.00, 1, 0),
(57, 2, '[\"F4\",\"10 - 50\"]', 10, 50, '-', 21000.00, 1, 0),
(58, 2, '[\"F4\",\" > 50\"]', 0, 50, '>', 20000.00, 1, 0),
(59, 6, '[\"2 x 4\",\" < 30\"]', 0, 30, '<', 5000.00, 1, 0),
(60, 6, '[\"2 x 4\",\" > 29\"]', 0, 29, '>', 7000.00, 1, 0),
(61, 6, '[\"4 x 8\",\" < 30\"]', 0, 30, '<', 5000.00, 1, 0),
(62, 6, '[\"4 x 8\",\" > 29\"]', 0, 29, '>', 7000.00, 1, 0),
(63, 6, '[\"2 x 2\",\" < 30\"]', 0, 30, '<', 5000.00, 1, 0),
(64, 6, '[\"2 x 2\",\" > 29\"]', 0, 29, '>', 7000.00, 1, 0),
(65, 7, '[\"B5\",\"Soft Cover\",\" < 50\"]', 0, 50, '<', 7000.00, 1, 0),
(66, 7, '[\"B5\",\"Soft Cover\",\" > 49\"]', 0, 49, '>', 7000.00, 1, 0),
(67, 7, '[\"B5\",\"Hard Cover\",\" < 50\"]', 0, 50, '<', 15000.00, 1, 0),
(68, 7, '[\"B5\",\"Hard Cover\",\" > 49\"]', 0, 49, '>', 15000.00, 1, 0),
(69, 7, '[\"A4\",\"Soft Cover\",\" < 50\"]', 0, 50, '<', 7000.00, 1, 0),
(70, 7, '[\"A4\",\"Soft Cover\",\" > 49\"]', 0, 49, '>', 7000.00, 1, 0),
(71, 7, '[\"A4\",\"Hard Cover\",\" < 50\"]', 0, 50, '<', 15000.00, 1, 0),
(72, 7, '[\"A4\",\"Hard Cover\",\" > 49\"]', 0, 49, '>', 15000.00, 1, 0),
(73, 8, '[\"30 x 20 x 5\",\" < 20\"]', 0, 20, '<', 20000.00, 1, 0),
(74, 8, '[\"30 x 20 x 5\",\"20 - 50\"]', 20, 50, '-', 18000.00, 1, 0),
(75, 8, '[\"30 x 20 x 5\",\" > 50\"]', 0, 50, '>', 15000.00, 1, 0),
(76, 9, '[\"Kardus\",\" < 10\"]', 0, 10, '<', 35000.00, 1, 0),
(77, 9, '[\"Kardus\",\" > 9\"]', 0, 9, '>', 32000.00, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `b_produk_item`
--

CREATE TABLE `b_produk_item` (
  `id` int(11) NOT NULL,
  `b_produk_id` int(11) NOT NULL,
  `blok` varchar(28) NOT NULL,
  `nomor` varchar(56) NOT NULL,
  `posisi` varchar(28) NOT NULL,
  `cdate` datetime NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b_produk_item`
--

INSERT INTO `b_produk_item` (`id`, `b_produk_id`, `blok`, `nomor`, `posisi`, `cdate`, `is_active`, `is_deleted`) VALUES
(1, 31, 'E', '48', 'hook', '2023-09-16 19:49:25', 1, 0),
(2, 10, 'A', '49', 'sayap', '2023-09-16 19:49:51', 1, 0),
(3, 10, 'B', '50', 'utama', '2023-09-16 19:50:26', 1, 0),
(4, 12, 'B', '1', 'sayap', '2023-09-16 19:50:45', 1, 1),
(5, 10, 'A', '45', 'sayap', '2023-09-16 22:46:34', 1, 0),
(6, 12, 'D', '18', 'hook', '2023-09-16 22:46:45', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `b_user`
--

CREATE TABLE `b_user` (
  `id` int(11) NOT NULL,
  `b_user_id` int(11) DEFAULT NULL COMMENT 'atasan',
  `a_unit_id` int(5) DEFAULT NULL,
  `a_jabatan_id` int(5) UNSIGNED DEFAULT NULL,
  `a_pengguna_id` int(4) NOT NULL,
  `google_id` varchar(128) NOT NULL DEFAULT '',
  `kode` varchar(24) DEFAULT NULL,
  `kode_lama` varchar(64) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL DEFAULT '',
  `foto` varchar(255) NOT NULL DEFAULT '',
  `welcome_message` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) DEFAULT NULL,
  `fnama` varchar(255) NOT NULL DEFAULT '',
  `lnama` varchar(78) NOT NULL DEFAULT ' ',
  `alamat` varchar(78) NOT NULL DEFAULT '',
  `alamat2` varchar(78) DEFAULT NULL,
  `kelurahan` varchar(78) NOT NULL DEFAULT '',
  `kecamatan` varchar(78) NOT NULL DEFAULT '',
  `kabkota` varchar(150) NOT NULL DEFAULT '',
  `provinsi` varchar(150) NOT NULL DEFAULT '',
  `negara` varchar(255) NOT NULL DEFAULT 'Indonesia',
  `kodepos` varchar(25) NOT NULL DEFAULT '',
  `nik` varchar(16) NOT NULL,
  `kelamin` int(1) NOT NULL DEFAULT 1 COMMENT '1 laki-laki 0 perempuan',
  `tlahir` varchar(78) NOT NULL DEFAULT '-' COMMENT 'tempat lahir',
  `bdate` date NOT NULL DEFAULT '1970-01-01' COMMENT 'tanggal lahir',
  `cdate` datetime NOT NULL COMMENT 'tanggal pembuatan',
  `adate` date DEFAULT NULL COMMENT 'tanggal aktifasi',
  `edate` date DEFAULT NULL COMMENT 'tanggal berakhir membership',
  `telp` varchar(25) NOT NULL DEFAULT '',
  `fb` varchar(255) NOT NULL DEFAULT '',
  `fb_id` int(11) DEFAULT NULL,
  `ig` varchar(255) NOT NULL DEFAULT '',
  `ig_id` int(11) DEFAULT NULL,
  `deposit` float NOT NULL DEFAULT 0 COMMENT 'saldo_deposit',
  `reward_poin` int(7) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL DEFAULT ' ',
  `reg_from` varchar(64) NOT NULL DEFAULT 'online',
  `know_from` varchar(48) DEFAULT NULL,
  `umur` int(3) NOT NULL DEFAULT 20,
  `npwp` varchar(128) NOT NULL DEFAULT '',
  `penilaian` text NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `api_reg_date` date DEFAULT NULL,
  `api_reg_token` varchar(48) DEFAULT NULL,
  `api_web_date` date DEFAULT NULL,
  `api_web_token` varchar(24) DEFAULT NULL,
  `api_mobile_date` date DEFAULT NULL,
  `api_mobile_token` varchar(24) DEFAULT NULL,
  `fcm_token` varchar(255) NOT NULL DEFAULT ' ',
  `device` varchar(24) NOT NULL DEFAULT 'web',
  `apikey` varchar(28) NOT NULL DEFAULT '',
  `is_agree` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `is_confirmed` int(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1 ya, 0 belum konfirmasi, flag setelah konfirmasi',
  `is_premium` int(1) UNSIGNED NOT NULL DEFAULT 0,
  `is_wa_verified` int(1) NOT NULL DEFAULT 1,
  `is_wa_send` int(1) NOT NULL DEFAULT 1,
  `is_active` int(1) UNSIGNED NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='tabel pengguna, bisa member atau user vendor,';

--
-- Dumping data for table `b_user`
--

INSERT INTO `b_user` (`id`, `b_user_id`, `a_unit_id`, `a_jabatan_id`, `a_pengguna_id`, `google_id`, `kode`, `kode_lama`, `email`, `username`, `foto`, `welcome_message`, `password`, `fnama`, `lnama`, `alamat`, `alamat2`, `kelurahan`, `kecamatan`, `kabkota`, `provinsi`, `negara`, `kodepos`, `nik`, `kelamin`, `tlahir`, `bdate`, `cdate`, `adate`, `edate`, `telp`, `fb`, `fb_id`, `ig`, `ig_id`, `deposit`, `reward_poin`, `image`, `reg_from`, `know_from`, `umur`, `npwp`, `penilaian`, `rating`, `api_reg_date`, `api_reg_token`, `api_web_date`, `api_web_token`, `api_mobile_date`, `api_mobile_token`, `fcm_token`, `device`, `apikey`, `is_agree`, `is_confirmed`, `is_premium`, `is_wa_verified`, `is_wa_send`, `is_active`, `is_deleted`) VALUES
(1, NULL, 0, 0, 0, '', '', NULL, 'rezzibal@gmail.com', 'rezziqbal', '', '', 'b5dd431cc61866b146777675f00b0e10', 'Rezza', '', '', '', '', '', '', '', '', '', '3204460304980004', 0, '', '2023-09-05', '2023-09-05 12:25:25', '2023-09-05', '2023-09-05', '085789701750', '', NULL, '', NULL, 0, 0, '', 'online', NULL, 30, '', 'Mantap', 0, '2023-09-05', '', '0000-00-00', '', '0000-00-00', '', '', '', '', 0, 0, 0, 1, 1, 1, 0),
(2, NULL, 0, 0, 0, '', '', NULL, '', '', '', '', '', 'Buldany', '', '', '', '', '', '', '', '', '', '', 0, '', '2023-06-14', '2023-06-14 13:04:20', NULL, NULL, '', '', NULL, '', NULL, 0, 0, '', 'online', NULL, 30, '', '', 0, NULL, '', '0000-00-00', '', '0000-00-00', '', '', '', '', 0, 0, 0, 1, 1, 1, 0),
(3, NULL, NULL, NULL, 0, '', NULL, NULL, '', '', '', '', NULL, 'Buldany', ' ', '', NULL, '', '', '', '', 'Indonesia', '', '', 1, '-', '1970-01-01', '0000-00-00 00:00:00', NULL, NULL, '', '', NULL, '', NULL, 0, 0, ' ', 'online', NULL, 20, '', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, ' ', 'web', '', 0, 0, 0, 1, 1, 1, 1),
(4, NULL, NULL, NULL, 0, '', NULL, NULL, '', '', '', '', NULL, 'Asep', ' ', '', NULL, '', '', '', '', 'Indonesia', '', '', 1, '-', '1970-01-01', '0000-00-00 00:00:00', NULL, NULL, '', '', NULL, '', NULL, 0, 0, ' ', 'online', NULL, 20, '', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, ' ', 'web', '', 0, 0, 0, 1, 1, 1, 0),
(5, NULL, NULL, NULL, 0, '', NULL, NULL, 'farid@gmail.com', 'farid@gmail.com', '', '', '$2y$10$6fZeAZ9.1eDyuA2hloqgBepcoMr95pJ/vJ7fa7K54eaJkNeLoYzC6', 'Farid AHmad Fadhilah', ' ', '', '', '', '', '', '', 'Indonesia', '', '', 1, '-', '1970-01-01', '2023-09-06 16:13:13', NULL, NULL, '085780701750', '', NULL, '', NULL, 0, 0, ' ', 'online', NULL, 20, '', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, ' ', 'web', '', 0, 0, 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `b_user_module`
--

CREATE TABLE `b_user_module` (
  `id` int(11) NOT NULL,
  `a_jabatan_id` int(11) NOT NULL,
  `b_user_id` int(11) NOT NULL,
  `a_jpenilaian_id` int(11) NOT NULL,
  `type` enum('chart','read','create','edit','delete','export') NOT NULL,
  `cdate` datetime NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_asesmen`
--

CREATE TABLE `c_asesmen` (
  `id` int(5) NOT NULL,
  `a_jpenilaian_id` int(5) NOT NULL,
  `b_user_id_penilai` int(11) NOT NULL,
  `b_user_id` int(5) NOT NULL,
  `a_ruangan_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `nilai` text NOT NULL,
  `ntype` enum('angka','persen') NOT NULL DEFAULT 'angka' COMMENT 'nilai type',
  `cdate` datetime NOT NULL,
  `durasi` decimal(18,2) NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_jadwal`
--

CREATE TABLE `c_jadwal` (
  `id` int(5) NOT NULL,
  `a_pengguna_id` int(5) NOT NULL,
  `a_kategori_id` int(5) NOT NULL,
  `day` int(1) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `stime` varchar(15) NOT NULL,
  `etime` varchar(15) NOT NULL,
  `cdate` datetime NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_jadwal`
--

INSERT INTO `c_jadwal` (`id`, `a_pengguna_id`, `a_kategori_id`, `day`, `hari`, `date`, `stime`, `etime`, `cdate`, `is_active`, `is_deleted`) VALUES
(1, 425, 16, 1, 'tes', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:11:49', 1, 1),
(2, 425, 16, 2, 'selasa', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:16:42', 1, 0),
(3, 432, 16, 1, 'senin', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:19:05', 1, 0),
(4, 435, 16, 1, 'senin', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:19:17', 1, 0),
(5, 421, 16, 3, 'rabu', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:19:34', 1, 0),
(6, 426, 16, 4, 'kamis', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:19:50', 1, 0),
(7, 424, 16, 6, 'sabtu', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:20:27', 1, 0),
(8, 411, 16, 7, 'minggu', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 05:20:39', 1, 0),
(9, 434, 17, 6, 'sabtu', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 07:00:03', 1, 0),
(10, 423, 17, 6, 'sabtu', '0000-00-00 00:00:00', '08:00', '20:00', '2023-09-16 07:00:20', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `c_order`
--

CREATE TABLE `c_order` (
  `id` int(11) NOT NULL,
  `kode` varchar(128) NOT NULL,
  `b_user_id` int(11) NOT NULL,
  `a_pengguna_id` int(11) NOT NULL,
  `a_rekening_id` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` varchar(128) NOT NULL,
  `metode_pembayaran` varchar(128) NOT NULL,
  `metode` varchar(128) NOT NULL,
  `diskon` decimal(3,1) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `is_setor` int(1) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `total_harga` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_order`
--

INSERT INTO `c_order` (`id`, `kode`, `b_user_id`, `a_pengguna_id`, `a_rekening_id`, `cdate`, `tgl_pesan`, `tgl_selesai`, `status`, `metode_pembayaran`, `metode`, `diskon`, `gambar`, `catatan`, `is_setor`, `is_active`, `is_deleted`, `total_harga`) VALUES
(10, 'ORD-A9-20230916-0', 1, 427, 0, '2023-09-16 23:21:33', '2023-09-16 00:00:00', '0000-00-00 00:00:00', 'booking', 'cash', 'Cash Keras', 0.0, '', '', 0, 1, 0, 1000000.00),
(11, 'ORD-A9-20230918-11', 1, 427, 0, '2023-09-18 07:02:29', '2023-09-18 00:00:00', '0000-00-00 00:00:00', 'pembayaran', 'cash', 'Cash Keras', 0.0, '', '', 0, 1, 0, 300000000.00),
(12, 'ORD-A9-20230918-12', 1, 427, 1, '2023-09-18 16:18:55', '2023-09-18 00:00:00', '0000-00-00 00:00:00', 'pembayaran', 'transfer', 'Cash Keras', 0.0, 'media/kategori/2023/09/62-12-.jpg', '<p>Pelunasan Bangunan diantaranya :</p><ul><li>Genting</li><li>Semen</li><li>Batubata</li><li>Borongan</li></ul>', 0, 1, 0, 268160000.00),
(13, 'ORD-A9-20230918-13', 4, 437, 1, '2023-09-18 22:41:50', '2023-09-18 00:00:00', '0000-00-00 00:00:00', 'booking', 'transfer', 'Cash Bertahap', 0.0, 'media/bukti/2023/09/62-13-.jpeg', '<p>mantap sekalih banget</p>', 0, 1, 0, 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `c_order_produk`
--

CREATE TABLE `c_order_produk` (
  `id` int(11) NOT NULL,
  `c_order_id` int(11) NOT NULL,
  `d_item_produk_id` varchar(128) NOT NULL,
  `qty` int(10) NOT NULL,
  `b_produk_id` int(11) NOT NULL,
  `b_produk_id_harga` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` varchar(128) NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 0,
  `penilaian` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `sub_harga` decimal(18,2) NOT NULL,
  `ongkir` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_order_produk`
--

INSERT INTO `c_order_produk` (`id`, `c_order_id`, `d_item_produk_id`, `qty`, `b_produk_id`, `b_produk_id_harga`, `cdate`, `tgl_pesan`, `tgl_selesai`, `status`, `rating`, `penilaian`, `is_active`, `is_deleted`, `sub_harga`, `ongkir`) VALUES
(20, 10, '', 0, 1, 0, '2023-09-16 23:21:33', '2023-09-16 00:00:00', '0000-00-00 00:00:00', 'booking', 0, '', 1, 0, 1000000.00, 0.00),
(21, 11, '', 0, 1, 0, '2023-09-18 07:02:29', '2023-09-18 00:00:00', '0000-00-00 00:00:00', 'pembayaran', 0, '', 1, 0, 300000000.00, 0.00),
(27, 12, '', 0, 1, 0, '2023-09-18 18:55:30', '2023-09-18 00:00:00', '0000-00-00 00:00:00', 'pembayaran', 0, '', 1, 0, 268160000.00, 0.00),
(31, 13, '', 0, 3, 0, '2023-09-18 22:51:13', '2023-09-18 00:00:00', '0000-00-00 00:00:00', 'booking', 0, '', 1, 0, 1000000.00, 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_banner`
--
ALTER TABLE `a_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_blog`
--
ALTER TABLE `a_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_kategori`
--
ALTER TABLE `a_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_modules`
--
ALTER TABLE `a_modules`
  ADD PRIMARY KEY (`identifier`),
  ADD KEY `children_identifier` (`children_identifier`);

--
-- Indexes for table `a_partner`
--
ALTER TABLE `a_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_pengguna`
--
ALTER TABLE `a_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `a_pengguna_username_unq` (`username`),
  ADD KEY `a_company_id` (`a_company_id`),
  ADD KEY `a_jabatan_id` (`a_jabatan_id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `a_pengguna_module`
--
ALTER TABLE `a_pengguna_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fka_modules_identifier` (`a_modules_identifier`);

--
-- Indexes for table `a_rekening`
--
ALTER TABLE `a_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_three_d`
--
ALTER TABLE `a_three_d`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `b_produk`
--
ALTER TABLE `b_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_kategori_id` (`a_kategori_id`);

--
-- Indexes for table `b_produk_gambar`
--
ALTER TABLE `b_produk_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b_produk_id` (`b_produk_id`);

--
-- Indexes for table `b_produk_harga`
--
ALTER TABLE `b_produk_harga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b_produk_id` (`b_produk_id`);

--
-- Indexes for table `b_produk_item`
--
ALTER TABLE `b_produk_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `b_produk_id` (`b_produk_id`);

--
-- Indexes for table `b_user`
--
ALTER TABLE `b_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_api_web_token` (`api_web_token`),
  ADD KEY `kode` (`kode`),
  ADD KEY `a_company_id` (`a_unit_id`),
  ADD KEY `a_departemen_id` (`a_jabatan_id`),
  ADD KEY `a_pengguna_id` (`b_user_id`),
  ADD KEY `idx_is_active` (`google_id`),
  ADD KEY `idx_is_confirmed` (`kode_lama`),
  ADD KEY `a_pengguna_id_2` (`a_pengguna_id`);

--
-- Indexes for table `b_user_module`
--
ALTER TABLE `b_user_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `a_jabatan_id` (`a_jabatan_id`),
  ADD KEY `b_user_id` (`b_user_id`,`a_jpenilaian_id`);

--
-- Indexes for table `c_asesmen`
--
ALTER TABLE `c_asesmen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_jadwal`
--
ALTER TABLE `c_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_order`
--
ALTER TABLE `c_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_order_produk`
--
ALTER TABLE `c_order_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_order_id` (`c_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_banner`
--
ALTER TABLE `a_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `a_blog`
--
ALTER TABLE `a_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `a_kategori`
--
ALTER TABLE `a_kategori`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `a_partner`
--
ALTER TABLE `a_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `a_pengguna`
--
ALTER TABLE `a_pengguna`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=439;

--
-- AUTO_INCREMENT for table `a_pengguna_module`
--
ALTER TABLE `a_pengguna_module`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3195;

--
-- AUTO_INCREMENT for table `a_rekening`
--
ALTER TABLE `a_rekening`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `a_three_d`
--
ALTER TABLE `a_three_d`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `b_produk`
--
ALTER TABLE `b_produk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `b_produk_gambar`
--
ALTER TABLE `b_produk_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `b_produk_harga`
--
ALTER TABLE `b_produk_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `b_produk_item`
--
ALTER TABLE `b_produk_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `b_user`
--
ALTER TABLE `b_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `b_user_module`
--
ALTER TABLE `b_user_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_asesmen`
--
ALTER TABLE `c_asesmen`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_jadwal`
--
ALTER TABLE `c_jadwal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `c_order`
--
ALTER TABLE `c_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `c_order_produk`
--
ALTER TABLE `c_order_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `a_modules`
--
ALTER TABLE `a_modules`
  ADD CONSTRAINT `a_modules_ibfk_1` FOREIGN KEY (`children_identifier`) REFERENCES `a_modules` (`identifier`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `a_pengguna_module`
--
ALTER TABLE `a_pengguna_module`
  ADD CONSTRAINT `a_pengguna_module_ibfk_2` FOREIGN KEY (`a_modules_identifier`) REFERENCES `a_modules` (`identifier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
