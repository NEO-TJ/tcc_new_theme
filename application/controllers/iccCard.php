<?php
class IccCard extends MY_Controller {
// Property.
	private $paginationLimit = 15;
	private $inputModeName = [ 1 => 'เพิ่มข้อมูลใหม่', 2 => 'แก้ไขข้อมูล' ];
// End Property.


// Constructor.
	public function __construct() {
		parent::__construct();

		$this->isBackend = true;
		$this->is_logged();
	}
// End Constructor.


// Method start.
	public function index() {
		if(!($this->is_logged())) {exit(0);}

		$this->view();
	}
// End Method start.


// Routing function.
	// ---------------------------------------------------------------------------------------- For display
	private function view() {
		if(!($this->is_logged())) {exit(0);}

		// Prepare data of view.
		$this->data = $this->GetDataForViewDisplay();
		
		// Prepare Template.
		$this->extendedCss = 'backend/iccCard/list/extendedCss_v';
		$this->body = 'backend/iccCard/list/body_v';
		$this->extendedJs = 'backend/iccCard/list/extendedJs_v';
		$this->renderWithTemplate();
	}
	public function addNew() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$inputMode = 1;
			$rowID = null;

			$this->SetInputDisplay($inputMode, $rowID);
		}
	}
	public function edit() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$iccCardId = $this->input->post('iccCardId');
			$inputMode = 2;

			$this->SetInputDisplay($inputMode, $iccCardId);
		}
	}

	public function log() {
		if(!($this->is_logged())) {exit(0);}

		$this->load->model('dataclass/users_d');
		if($this->session->userdata('level') == userLevel::Admin) {
			// Prepare data of view.
			$this->data = $this->GetDataForlogDisplay();
			
			// Prepare Template.
			$this->extendedCss = 'backend/iccCard/log/extendedCss_v';
			$this->body = 'backend/iccCard/log/body_v';
			$this->extendedJs = 'backend/iccCard/log/extendedJs_v';
			$this->renderWithTemplate();
		}
	}
// End Routing function.


// AJAX function.
	// ---------------------------------------------------------------------------------------- Get Data for list view.
	public function ajaxGetIccCardList() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$rDataFilter = $this->input->post('rDataFilter');
			$pageCode = $this->input->post('pageCode');

			$this->load->model('iccCard_m');
			$dataRender = $this->iccCard_m->GetDataForComboBoxAjaxListView();
			$dataPagination = $this->getIccCardWithPagination($rDataFilter, $pageCode);
			$dataRender["dsIccCardList"] = $dataPagination["dsIccCardList"];
			$dataRender["numRecordStart"] = $pageCode;

			$dsData["htmlTableBody"] = $this->load->view("backend/iccCard/list/bodyTableBody_v", $dataRender, TRUE);
			$dsData["paginationLinks"] = $dataPagination["paginationLinks"];

			echo json_encode($dsData);
		}
	}

	public function ajaxGetIccCardLogList() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$rDataFilter = $this->input->post('rDataFilter');
			$pageCode = $this->input->post('pageCode');

			$this->load->model('iccCard_m');
			$dataRender = $this->iccCard_m->GetDataForComboBoxAjaxListView();
			$dataPagination = $this->getIccCardLogWithPagination($rDataFilter, $pageCode);
			$dataRender["dsIccCardList"] = $dataPagination["dsIccCardList"];
			$dataRender["numRecordStart"] = $pageCode;

			$dsData["htmlTableBody"] = $this->load->view("backend/iccCard/log/bodyTableBody_v", $dataRender, TRUE);
			$dsData["paginationLinks"] = $dataPagination["paginationLinks"];

			echo json_encode($dsData);
		}
	}
	// ---------------------------------------------------------------------------------------- Save data to DB 
	public function ajaxSaveInputData() {
		if(!($this->is_logged())) {exit(0);}

		$result = 1;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->load->model('helper_m');
			$dsIccCardMasterSerializeArray = $this->input->post('dsIccCardMasterSerializeArray');
			$dsData['dsIccCardMaster'] = $this->helper_m->myJsonDecode($dsIccCardMasterSerializeArray);

			$dsData['dsContactInfo'] = $this->input->post('dsContactInfo');
			$dsData['dsEntangledAnimal'] = $this->input->post('dsEntangledAnimal');
			$dsData['dsGarbageTransaction'] = $this->input->post('dsGarbageTransaction');

			$result = $this->SaveDataToDB($dsData);
		}

		$result = (($result) ? 0 : 1);
		echo $result;
	}

	public function ajaxDeleteFullIccCard() {
		if(!($this->is_logged())) {exit(0);}

		$result = 1;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$iccCardId = $this->input->post('iccCardId');

			$this->load->model('iccCard_m');
			$result = $this->iccCard_m->DeleteFullIccCard($iccCardId);
		}

		$result = (($result) ? 0 : 1);
		echo $result;
	}

	public function ajaxApproveIccCardStatus() {
		if(!($this->is_logged())) {exit(0);}

		$result = 1;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$iccCardId = $this->input->post('iccCardId');

			$this->load->model('iccCard_m');
			$result = $this->iccCard_m->ApproveIccCard($iccCardId);
		}

		$result = (($result) ? 0 : 1);
		echo $result;
	}

	public function ajaxDoneIccCardStatus() {
		if(!($this->is_logged())) {exit(0);}

		$result = 1;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$iccCardId = $this->input->post('iccCardId');

			$this->load->model('iccCard_m');
			$result = $this->iccCard_m->DoneIccCard($iccCardId);
		}

		$result = (($result) ? 0 : 1);
		echo $result;
	}
