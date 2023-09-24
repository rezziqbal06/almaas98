<?php
class Forgot_Password extends JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('front');
    }
    public function index()
    {
        $data = $this->__init();
        $this->setTitle('Lupa password ' . $this->config->semevar->site_name);
        $this->setDescription('Silakan reset password akun melalui halaman ini');

        $this->putThemeContent("forgot_password/home", $data);
        $this->putThemeContent("forgot_password/home_modal", $data);
        $this->putJsContent("forgot_password/home_bottom", $data);
        $this->loadLayout('login', $data);
        $this->render();
    }
}
