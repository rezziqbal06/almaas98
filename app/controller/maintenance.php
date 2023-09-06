<?php
class Maintenance extends JI_Controller
{
	public function __constructx()
	{
		parent::__construct();
		$this->setTheme('front');
	}
	public function index()
	{
		$data = $this->__init();
		$this->setTheme('front');

		$this->setTitle("Maintenance" . $this->config->semevar->site_suffix);
		//$this->putThemeContent("notfound",$data);
		$this->loadLayout('401', $data);
		$this->render();
	}
}
