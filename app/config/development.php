<?php

/**
 * # Development.php
 * Configuration file for **development** environment.
 *
 * Seme Framework support for another environment, such as:
 *   - `development.php`
 *   - `staging.php`
 *   - `production.php`
 *
 * ## `$site`
 * Site Base URL with http:// or https:// prefix and trailing slash
 *
 * ## `$method`
 * URL parse method
 *   - REQUEST_URI, suitable for Nginx
 *   - PATH_INFO, suitable for XAMPP
 *   - ORIG_PATH_INFO
 *
 * ## `$admin_secret_url`
 * Admin Secret url for re-routing `admin` directory on controller into `$admin_secret_url` on request path
 *
 * ## `$cdn_url`
 * Base CDN URL with http:// or https:// prefix and trailing slash, optional
 *
 * ## $db
 * Database array configuration
 * - host
 * - user
 * - pass, password
 * - engine
 * - charset
 * - port
 *
 * ## `$saltkey`
 * Salt key for session secret
 *
 * ## `$timezone`
 * Default time zone
 *
 * ## `$core_prefix`
 * Core class prefix, please fill this before load php class on `app/core/`
 *
 * ## `$core_controller`
 * Core class name for controller (without prefix)
 *
 * ## `$core_model`
 * Core class name for mode (without prefix)
 *
 * ## `$controller_main`
 * Default Main Controller for application onboarding
 *
 * ## `$controller_404`
 * Default Main Controller for handling error 404 not found
 *   Not found on Seme Framework caused by Undefined method or class controller
 *
 * ## `$semevar`
 * Custom configuration value(s) that can be put on `$semevar['keyname'] = {value}`, example:
 *
 * ```php
 * $semevar['site_name'] = 'Seme Framework';
 * ```
 *
 * on controller, you can load the value by implementing code like this
 * ```php
 * $this->config->semevar->site_name; //will contain "Seme Framework"
 * ```
 *
 * @package Application\Configuration
 * @version 4.0.3
 *
 * @since 4.0.0
 */

/**
 * Site Base URL with http:// or https:// prefix and trailing slash
 * @var string
 */
$site = "http://" . $_SERVER['HTTP_HOST'] . "/almaas98/";

/**
 * URL parse method
 *   - REQUEST_URI, suitable for Nginx
 *   - PATH_INFO, suitable for XAMPP
 *   - ORIG_PATH_INFO
 * @var string
 */
$method = "PATH_INFO"; //REQUEST_URI,PATH_INFO,ORIG_PATH_INFO,

/**
 * Admin Secret re-routing
 * this is alias for app/controller/admin/*
 * @var string
 */
$admin_secret_url = 'admin';

/**
 * Set sales scoped base url
 *
 * @var string
 */
$sales_url = 'sales';

/**
 * Set reseller scoped base url
 *
 * @var string
 */
$reseller_url = 'reseller';

/**
 * Set front scoped base url
 *
 * @var string
 */
$front_url = '';

/**
 * Base URL with http:// or https:// prefix and trailing slash
 * @var string
 */
$cdn_url = '';

/********************************/
/* == Database Configuration == */
/* Database connection information */
/* @var array of string */
/********************************/
$db['host']  = 'localhost';
$db['user']  = 'root';
$db['pass']  = '';
$db['name']  = 'almaas98_db';
$db['port'] = '3306';
$db['charset'] = 'utf8mb4';
$db['engine'] = 'mysqli';

/****************************/
/* == Session Configuration == */
/* @var string */
/****************************/
$saltkey = 'asrs44';

/********************************/
/* == Timezone Configuration == */
/* @var string */
/****************************/
$timezone = 'Asia/Jakarta';

/********************************/
/* == Core Configuration == */
/* register your core class, and put it on: */
/*   - app/core/ */
/* all var $core_* value in lower case string*/
/* @var string */
/****************************/
$core_prefix = 'ji_';
$core_controller = 'controller';
$core_model = 'model';

/********************************/
/* == Controller Configuration == */
/* register your onboarding (main) controller */
/*   - make sure dont add any traing slash in array key of routes */
/*   - all var $controller_* value in lower case string */
/*   - example $routes['produk/(:any)'] = 'produk/detail/index/$1' */
/*   - example example $routes['blog/id/(:num)/(:any)'] = 'blog/detail/index/$1/$2'' */
/* @var string */
/****************************/
$controller_main = 'home';
$controller_404 = 'notfound';