// End AJAX function.



// Private function.
	// ---------------------------------------------------------------------------------------- Get dataset & Set pagination.
	private function getIccCardWithPagination($rFilter=null, $pageCode=0) {
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

	private function getIccCardLogWithPagination($rFilter=null, $pageCode=0) {
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
		$config["base_url"] = "";
		$config["first_url"] = "#/0";
		$config["total_rows"] = $this->iccCard_m->GetIccCardLogRecordCount($rFilter);
		$config["per_page"] = $this->paginationLimit;
		$config["uri_segment"] = 3;

		$config['setCurPage'] = $pageCode;									// My modify code at system library.
		$this->pagination->initialize($config);

		$startRecord = ($pageCode) ? $pageCode : 0;
		$data["dsIccCardList"] = $this->iccCard_m->GetIccCardLogList($rFilter, $config["per_page"], $startRecord);
		$data["paginationLinks"] = $this->pagination->create_links();

		return $data;
	}

  // ---------------------------------------------------------------------------------------- Initial view mode
	private function GetDataForViewDisplay() {
		$this->load->model("iccCard_m");
		
		$rDsData = $this->iccCard_m->GetDataForComboBoxListView();

		$result = $this->getIccCardWithPagination();
		$rDsData["dsIccCardList"] = $result["dsIccCardList"];
		$rDsData["paginationLinks"] = $result["paginationLinks"];
		$dataRender["numRecordStart"] = 0;

		return $rDsData;
	}

  // ---------------------------------------------------------------------------------------- Initial log view mode
	private function GetDataForlogDisplay() {
		$this->load->model("iccCard_m");
		
		$rDsData = $this->iccCard_m->GetDataForComboBoxListView();

		$result = $this->getIccCardLogWithPagination();
		$rDsData["dsIccCardList"] = $result["dsIccCardList"];
		$rDsData["paginationLinks"] = $result["paginationLinks"];
		$dataRender["numRecordStart"] = 0;

		return $rDsData;
	}

  // ---------------------------------------------------------------------------------------- Set input display mode
	private function SetInputDisplay($inputMode=1, $rowID=null) {
		// Prepare data of view.
		$this->data = $this->GetDataForInputDisplay($rowID);

		// Caption.
		$this->data['inputModeName'] = $this->inputModeName[$inputMode];

		// Prepare Template.
		$this->extendedCss = 'backend/iccCard/input/extendedCss_v';
		$this->body = 'backend/iccCard/input/body_v';
		$this->extendedJs = 'backend/iccCard/input/extendedJs_v';
		$this->renderWithTemplate();
	}
  // ---------------------------------------------------------------------------------------- Initial input mode
	private function GetDataForInputDisplay($rowID=null) {
		$this->load->model('iccCard_m');

		// Set array data for View part.
		if(($rowID == null) || ($rowID == 0)) {
			$result['dsInput'] = $this->iccCard_m->GetTemplateForInputDisplay();
		} else {
			$dataSet = $this->iccCard_m->GetDataForInputDisplay($rowID);
			$result['dsInput'] = ((count($dataSet) > 0) ? $dataSet 
								: $this->iccCard_m->GetTemplateForInputDisplay());
		}

		// Get DataSet to combobox.
		$this->load->model('dataclass/iccCard_d');
		$dsComboBox = $this->iccCard_m->GetDataForComboBox(
					$result['dsInput']['dsIccCardMaster'][0][$this->iccCard_d->colFkProvinceCode]);
		if($dsComboBox != null) {
			foreach($dsComboBox as $key => $value) {
				$result[$key] = $value;
			}
		}

    	return $result;
	}

  // -------------------------------------------------- Save input mode ------------------------------
	private function SaveDataToDB($dsData) {
    	$result = false;

    	$masterId = $dsData['dsIccCardMaster']['masterId'];
    	unset($dsData['dsIccCardMaster']['masterId']);

		// Selection for masterdata object.
		$this->load->model('iccCard_m');

		// Save data to DB.
		$result = $this->iccCard_m->Save($masterId, $dsData);
    	
    	return $result;
	}
// End Private function.
}