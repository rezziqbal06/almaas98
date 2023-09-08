-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 01:20 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almaas98_db`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_banner`
--

INSERT INTO `a_banner` (`id`, `nama`, `slug`, `type`, `deskripsi`, `cdate`, `gambar`, `is_active`, `is_deleted`) VALUES
(1, 'RCTI OKE', 'rcti-oke', 'kustomer', 'Tes', '0000-00-00 00:00:00', 'media/kategori/2023/05/62-1-.png', 1, 1),
(2, 'SCTV', 'sctv', 'partner', 'tes', '0000-00-00 00:00:00', 'media/partner/2023/05/62-2-.png', 1, 1),
(3, 'The Leader In Quality Custom', 'the-leader-in-quality-custom', '', 'Lorem ipsum dolor sit amet consectetur adipiscing elit suspendisse, metus mattis urna senectus cursus himenaeos fermentum dictum, auctor nostra eros erat dapibus phasellus placerat. Etiam ac mus auctor gravida urna senectus ante, vulputate aptent ligula nunc quisque eros mauris hac, nascetur nullam tempus ullamcorper lacus elementum. Class bibendum consequat dictumst urna ad cursus, eu mauris parturient dapibus placerat senectus, tellus euismod nullam facilisis at. Posuere vulputate phasellus risus platea eu a massa, aliquet proin penatibus vel habitasse scelerisque eros tempor, etiam natoque primis integer vivamus sodales. Erat parturient vulputate porta libero sed imperdiet donec feugiat mi convallis, rutrum praesent augue pellentesque ante vel dui fringilla habitasse, ullamcorper nisl in natoque eget hac penatibus eleifend cubilia. Cubilia senectus enim aenean congue quam massa vestibulum laoreet, id varius felis tristique ultricies cum ultrices nisi, mus nullam metus molestie sed arcu nisl.', '0000-00-00 00:00:00', 'media/banner/2023/06/62-3-.jpeg', 1, 0),
(4, 'Design Image Just Go Easy', 'design-image-just-go-easy', '', '<p>Lorem ipsum dolor sit amet <a href=\"http://localhost/karyaabadi/produk/buku-tulis\">consectetur </a>adipiscing elit suspendisse, metus mattis urna senectus cursus himenaeos fermentum dictum, auctor nostra eros erat dapibus phasellus placerat. Etiam ac mus auctor gravida urna senectus ante, vulputate aptent ligula nunc quisque eros mauris hac, nascetur nullam tempus ullamcorper lacus elementum. Class bibendum consequat dictumst urna ad cursus, eu mauris parturient dapibus placerat senectus, tellus euismod nullam facilisis at. Posuere vulputate phasellus risus platea eu a massa, aliquet proin penatibus vel habitasse scelerisque eros tempor, etiam natoque primis integer vivamus sodales. Erat parturient vulputate porta libero sed imperdiet donec feugiat mi convallis, rutrum praesent augue pellentesque ante vel dui fringilla habitasse, ullamcorper nisl in natoque eget hac penatibus eleifend cubilia. Cubilia senectus enim aenean congue quam massa vestibulum laoreet, id varius felis tristique ultricies cum ultrices nisi, mus nullam metus molestie sed arcu nisl.</p>', '0000-00-00 00:00:00', 'media/banner/2023/06/62-4-.jpeg', 1, 0),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_blog`
--

INSERT INTO `a_blog` (`id`, `judul`, `slug`, `text`, `gambar`, `kategori`, `meta_desc`, `meta_keyword`, `count_read`, `cdate`, `is_active`, `is_deleted`) VALUES
(1, 'Kartu Perusahaan Mencerminkan Seberapa Serius Dirimu', 'kartu-perusahaan-mencerminkan-seberapa-serius-dirimu', '<p>Lorem ipsum dolor sit amet <a href=\"http://localhost/karyaabadi/produk/buku-tulis\">consectetur </a>adipiscing elit suspendisse, metus mattis urna senectus cursus himenaeos fermentum dictum, auctor nostra eros erat dapibus phasellus placerat. Etiam ac mus auctor gravida urna senectus ante, vulputate aptent ligula nunc quisque eros mauris hac, nascetur nullam tempus ullamcorper lacus elementum. Class bibendum consequat dictumst urna ad cursus, eu mauris parturient dapibus placerat senectus, tellus euismod nullam facilisis at. Posuere vulputate phasellus risus platea eu a massa, aliquet proin penatibus vel habitasse scelerisque eros tempor, etiam natoque primis integer vivamus sodales. Erat parturient vulputate porta libero sed imperdiet donec feugiat mi convallis, rutrum praesent augue pellentesque ante vel dui fringilla habitasse, ullamcorper nisl in natoque eget hac penatibus eleifend cubilia. Cubilia senectus enim aenean congue quam massa vestibulum laoreet, id varius felis tristique ultricies cum ultrices nisi, mus nullam metus molestie sed arcu nisl.</p>', 'media/blog/2023/06/62-1-.jpg', 'Usaha', '', '', 0, '2023-07-03 16:11:56', 1, 0),
(2, 'Sebarkan Kebahagiaan Dengan Undangan Terbaikmu', 'sebarkan-kebahagiaan-dengan-undangan-terbaikmu', '<p>Lorem ipsum dolor sit amet consectetur adipiscing elit at phasellus, parturient neque bibendum sollicitudin consequat habitant faucibus cum, viverra scelerisque leo aptent blandit velit taciti pretium. Suspendisse ante tellus sem interdum fames arcu felis semper aliquam velit, elementum curae nisl maecenas varius senectus suscipit neque vulputate, ut tincidunt mollis viverra nam facilisi egestas ad gravida. Venenatis aliquet ante dictumst morbi platea torquent augue sed risus class feugiat, varius imperdiet diam habitant iaculis magna egestas justo interdum etiam, nostra pretium integer potenti et commodo est eros blandit pharetra. Bibendum gravida torquent leo pretium metus duis ante senectus facilisi eleifend facilisis, sodales et urna in semper nec etiam commodo venenatis risus. Viverra montes imperdiet leo netus nisl phasellus commodo primis et habitasse, faucibus dictumst sem etiam mattis inceptos sodales fringilla accumsan. Dapibus varius quis lacus porttitor proin metus arcu, fusce per vitae convallis justo aliquam, blandit netus donec gravida taciti nisl. Imperdiet mattis maecenas nibh consequat senectus lectus pulvinar potenti turpis sollicitudin, dis ac odio velit facilisis felis volutpat mauris.</p><p>Quam vel justo aliquam habitant sem natoque urna, facilisi vulputate hendrerit a molestie in convallis curae, fames elementum quis class est montes. Odio luctus eu bibendum neque magna integer tellus suspendisse, netus velit curabitur elementum non fusce vehicula, placerat nec habitasse hac viverra ad molestie. Gravida elementum aliquam parturient magnis fames nascetur hendrerit euismod dis sociis augue quam integer, congue ornare est tortor accumsan nisi vivamus placerat bibendum sociosqu nam.</p>', 'media/blog/2023/06/62-2-.jpg', 'Undangan Pernikahan', '', '', 0, '2023-07-04 00:00:00', 1, 0),
(3, 'Pemilihan Warna Dalam Color Grading', 'pemilihan-warna-dalam-color-grading', '<p>Lorem ipsum dolor sit amet consectetur adipiscing elit at phasellus, parturient neque bibendum sollicitudin consequat habitant faucibus cum, viverra scelerisque leo aptent blandit velit taciti pretium. Suspendisse ante tellus sem interdum fames arcu felis semper aliquam velit, elementum curae nisl maecenas varius senectus suscipit neque vulputate, ut tincidunt mollis viverra nam facilisi egestas ad gravida. Venenatis aliquet ante dictumst morbi platea torquent augue sed risus class feugiat, varius imperdiet diam habitant iaculis magna egestas justo interdum etiam, nostra pretium integer potenti et commodo est eros blandit pharetra. Bibendum gravida torquent leo pretium metus duis ante senectus facilisi eleifend facilisis, sodales et urna in semper nec etiam commodo venenatis risus. Viverra montes imperdiet leo netus nisl phasellus commodo primis et habitasse, faucibus dictumst sem etiam mattis inceptos sodales fringilla accumsan. Dapibus varius quis lacus porttitor proin metus arcu, fusce per vitae convallis justo aliquam, blandit netus donec gravida taciti nisl. Imperdiet mattis maecenas nibh consequat senectus lectus pulvinar potenti turpis sollicitudin, dis ac odio velit facilisis felis volutpat mauris.</p><p>Quam vel justo aliquam habitant sem natoque urna, facilisi vulputate hendrerit a molestie in convallis curae, fames elementum quis class est montes. Odio luctus eu bibendum neque magna integer tellus suspendisse, netus velit curabitur elementum non fusce vehicula, placerat nec habitasse hac viverra ad molestie. Gravida elementum aliquam parturient magnis fames nascetur hendrerit euismod dis sociis augue quam integer, congue ornare est tortor accumsan nisi vivamus placerat bibendum sociosqu nam.</p>', 'media/blog/2023/06/62-3-.jpg', 'Buku', '', '', 0, '2023-01-03 00:00:00', 1, 0),
(4, 'Ukuran Buku terlaris tahun 2023', 'ukuran-buku-terlaris-tahun-2023', '<p>Lorem ipsum dolor sit amet consectetur adipiscing elit at phasellus, parturient neque bibendum sollicitudin consequat habitant faucibus cum, viverra scelerisque leo aptent blandit velit taciti pretium. Suspendisse ante tellus sem interdum fames arcu felis semper aliquam velit, elementum curae nisl maecenas varius senectus suscipit neque vulputate, ut tincidunt mollis viverra nam facilisi egestas ad gravida. Venenatis aliquet ante dictumst morbi platea torquent augue sed risus class feugiat, varius imperdiet diam habitant iaculis magna egestas justo interdum etiam, nostra pretium integer potenti et commodo est eros blandit pharetra. Bibendum gravida torquent leo pretium metus duis ante senectus facilisi eleifend facilisis, sodales et urna in semper nec etiam commodo venenatis risus. Viverra montes imperdiet leo netus nisl phasellus commodo primis et habitasse, faucibus dictumst sem etiam mattis inceptos sodales fringilla accumsan. Dapibus varius quis lacus porttitor proin metus arcu, fusce per vitae convallis justo aliquam, blandit netus donec gravida taciti nisl. Imperdiet mattis maecenas nibh consequat senectus lectus pulvinar potenti turpis sollicitudin, dis ac odio velit facilisis felis volutpat mauris.</p><p>Quam vel justo aliquam habitant sem natoque urna, facilisi vulputate hendrerit a molestie in convallis curae, fames elementum quis class est montes. Odio luctus eu bibendum neque magna integer tellus suspendisse, netus velit curabitur elementum non fusce vehicula, placerat nec habitasse hac viverra ad molestie. Gravida elementum aliquam parturient magnis fames nascetur hendrerit euismod dis sociis augue quam integer, congue ornare est tortor accumsan nisi vivamus placerat bibendum sociosqu nam.</p>', 'media/blog/2023/06/62-4-.jpg', 'Buku', '', '', 0, '2023-01-03 00:00:00', 1, 0),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_kategori`
--

