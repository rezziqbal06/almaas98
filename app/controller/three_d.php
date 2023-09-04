<?php
class Three_D extends JI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->setTheme('front');
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';

		$this->load('a_three_d_concern');


		$this->load('front/a_three_d_model', 'atdm');
	}

	public function index()
	{
		$data = $this->__init();
		// if (!$this->user_login) {
		// 	redir(base_url('login'), 0);
		// 	die();
		// }
		$this->setTitle("3D Model" . $this->config->semevar->site_suffix);


		$atdm = $this->atdm->getAll();

		$data['atdm'] = $atdm;
		unset($atdm);


		$this->putThemeContent("three_d/home", $data);
		$this->putThemeContent("three_d/home_modal", $data);
		$this->putJsContent("three_d/home_bottom", $data);
		$this->loadLayout('col-1-bar', $data);
		$this->render();
	}
}
