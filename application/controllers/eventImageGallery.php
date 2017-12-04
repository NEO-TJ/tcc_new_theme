<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventImageGallery extends MY_Controller {
// Property.
	private $paginationLimit = 15;
	private $eventImage;
// End Property.

// Constructor.
function __construct() {
	parent::__construct();
}
// End Constructor.



// Method start.
	public function index() {
		$this->listView();
	}
// End Method start.


// Routing function.
	private function listView() {
		// Prepare data of view.
		$this->data = $this->GetDataForListView();

		// Prepare Template.
		$this->extendedCss = 'frontend/eventImageGallery/list/extendedCss_v';
		$this->body = 'frontend/eventImageGallery/list/body_v';
		$this->extendedJs = 'frontend/eventImageGallery/list/extendedJs_v';
		$this->renderWithTemplate();
	}
	public function gallery() {
		// Get iccCardId.
		$iccCardId = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		// Prepare data of view.
		$this->data = $this->GetDataForGalleryView($iccCardId);

		// Prepare Template.
		$this->extendedCss = 'frontend/eventImageGallery/gallery/extendedCss_v';
		$this->body = 'frontend/eventImageGallery/gallery/body_v';
		$this->extendedJs = 'frontend/eventImageGallery/gallery/extendedJs_v';
		$this->renderWithTemplate();
	}
// End Routing function.


// AJAX function.
	// ---------------------------------------------------------------------------------------- Get Data for list view and pagination.
	public function ajaxGetIccCardList() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$rDataFilter = $this->input->post('rDataFilter');
			$pageCode = $this->input->post('pageCode');

			$this->load->model('iccCard_m');
			$dataRender = $this->iccCard_m->GetDataForComboBoxAjaxListView();
			$dataPagination = $this->setPagination($rDataFilter, $pageCode);
			$dataRender["dsIccCardList"] = $dataPagination["dsIccCardList"];
			$dataRender["numRecordStart"] = $pageCode;

			$dsData["htmlTableBody"] = $this->load->view("frontend/eventImageGallery/list/bodyTableBody_v", $dataRender, TRUE);
			$dsData["paginationLinks"] = $dataPagination["paginationLinks"];

			echo json_encode($dsData);
		}
	}
// End AJAX function.



// Private function.
	// ---------------------------------------------------------------------------------------- Set pagination.
	private function setPagination($rFilter=null, $pageCode=0) {
		$this->load->library("pagination");
		$this->load->model('iccCard_m');

		$config = array();
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = "<li>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		//$config['use_page_numbers'] = TRUE;
		$config["base_url"] = "";
		$config["first_url"] = "#/0";
		$config["total_rows"] = $this->iccCard_m->GetIccCardRecordCount($rFilter);
		$config["per_page"] = $this->paginationLimit;
		$config["uri_segment"] = 3;
		//$choice = $config["total_rows"] / $config["per_page"];
		//$config["num_links"] = round($choice);

		$config['setCurPage'] = $pageCode;									// My modify code at system library.
		$this->pagination->initialize($config);

		$startRecord = ($pageCode) ? $pageCode : 0;
		$data["dsIccCardList"] = $this->iccCard_m->GetIccCardList($rFilter, $config["per_page"], $startRecord);
		$data["paginationLinks"] = $this->pagination->create_links();

		return $data;
	}


  // ---------------------------------------------------------------------------------------- Initial view mode
	private function GetDataForListView() {
		$this->load->model("iccCard_m");
		
		$rDsData = $this->iccCard_m->GetDataForComboBoxListView();

		$result = $this->setPagination();
		$rDsData["dsIccCardList"] = $result["dsIccCardList"];
		$rDsData["paginationLinks"] = $result["paginationLinks"];
		$dataRender["numRecordStart"] = 0;

		return $rDsData;
	}

	private function GetDataForGalleryView($iccCardId=null) {
		$this->load->model("eventImage_m");
		$data['dsImage'] = $this->eventImage_m->GetDsEventImage($iccCardId);

		$dsIccCard = $this->eventImage_m->GetDsIccCard($iccCardId);
		$data['dsIccCard'] = $dsIccCard;

		return $data;
	}
// End Private function.
}