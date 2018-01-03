<?php
class Sitemap extends MY_Controller {
// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.


// Method start.
	public function index() {
		// Prepare Template.
		$this->extendedCss = 'frontend/sitemap/extendedCss_v';
		$this->body = 'frontend/sitemap/body_v';
		$this->renderWithTemplate();
	}
// End Method start.
}