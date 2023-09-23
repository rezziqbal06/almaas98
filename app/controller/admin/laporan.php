<?php
date_default_timezone_set('Asia/Jakarta');

class Laporan extends JI_Controller
{
	var $diskon_by_posisi = [
		'cash keras' => ['sayap' => 15, 'utama' => 10, 'hook' => 7],
		'cash bertahap' => ['sayap' => 10, 'utama' => 5, 'hook' => 2]
	];
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';

		$this->load('a_kategori_concern');
		$this->load('a_banner_concern');
		$this->load('a_partner_concern');
		$this->load('b_produk_concern');
		$this->load('b_user_concern');
		$this->load('c_order_concern');
		$this->load('c_order_produk_concern');
		$this->load('c_jadwal_concern');

		$this->load('admin/a_kategori_model', 'akm');
		$this->load('admin/a_banner_model', 'abm');
		$this->load('admin/a_partner_model', 'apm');
		$this->load('admin/b_produk_model', 'bpm');
		$this->load('admin/b_user_model', 'bum');
		$this->load('admin/c_order_model', 'com');
		$this->load('admin/c_order_produk_model', 'copm');
		$this->load('admin/c_jadwal_model', 'cjm');
	}

	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'), 0);
			die();
		}


		$data['akm'] = $this->akm->getAll();

		$this->setTitle('Laporan ' . $this->config->semevar->site_suffix);

		$this->putJsFooter($this->cdn_url('skin/admin/') . 'js/pages/index');

		$this->putThemeContent("laporan/home", $data);
		$this->putJsContent("laporan/home_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
