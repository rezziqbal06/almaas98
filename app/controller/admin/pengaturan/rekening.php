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
class Rekening extends \JI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->lib("seme_purifier");
		$this->load("a_rekening_concern");
		$this->load("b_produk_concern");
		$this->load("admin/a_rekening_model", "arm");
		$this->load("admin/b_produk_model", "bpm");
		$this->current_parent = 'pengaturan';
		$this->current_page = 'rekening';
	}
	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}


		$this->setTitle('Rekening ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/rekening/home_modal", $data);
		$this->putThemeContent("pengaturan/rekening/home", $data);
		$this->putJsContent("pengaturan/rekening/home_bottom", $data);
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
			redir(base_url_admin('pengaturan/rekening'));
			die();
		}
		$arm = $this->arm->id($id);
		// dd($arm);
		$data['arm'] = $arm;
		$pengguna = $data['sess']->admin;

		$bpm = $this->bpm->getAll();
		if (isset($bpm[0])) $data['bpm'] = $bpm;
		unset($bpm);


		$this->setTitle('Rekening - Siteplan ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/siteplan/baru_modal", $data);
		$this->putThemeContent("pengaturan/siteplan/baru", $data);

		$this->putJsContent("pengaturan/siteplan/baru_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