/********************************/
/* == Controller Re-Routing Configuration == */
/* make sure dont add any traing slash in array key of routes */
/* @var array of string */
/****************************/
// $routes['produk/(:any)'] = 'produk/detail/index/$1';
$routes['admin/edit'] = 'admin/home/edit';
$routes['explore/'] = 'produk/';
$routes['produk/(:any)'] = 'produk/detail/$1';
$routes['booking/(:any)'] = 'booking/book/$1';
$routes['banner/(:any)'] = 'banner/detail/$1';
$routes['siteplan/(:num)'] = 'siteplan/detail/$1';
$routes['blog/(:any)'] = 'blog/detail/$1';
$routes['asesmen/(:any)/(:num)'] = 'asesmen/edit/$1/$2';
$routes['admin/pengaturan/kawasan'] = 'admin/pengaturan/kategori';
$routes['checkout/(:any)'] = 'checkout/detail/$1';
$routes['checkout/berhasil'] = 'checkout/berhasil';


/********************************/
/* == Another Configuration == */
/* configuration are in array of string format */
/*  - as name value pair */
/*  - accessing value by $this->semevar->key in controller extended class */
/*  - accessing value by $this->semevar->key in model extended class */
/****************************/

//email configuration
$semevar['send_email'] = true;

//firebase messaging
$semevar['fcm'] = new stdClass();
$semevar['fcm']->version = '';
$semevar['fcm']->apiKey = 'AIzaSyBeGZnEqypNa88Haer2ZUM3L7iSi7RQvZo';
$semevar['fcm']->authDomain = 'almaas-198bc.firebaseapp.com';
$semevar['fcm']->databaseURL = '';
$semevar['fcm']->projectId = 'almaas-198bc';
$semevar['fcm']->storageBucket = 'almaas-198bc.appspot.com';
$semevar['fcm']->messagingSenderId = '1014167839012';
$semevar['fcm']->appId = '1:1014167839012:web:6d9906dadd7635674453b1';
$semevar['fcm']->measurementId = 'G-N3QRP1TY30';


$semevar['site_title'] = 'Almaas 98';
$semevar['site_author'] = $semevar['site_title'];
$semevar['site_keyword'] = $semevar['site_title'];
$semevar['site_version'] = '1.0.0-dev';
$semevar['site_name'] = 'Almaas 98 Residence';
$semevar['admin_site_suffix'] = ' - Almaas 98';
$semevar['site_suffix'] = ' - Almaas 98';
$semevar['site_motto'] = 'Almaas 98 Residence: Hunian Terjangkau, Hidup Nyaman';
$semevar['site_description'] = 'Sebuah hunian yang menghadirkan perpaduan sempurna antara harga terjangkau dan nilai-nilai syar\'i. Terletak strategis di daerah yang ramai dan aksesible, kompleks perumahan ini menawarkan berbagai pilihan unit perumahan yang terjangkau bagi para calon pemilik rumah. Dengan komitmen untuk mematuhi prinsip-prinsip syariah dalam perencanaan dan pengembangan proyek ini.';
$semevar['site_map'] = 'https://goo.gl/maps/4xDEwPDd2ML3txc59';
$semevar['site_fb'] = 'https://www.facebook.com/profile.php?id=100054244250465';
$semevar['site_ig'] = 'https://www.instagram.com/almaas_developer.official/';
$semevar['site_yt'] = 'https://www.youtube.com/@ptalmaas98/';
$semevar['site_tokopedia'] = 'https://www.tokopedia.com/archive-percetakancimahi?source=universe&st=product';
$semevar['site_shopee'] = '';
$semevar['site_wa'] = '6282219651887';
$semevar['site_number'] = '0822-1965-1887';
$semevar['site_logo'] = new stdClass();
$semevar['site_logo']->path = 'media/logo.png';
$semevar['site_logo']->width = '117';
$semevar['site_logo']->height = '50';
$semevar['site_email'] = 'hallo@rumahalmaas4.com';
$semevar['site_replyto'] = 'hallo@rumahalmaas4.com';
$semevar['email_from'] = $semevar['site_email'];
$semevar['email_reply'] = $semevar['site_replyto'];
$semevar['app_name'] = 'CODAPP';
$semevar['app_logo'] = 'skin/front/icon/android-chrome-192x192.png';
$semevar['app_version'] = $semevar['site_version'];
$semevar['sales_site_suffix'] = ' - Sales Portal ' . $semevar['site_name'];
$semevar['sales_site_description'] = 'Sales portal untuk ' . $semevar['site_name'];
$semevar['sales_logo'] = 'media/sales-logo.png';
$semevar['admin_logo'] = 'media/admin-logo.png';
$semevar['domain_strict'] = false;
$semevar['site_address'] = 'Perumahan Almaas 3 Jln. Andir Katapang, Desa Sukamukti Kec. Katapang, Kabupaten Bandung';

//alamat api
$semevar['api_address'] = 'https://alamat.thecloudalert.com/api/';
