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
class Produk_Item extends \JI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->lib("seme_purifier");
		$this->load("b_produk_concern");
		$this->load("b_produk_item_concern");
		$this->load("b_produk_harga_concern");
		$this->load("b_produk_gambar_concern");
		$this->load("a_three_d_concern");
		$this->load("a_kategori_concern");
		$this->load("admin/a_three_d_model", "atdm");
		$this->load("admin/a_kategori_model", "akm");
		$this->load("admin/b_produk_model", "bpm");
		$this->load("admin/b_produk_item_model", "bpim");
		$this->load("admin/b_produk_harga_model", "bphm");
		$this->load("admin/b_produk_gambar_model", "bpgm");
		$this->current_parent = 'pengaturan';
		$this->current_page = 'produk';
	}
	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}

		$data['bpm'] = $this->bpm->getAll();

		$this->setTitle('Rumah/Kavling ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/produk_item/home_modal", $data);
		$this->putThemeContent("pengaturan/produk_item/home", $data);
		$this->putJsContent("pengaturan/produk_item/home_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
	public function baru()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}
		$pengguna = $data['sess']->admin;
		$data['akm'] = $this->akm->getAll();
		$data['atdm'] = $this->atdm->getAll();


		$this->setTitle('Rumah/Kavling Baru ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/produk_item/baru_modal", $data);
		$this->putThemeContent("pengaturan/produk_item/baru", $data);

		$this->putJsContent("pengaturan/produk_item/baru_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
	public function edit($id)
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}
		$id = (int) $id;
		if ($id <= 0) {
			redir(base_url_admin('pengaturan/produk_item/'));
			die();
		}
		$bpm = $this->bpm->id($id);
		if (!isset($bpm->id)) {
			redir(base_url_admin('pengaturan/produk_item/'));
			die();
		}

		$data['bpm'] = $bpm;
		$data['akm'] = $this->akm->getAll();
		$data['bpgm'] = $this->bpgm->getByProduk($bpm->id);
		$data['bphm'] = $this->bphm->getByProduk($bpm->id);
		$data['atdm'] = $this->atdm->getAll();
		if (isset($data['bpm']->spesifikasi)) {
			$qty = [];
			$spesifikasi = [];
			$data['bpm']->spesifikasi = json_decode($data['bpm']->spesifikasi);
			if (isset($data['bpm']->spesifikasi)) {
				foreach ($data['bpm']->spesifikasi as $k => $v) {
					if ($k == 'QTY') {
						foreach ($v as $ks => $vs) {
							$arr_qty = explode(' ', $vs);
							if (count($arr_qty) == 3) {
								$qty[$ks]['dari_qty'] = $arr_qty[0];
								$qty[$ks]['opr'] = $arr_qty[1];
								$qty[$ks]['ke_qty'] = $arr_qty[2];
							} else {
								$qty[$ks]['opr'] = $arr_qty[0];
								$qty[$ks]['ke_qty'] = $arr_qty[1];
							}
						}
					} else {
						$spesifikasi[$k] = $v;
					}
				}
			}

			$data['bpm']->spesifikasi = $spesifikasi;
			$data['bpm']->qty = $qty;
		}

		// dd($data['bphm']);
		$this->setTitle('Rumah/Kavling Edit #' . $bpm->id . ' ' . $this->config_semevar('admin_site_suffix', ''));
		$this->putThemeContent("pengaturan/produk_item/edit_modal", $data);
		$this->putThemeContent("pengaturan/produk_item/edit", $data);
		$this->putJsContent("pengaturan/produk_item/edit_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
