<?php
class IccCard extends MY_Controller {
// Property.
	private $dataTypeName = "ICC Card";
	private $inputModeName = [1 => 'เพิ่มข้อมูล', 2 => 'แก้ไข'];
	private $paginationLimit = 10;
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
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName;
		
		// Prepare Template.
		$this->extendedCss = 'admin/iccCard/list/extendedCss_v';
		$this->body = 'admin/iccCard/list/body_v';
		$this->extendedJs = 'admin/iccCard/list/extendedJs_v';
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
// End Routing function.


// AJAX function.
	// ---------------------------------------------------------------------------------------- Get Data for list view.
	public function ajaxGetIccCardList() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$rDataFilter = $this->input->post('rDataFilter');
			$page = $this->input->post('page');

			$this->load->model('iccCard_m');
			$dsData = $this->iccCard_m->GetDataForComboBoxAjaxListView();

			$result = $this->setPagination($rDataFilter, $page);
			$dsData["dsIccCardList"] = $result["dsIccCardList"];
			$dsData["paginationLinks"] = $result["paginationLinks"];

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

	// ---------------------------------------------------------------------------------------- Get data to ComboBox 
	public function ajaxGetPlaceByDaterange() {
		if(!($this->is_logged())) {exit(0);}

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
			$strDateStart = $this->input->post('strDateStart');
    		$strDateEnd = $this->input->post('strDateEnd');

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetPlaceByDaterange($strDateStart, $strDateEnd);

			echo json_encode($dsData);
    	}
	}
	public function ajaxGetFullSubProvince() {
		if(!($this->is_logged())) {exit(0);}

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
			$strDateStart = $this->input->post('strDateStart');
    		$strDateEnd = $this->input->post('strDateEnd');
    		$provinceCode = $this->input->post('provinceCode');
			
			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetFullSubProvince($strDateStart, $strDateEnd, $provinceCode);

			echo json_encode($dsData);
    	}
	}
	public function ajaxGetAmphurByProvince() {
		if(!($this->is_logged())) {exit(0);}

    	if ($this->input->server('REQUEST_METHOD') === 'POST')
    	{
    		$provinceCode = $this->input->post('provinceCode');
			
			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetOnlyAmphurSubProvince($provinceCode);

			echo json_encode($dsData);
    	}
	}
// End AJAX function.



// Private function.
	// ---------------------------------------------------------------------------------------- Set pagination.
	private function setPagination($rFilter=null, $page=0) {
		$this->load->library("pagination");
		$this->load->model('iccCard_m');

		$config = array();
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
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
		$config["base_url"] = "#";
		$config["total_rows"] = $this->iccCard_m->GetIccCardRecordCount($rFilter);
		$config["per_page"] = $this->paginationLimit;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);

		$this->pagination->initialize($config);

		//$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["dsIccCardList"] = $this->iccCard_m->GetIccCardList($rFilter, $config["per_page"], $page);
		$data["paginationLinks"] = $this->pagination->create_links();

		return $data;
	}


  // ---------------------------------------------------------------------------------------- Initial view mode
	private function GetDataForViewDisplay() {
		$this->load->model("iccCard_m");
		
		$rDsData = $this->iccCard_m->GetDataForComboBoxListView();

		$result = $this->setPagination();
		$rDsData["dsView"] = $result["dsIccCardList"];
		$rDsData["paginationLinks"] = $result["paginationLinks"];

		return $rDsData;
	}

  // ---------------------------------------------------------------------------------------- Set input display mode
	private function SetInputDisplay($inputMode=1, $rowID=null) {
		// Prepare data of view.
		$this->data = $this->GetDataForInputDisplay($rowID);
		// Caption.
		$this->data['dataTypeName'] = $this->dataTypeName;
		$this->data['inputModeName'] = $this->inputModeName[$inputMode];
		// Input Mode.
		$this->data['inputMode'] = $inputMode;

		// Prepare Template.
		$this->extendedCss = 'admin/iccCard/input/extendedCss_v';
		$this->header = 'admin/iccCard/input/header_v';
		$this->body = 'admin/iccCard/input/body_v';
		$this->footer = 'admin/iccCard/input/footer_v';
		$this->extendedJs = 'admin/iccCard/input/extendedJs_v';
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