<?php

class dashboard extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->isBackend = true;
	}

	public function index() {
		$this->body = 'admin/dashboard/index';
		$this->renderWithTemplate();	
	}
}