INSERT INTO `a_kategori` (`id`, `nama`, `slug`, `deskripsi`, `gambar`, `siteplan`, `data_siteplan`, `cdate`, `count_read`, `is_active`, `is_deleted`) VALUES
(16, 'AlMaas 4 Residence', 'almaas-4-residence', 'Tes', 'media/kategori/2023/08/62-16-.png', 'media/siteplan/2023/09/62-16-.svg', '{\"path50\":{\"data\":\"ID-10|TP-48|LT-120|LB-95|L-2|K-2|T-1|G-1|B-C|N-67\",\"status\":\"tersedia\"},\"path49\":{\"data\":\"ID-10|TP-48|LT-0|LB-0|L-2|K-2|T-1|G-1|B-C|N-68\",\"status\":\"tersedia\"},\"path48\":{\"data\":\"ID-10|TP-48|LT-0|LB-0|L-2|K-2|T-1|G-1|B-C|N-69\",\"status\":\"tersedia\"},\"path7\":{\"data\":\"ID-10|TP-48|LT-0|LB-0|L-2|K-2|T-1|G-1|B-A|N-36\",\"status\":\"tersedia\"},\"path8\":{\"data\":\"ID-10|TP-48|LT-120|LB-95|L-2|K-2|T-1|G-1|B-A|N-12\",\"status\":\"booking\"},\"path19\":{\"data\":\"ID-10|TP-48|LT-0|LB-0|L-2|K-2|T-1|G-1|B-A|N-56\",\"status\":\"tersedia\"}}', '2023-08-30 15:09:20', 0, 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list modul yang ada dimenu atau tidak ada dimenu';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabel pengguna';

--
-- Dumping data for table `a_pengguna`
--

INSERT INTO `a_pengguna` (`id`, `a_company_id`, `a_company_nama`, `a_company_kode`, `a_jabatan_id`, `a_jabatan_nama`, `username`, `password`, `email`, `nama`, `foto`, `welcome_message`, `scope`, `nip`, `alamat`, `alamat2`, `alamat_kecamatan`, `alamat_kabkota`, `alamat_provinsi`, `alamat_negara`, `alamat_kodepos`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `status_pernikahan`, `telp_rumah`, `telp_hp`, `bank_rekening_nomor`, `bank_rekening_nama`, `bank_nama`, `npwp`, `kerja_terakhir`, `kerja_terakhir_jabatan`, `kerja_terakhir_gaji`, `pendidikan_terakhir`, `pendidikan_terakhir_jenjang`, `pendidikan_terakhir_tahun`, `ibu_nama`, `ibu_pekerjaan`, `tgl_kerja_mulai`, `tgl_kerja_akhir`, `tgl_kontrak_akhir`, `karyawan_status`, `nama_perusahaan`, `is_karyawan`, `is_active`, `is_deleted`, `a_pengguna_id`, `is_admin_master`) VALUES
(1, NULL, 'Almaas98', '-', NULL, '', 'mimind', '$2y$10$bTB1dRnKfzVmP.Z3y1r2OuhkyotKFMhfxeAsAn7cpb/sY8LF00Zzi', 'admin@gmail.com', 'Administrator Almaas 98', 'media/pengguna/2023/09/62-1-.png', 'Selamat Beraktifitas', 'all', '-', '', '', '', '', '', '', '', '', NULL, 1, 'belum menikah', '', '', '', '', '', '', '', '', '0', '', 'SMA', 1971, '', '', '0000-00-00', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 0, NULL, 1),
(406, NULL, 'Almaas98', '-', NULL, 'Sales', '', '', '', 'Zamzam Ramadhan', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '087893928384', '', '', '', '', '', '', NULL, 'SMA', 'SMA', 1971, '', '', '0000-00-00', '0000-00-00', NULL, 'Tetap', '', 0, 1, 1, NULL, 0),
(407, NULL, 'Almaas98', '-', NULL, 'Sales', 'ujang', 'e10adc3949ba59abbe56e057f20f883e', '', 'Ujang', '', '', 'none', '-', '', '', '', '', '', '', ' ', '', NULL, 1, 'belum menikah', NULL, '081923871298', '', '', '', '', '', '', NULL, 'S1', 'SMA', 1971, '', '', '2023-08-23', '0000-00-00', NULL, 'Kontrak', '', 0, 1, 1, NULL, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='hak akses pengguna';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `b_produk`
--

INSERT INTO `b_produk` (`id`, `a_kategori_id`, `nama`, `slug`, `gambar`, `deskripsi`, `cdate`, `spesifikasi`, `harga`, `tipe`, `blok`, `status`, `nomor`, `luas_bangunan`, `luas_tanah`, `lantai`, `kamar_tidur`, `toilet`, `garasi`, `listrik`, `air`, `a_three_d_id`, `lat`, `lang`, `gmaps`, `count_read`, `is_active`, `is_deleted`) VALUES
(10, 16, 'Cluster 48', 'rumah-2', 'media/produk/2023/08/62-10-1.jpeg', '<p><strong>Lorem ipsum dolor sit amet, c</strong>onsectetur adipiscing elit. Per nisl ullamcorper dis risus sed nascetur at tincidunt, elementum habitasse rhoncus fusce lacus lectus himenaeos nulla egestas, phasellus laoreet quis a feugiat mattis litora.</p>', '2023-06-07 23:09:15', '{\"Bahan\":[\"Bludru\",\"Kulit\"],\"QTY\":[\" < 30\",\"30 - 100\",\" > 100\"]}', 350000000, '48', '', 'Tersedia', '', 95, 120, 2, 2, 1, 1, '1300', 'pdam', 2, '', '', '', 0, 1, 0),
(11, 16, 'Cluster 36', 'rumah', 'media/produk/2023/08/62-11-1.jpeg', '<ul><li>Jenis Bangunan : Bata&nbsp;</li><li>Kenteng: Tanah Liat&nbsp;</li></ul><p>Lorem ipsum dolor sit amet consectetur adipiscing elit, nisl ridiculus in torquent massa blandit euismod inceptos, interdum rhoncus conubia mattis praesent condimentum. Mattis nisl conubia ac velit ullamcorper tempor lacinia eget senectus</p>', '2023-08-30 16:27:30', '', 450000000, '36', '', 'Tersedia', '', 80, 100, 1, 3, 2, 2, '1300', 'Sibel', 1, '', '', '', 12, 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(18, 10, 'media/produk/2023/08/62-10-1.jpeg', 1, '', 1, 1, 0),
(19, 10, 'media/produk/2023/06/62-10-2.jpeg', 2, '', 0, 1, 0),
(20, 11, 'media/produk/2023/08/62-11-2.jpeg', 2, '', 0, 1, 0),
(21, 11, 'media/produk/2023/08/62-11-1.jpeg', 1, '', 1, 1, 0),
(22, 11, 'media/produk/2023/08/62-11-3.jpeg', 3, '', 0, 1, 0),
(23, 11, 'media/produk/2023/08/62-11-4.jpeg', 4, '', 0, 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `b_produk_harga`
--

INSERT INTO `b_produk_harga` (`id`, `b_produk_id`, `spesifikasi`, `dari_qty`, `ke_qty`, `opr`, `harga`, `is_active`, `is_deleted`) VALUES
(48, 5, '[\"4:3\",\" > 0\"]', 0, 0, '>', '12000.00', 1, 0),
(49, 5, '[\"16:9\",\" > 0\"]', 0, 0, '>', '12000.00', 1, 0),
(50, 2, '[\"A4\",\" < 10\"]', 0, 10, '<', '25000.00', 1, 0),
(51, 2, '[\"A4\",\"10 - 50\"]', 10, 50, '-', '18000.00', 1, 0),
(52, 2, '[\"A4\",\" > 50\"]', 0, 50, '>', '17500.00', 1, 0),
(53, 2, '[\"A5\",\" < 10\"]', 0, 10, '<', '21000.00', 1, 0),
(54, 2, '[\"A5\",\"10 - 50\"]', 10, 50, '-', '20000.00', 1, 0),
(55, 2, '[\"A5\",\" > 50\"]', 0, 50, '>', '19000.00', 1, 0),
(56, 2, '[\"F4\",\" < 10\"]', 0, 10, '<', '22000.00', 1, 0),
(57, 2, '[\"F4\",\"10 - 50\"]', 10, 50, '-', '21000.00', 1, 0),
(58, 2, '[\"F4\",\" > 50\"]', 0, 50, '>', '20000.00', 1, 0),
(59, 6, '[\"2 x 4\",\" < 30\"]', 0, 30, '<', '5000.00', 1, 0),
(60, 6, '[\"2 x 4\",\" > 29\"]', 0, 29, '>', '7000.00', 1, 0),
(61, 6, '[\"4 x 8\",\" < 30\"]', 0, 30, '<', '5000.00', 1, 0),
(62, 6, '[\"4 x 8\",\" > 29\"]', 0, 29, '>', '7000.00', 1, 0),
(63, 6, '[\"2 x 2\",\" < 30\"]', 0, 30, '<', '5000.00', 1, 0),
(64, 6, '[\"2 x 2\",\" > 29\"]', 0, 29, '>', '7000.00', 1, 0),
(65, 7, '[\"B5\",\"Soft Cover\",\" < 50\"]', 0, 50, '<', '7000.00', 1, 0),
(66, 7, '[\"B5\",\"Soft Cover\",\" > 49\"]', 0, 49, '>', '7000.00', 1, 0),
(67, 7, '[\"B5\",\"Hard Cover\",\" < 50\"]', 0, 50, '<', '15000.00', 1, 0),
(68, 7, '[\"B5\",\"Hard Cover\",\" > 49\"]', 0, 49, '>', '15000.00', 1, 0),
(69, 7, '[\"A4\",\"Soft Cover\",\" < 50\"]', 0, 50, '<', '7000.00', 1, 0),
(70, 7, '[\"A4\",\"Soft Cover\",\" > 49\"]', 0, 49, '>', '7000.00', 1, 0),
(71, 7, '[\"A4\",\"Hard Cover\",\" < 50\"]', 0, 50, '<', '15000.00', 1, 0),
(72, 7, '[\"A4\",\"Hard Cover\",\" > 49\"]', 0, 49, '>', '15000.00', 1, 0),
(73, 8, '[\"30 x 20 x 5\",\" < 20\"]', 0, 20, '<', '20000.00', 1, 0),
(74, 8, '[\"30 x 20 x 5\",\"20 - 50\"]', 20, 50, '-', '18000.00', 1, 0),
(75, 8, '[\"30 x 20 x 5\",\" > 50\"]', 0, 50, '>', '15000.00', 1, 0),
(76, 9, '[\"Kardus\",\" < 10\"]', 0, 10, '<', '35000.00', 1, 0),
(77, 9, '[\"Kardus\",\" > 9\"]', 0, 9, '>', '32000.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `b_user`
--

CREATE TABLE `b_user` (
  `id` int(11) NOT NULL,
  `b_user_id` int(11) DEFAULT NULL COMMENT 'atasan',
  `a_unit_id` int(5) DEFAULT NULL,
  `a_jabatan_id` int(5) UNSIGNED DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabel pengguna, bisa member atau user vendor,';

--
-- Dumping data for table `b_user`
--

INSERT INTO `b_user` (`id`, `b_user_id`, `a_unit_id`, `a_jabatan_id`, `google_id`, `kode`, `kode_lama`, `email`, `username`, `foto`, `welcome_message`, `password`, `fnama`, `lnama`, `alamat`, `alamat2`, `kelurahan`, `kecamatan`, `kabkota`, `provinsi`, `negara`, `kodepos`, `nik`, `kelamin`, `tlahir`, `bdate`, `cdate`, `adate`, `edate`, `telp`, `fb`, `fb_id`, `ig`, `ig_id`, `deposit`, `reward_poin`, `image`, `reg_from`, `know_from`, `umur`, `npwp`, `penilaian`, `rating`, `api_reg_date`, `api_reg_token`, `api_web_date`, `api_web_token`, `api_mobile_date`, `api_mobile_token`, `fcm_token`, `device`, `apikey`, `is_agree`, `is_confirmed`, `is_premium`, `is_wa_verified`, `is_wa_send`, `is_active`, `is_deleted`) VALUES
(1, NULL, 0, 0, '', '', NULL, 'rezzibal@gmail.com', 'rezziqbal', '', '', 'b5dd431cc61866b146777675f00b0e10', 'Rezza', '', '', '', '', '', '', '', '', '', '3204460304980004', 0, '', '2023-09-05', '2023-09-05 12:25:25', '2023-09-05', '2023-09-05', '085789701750', '', NULL, '', NULL, 0, 0, '', 'online', NULL, 30, '', 'Mantap', 0, '2023-09-05', '', '0000-00-00', '', '0000-00-00', '', '', '', '', 0, 0, 0, 1, 1, 1, 0),
(2, NULL, 0, 0, '', '', NULL, '', '', '', '', '', 'Buldany', '', '', '', '', '', '', '', '', '', '', 0, '', '2023-06-14', '2023-06-14 13:04:20', NULL, NULL, '', '', NULL, '', NULL, 0, 0, '', 'online', NULL, 30, '', '', 0, NULL, '', '0000-00-00', '', '0000-00-00', '', '', '', '', 0, 0, 0, 1, 1, 1, 0),
(3, NULL, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, 'Buldany', ' ', '', NULL, '', '', '', '', 'Indonesia', '', '', 1, '-', '1970-01-01', '0000-00-00 00:00:00', NULL, NULL, '', '', NULL, '', NULL, 0, 0, ' ', 'online', NULL, 20, '', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, ' ', 'web', '', 0, 0, 0, 1, 1, 1, 1),
(4, NULL, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, 'Asep', ' ', '', NULL, '', '', '', '', 'Indonesia', '', '', 1, '-', '1970-01-01', '0000-00-00 00:00:00', NULL, NULL, '', '', NULL, '', NULL, 0, 0, ' ', 'online', NULL, 20, '', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, ' ', 'web', '', 0, 0, 0, 1, 1, 1, 0),
(5, NULL, NULL, NULL, '', NULL, NULL, 'farid@gmail.com', 'farid@gmail.com', '', '', '$2y$10$6fZeAZ9.1eDyuA2hloqgBepcoMr95pJ/vJ7fa7K54eaJkNeLoYzC6', 'Farid AHmad Fadhilah', ' ', '', '', '', '', '', '', 'Indonesia', '', '', 1, '-', '1970-01-01', '2023-09-06 16:13:13', NULL, NULL, '085780701750', '', NULL, '', NULL, 0, 0, ' ', 'online', NULL, 20, '', '', 5, NULL, NULL, NULL, NULL, NULL, NULL, ' ', 'web', '', 0, 0, 0, 1, 1, 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `c_order`
--

CREATE TABLE `c_order` (
  `id` int(11) NOT NULL,
  `kode` varchar(128) NOT NULL,
  `b_user_id` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `total_harga` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_order`
--

INSERT INTO `c_order` (`id`, `kode`, `b_user_id`, `cdate`, `tgl_pesan`, `tgl_selesai`, `status`, `is_active`, `is_deleted`, `total_harga`) VALUES
(1, 'ORD-PKA-20230607-0', 2, '2023-06-07 06:54:00', '2023-06-07 00:00:00', '2023-06-14 07:37:58', 'done', 1, 0, '357000.00'),
(2, 'ORD-PKA-20230707-1', 2, '2023-06-07 08:07:09', '2023-07-07 00:00:00', '2023-07-14 00:00:00', 'done', 1, 0, '531000.00'),
(3, 'ORD-PKA-20230708-2', 2, '2023-06-08 08:07:09', '2023-07-08 00:00:00', '2023-07-08 00:00:00', 'done', 1, 1, '490000.00'),
(4, 'ORD-PKA-20230708-2', 2, '2023-08-08 08:07:09', '2023-08-08 00:00:00', '2023-08-08 00:00:00', 'done', 1, 1, '490000.00'),
(5, 'ORD-PKA-20230707-1', 2, '2023-05-07 08:07:09', '2023-05-07 00:00:00', '2023-05-07 00:00:00', 'done', 1, 1, '490000.00'),
(6, 'ORD-PKA-20230708-2', 2, '2023-05-08 08:07:09', '2023-05-08 00:00:00', '2023-05-08 00:00:00', 'done', 1, 1, '490000.00'),
(7, 'ORD-PKA-20230708-2', 4, '2023-05-08 08:07:09', '2023-05-08 00:00:00', '2023-05-15 00:00:00', 'done', 1, 0, '140000.00'),
(8, 'ORD-PKA-20230613-8', 3, '2023-06-13 18:46:14', '2023-06-13 00:00:00', '2023-06-09 00:00:00', 'done', 1, 0, '60000.00'),
(9, 'ORD-PKA-20230613-9', 1, '2023-06-13 18:49:57', '2023-06-13 00:00:00', '2023-06-08 00:00:00', 'done', 1, 0, '21000.00');

-- --------------------------------------------------------

--
-- Table structure for table `c_order_produk`
--

CREATE TABLE `c_order_produk` (
  `id` int(11) NOT NULL,
  `c_order_id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_order_produk`
--

INSERT INTO `c_order_produk` (`id`, `c_order_id`, `qty`, `b_produk_id`, `b_produk_id_harga`, `cdate`, `tgl_pesan`, `tgl_selesai`, `status`, `rating`, `penilaian`, `is_active`, `is_deleted`, `sub_harga`, `ongkir`) VALUES
(13, 9, 3, 7, 65, '2023-06-13 18:49:57', '2023-06-13 00:00:00', '2023-06-08 00:00:00', 'done', 0, '', 1, 0, '21000.00', '0.00'),
(14, 8, 3, 8, 73, '2023-06-13 18:52:32', '2023-06-13 00:00:00', '2023-06-09 00:00:00', 'done', 0, '', 1, 0, '60000.00', '0.00'),
(15, 7, 4, 9, 76, '2023-06-13 18:55:44', '2023-05-08 00:00:00', '2023-05-15 00:00:00', 'done', 0, '', 1, 0, '140000.00', '0.00'),
(17, 1, 15, 2, 57, '2023-06-13 19:35:34', '2023-06-13 00:00:00', '2023-06-01 00:00:00', 'done', 0, '', 1, 0, '315000.00', '0.00'),
(18, 2, 15, 2, 54, '2023-06-14 12:46:15', '2023-07-07 00:00:00', '2023-07-14 00:00:00', 'done', 0, '', 1, 0, '300000.00', '0.00'),
(19, 2, 11, 2, 57, '2023-06-14 12:46:15', '2023-07-07 00:00:00', '2023-07-14 00:00:00', 'done', 0, '', 1, 0, '231000.00', '0.00');

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
  ADD KEY `idx_is_confirmed` (`kode_lama`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `a_partner`
--
ALTER TABLE `a_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `a_pengguna`
--
ALTER TABLE `a_pengguna`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `b_produk_gambar`
--
ALTER TABLE `b_produk_gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `b_produk_harga`
--
ALTER TABLE `b_produk_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

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
-- AUTO_INCREMENT for table `c_order`
--
ALTER TABLE `c_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `c_order_produk`
--
ALTER TABLE `c_order_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
