<?php

namespace Controller\Pengaturan;

register_namespace(__NAMESPACE__);

/**
 * Main Controller Class for User Modul
 *
 * Mostly for this controller will resulting HTTP Body Content in HTML format
 *
 * @version 1.0.0
 *
 * @package Partner\User
 * @since 1.0.0
 */
class Kategori extends \JI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->lib("seme_purifier");
		$this->load("a_kategori_concern");
		$this->load("b_produk_concern");
		$this->load("b_produk_item_concern");
		$this->load("c_order_concern");
		$this->load("admin/a_kategori_model", "akm");
		$this->load("admin/b_produk_model", "bpm");
		$this->load("admin/b_produk_item_model", "bpim");
		$this->load("admin/c_order_model", "com");
		$this->current_parent = 'pengaturan';
		$this->current_page = 'kategori';
	}
	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}


		$this->setTitle('Kawasan ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/kategori/home_modal", $data);
		$this->putThemeContent("pengaturan/kategori/home", $data);
		$this->putJsContent("pengaturan/kategori/home_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
	public function siteplan($id)
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}
		$id = (int) $id;
		if ($id <= 0) {
			redir(base_url_admin('pengaturan/kategori'));
			die();
		}
		$akm = $this->akm->id($id);
		// dd($akm);
		$data['akm'] = $akm;
		$pengguna = $data['sess']->admin;

		$bpim = $this->bpim->getByKawasan($akm->id);
		if (isset($bpim[0])) $data['bpim'] = $bpim;
		unset($bpim);
		if (isset($akm->data_siteplan) && strlen($akm->data_siteplan) > 5) {
			$data_siteplan = json_decode($akm->data_siteplan);
			$orders = $this->com->getAllOrders();
			foreach ($data_siteplan as $ds) {
				if (!isset($ds->data)) continue;
				foreach ($orders as $o) {
					if (stripos($ds->data, "ID-" . $o->b_produk_id) !== false) {
						$o->status = $o->status == 'pembayaran' ? 'terjual' : $o->status;
						$ds->status = $o->status;
						$ds->b_user_id = $o->b_user_id;
						$ds->posisi = $o->posisi;
					}
				}
			}
			$akm->data_siteplan = json_encode($data_siteplan);
		}
		$this->setTitle('Kawasan - Siteplan ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/siteplan/baru_modal", $data);
		$this->putThemeContent("pengaturan/siteplan/baru", $data);

		$this->putJsContent("pengaturan/siteplan/baru_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
