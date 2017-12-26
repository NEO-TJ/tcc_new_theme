<?php
class AjaxService extends MY_Controller {
// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.


// Method start.
	public function index() {
	}
// End Method start.

// AJAX function.
	// ---------------------------------------------------------------------------------------- Get data to ComboBox 
	public function ajaxGetPlaceByDaterange() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$strDateStart = $this->input->post('strDateStart');
			$strDateEnd = $this->input->post('strDateEnd');

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetPlaceByDaterange($strDateStart, $strDateEnd);

			echo json_encode($dsData);
		}
	}
	public function ajaxGetFullSubProvince() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$strDateStart = $this->input->post('strDateStart');
			$strDateEnd = $this->input->post('strDateEnd');
			$provinceCode = $this->input->post('provinceCode');

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetFullSubProvince($strDateStart, $strDateEnd, $provinceCode);

			echo json_encode($dsData);
		}
	}
	public function ajaxGetAmphurByProvince() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$provinceCode = $this->input->post('provinceCode');

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetOnlyAmphurSubProvince($provinceCode);

			echo json_encode($dsData);
		}
	}
// End AJAX function.
}