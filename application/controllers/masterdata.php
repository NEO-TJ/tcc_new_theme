<?php
class Masterdata extends MY_Controller {
// Property.
	private $commonName = false;			// For select view file.
	private $commonQtyUnit = false;			// For select view file.
	private $dataTypeCaption = ['0' 	=> 'ทะเบียนผู้ใช้งาน',
		'1' 	=> 'บริเวณที่เก็บขยะ',

		'2' 	=> 'หน่วยของระยะทาง',
		
		'3' 	=> 'หน่วยของน้ำหนัก', 
		
		'4' 	=> 'สถานะภาพสัตว์ที่พบ',
		
		'5' 	=> 'ขยะทะเล',								
		'6' 	=> 'ประเภทขยะทะเล',
		
		'7' 	=> 'หน่วยงาน',

		'8' 	=> 'Media Type',
	];
	private $dataTypeLink = ['0' 	=> 'User',
		'1' 	=> 'CleanupType',

		'2' 	=> 'DistanceUnit',
		
		'3' 	=> 'WeightUnit', 
		
		'4' 	=> 'AnimalStatus',
		
		'5' 	=> 'Garbage',								
		'6' 	=> 'GarbageType',
		
		'7' 	=> 'Organize',

		'8' 	=> 'Media Type',
	];
	private $inputModeName = [ 1 => 'เพิ่มข้อมูลใหม่', 2 => 'แก้ไขข้อมูล' ];
// End Property.




// Constructor.
	public function __construct() {
		parent::__construct();

		$this->isBackend = true;
		$this->is_logged();
	}
// End  Constructor.



// Method start.
	public function index() {
		if(!($this->is_logged())) {exit(0);}

		$this->view(0);
	}
// End Method start.
    
    
    
// Routing function.
	// ------------------------------------------------- For display -----------------------------------
	public function view($dataType=1) {
		if(!($this->is_logged())) {exit(0);}

		// Prepare data of view.
		$this->data = $this->GetDataForViewDisplay($dataType);

		// Prepare Template.
		$this->extendedCss = 'backend/masterdata/list/extendedCss_v';
		$this->body = 'backend/masterdata/list/body_v';
		$this->extendedJs = 'backend/masterdata/list/extendedJs_v';
		$this->renderWithTemplate();
	}

	public function addNew() {
		if(!($this->is_logged())) {exit(0);}
    	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$dataType = $this->input->post('dataType');
			$inputMode = 1;
			$rowId = null;

			$this->SetInputDisplay($dataType, $inputMode, $rowId);
		}
	}

	public function edit() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$dataType = $this->input->post('dataType');
			$inputMode = 2;
			$rowId = $this->input->post('rowId');

			$this->SetInputDisplay($dataType, $inputMode, $rowId);
		}
	}
// End Routing function.


// AJAX function.
	// ---------------------------------------------- Save data to DB ----------------------------------
	public function ajaxSaveInputData() {
		if(!($this->is_logged())) {exit(0);}

		$result = 1;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$allDataPost = $this->input->post(NULL, TRUE);

			$result = $this->SaveDataToDB($allDataPost);
		}

		$result = (($result) ? 0 : 1);
		echo $result;
	}

	// ---------------------------------------------- Save data to DB ----------------------------------
	public function ajaxDeleteMasterdata() {
		if(!($this->is_logged())) {exit(0);}

		$result = 1;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$rowId = $this->input->post("rowId");
			$dataType = $this->input->post("dataType");

			// Selection for masterdata object.
			$this->SelectMasterdataObject($dataType);
			$result = $this->oMasterdata_m->Delete($rowId);
		}

		$result = (($result) ? 0 : 1);
		echo $result;
	}
// End AJAX function.



// Private function.
	// ------------------------------------------- Select masterdata object ----------------------------
	private function SelectMasterdataObject($dataType=1) {
		$this->commonName = false;
		$this->commonQtyUnit = false;

		// User.
		if($dataType == '0') {
			$this->load->model('masterdata/masterdataUser_m', 'oMasterdata_m');		
		}

		// Cleanup Type.
		else if($dataType == '1') {		// ID & Name #.
			$this->load->model('masterdata/masterdataCommonName_m', 'oMasterdata_m');
			$this->load->model('dataclass/cleanupType_d');
			$this->oMasterdata_m->tableName = $this->cleanupType_d->tableName;
			$this->commonName = true;
		}

		// Distance Unit.
		else if($dataType == '2') {		// ID & Name #.
			$this->load->model('masterdata/masterdataCommonName_m', 'oMasterdata_m');
			$this->load->model('dataclass/distanceUnit_d');
			$this->oMasterdata_m->tableName = $this->distanceUnit_d->tableName;
			$this->commonName = true;
		}

		// Weight Unit.
		else if($dataType == '3') {		// ID & Name #.
			$this->load->model('masterdata/masterdataCommonName_m', 'oMasterdata_m');
			$this->load->model('dataclass/weightUnit_d');
			$this->oMasterdata_m->tableName = $this->weightUnit_d->tableName;
			$this->commonName = true;
		}

		// Animal Status.
		else if($dataType == '4') {		// ID & Name #.
			$this->load->model('masterdata/masterdataCommonName_m', 'oMasterdata_m');
			$this->load->model('dataclass/animalStatus_d');
			$this->oMasterdata_m->tableName = $this->animalStatus_d->tableName;
			$this->commonName = true;
		}

		// Garbage Detail.
		else if($dataType == '5') {
			$this->load->model('masterdata/masterdataGarbage_m', 'oMasterdata_m');
		}
		// Garbage Type.
		else if($dataType == '6') {
			$this->load->model('masterdata/masterdataGarbageType_m', 'oMasterdata_m');
		}

		// Organize.
		else if($dataType == '7') {
			$this->load->model('masterdata/masterdataOrganize_m', 'oMasterdata_m');
		}

		// Ecology.
		else if($dataType == '8') {		// ID & Name #.
			$this->load->model('masterdata/masterdataCommonName_m', 'oMasterdata_m');
			$this->load->model('dataclass/ecology_d');
			$this->oMasterdata_m->tableName = $this->ecology_d->tableName;
			$this->commonName = true;
		}

		// Media Type.
		else if($dataType == '9') {		// ID & Name #.
			$this->load->model('masterdata/masterdataCommonName_m', 'oMasterdata_m');
			$this->load->model('dataclass/mediaType_d');
			$this->oMasterdata_m->tableName = $this->mediaType_d->tableName;
			$this->commonName = true;
		}

		// Not match.
		else{
			exit(0);
		}

		return $this->oMasterdata_m;
	}


	// ---------------------------------------------- Initial view mode --------------------------------
	private function GetDataForViewDisplay($dataType=1) {
		// Selection for masterdata object.
		$this->SelectMasterdataObject($dataType);

		// Set array data for View part.
		$data['dataType'] = $dataType;
		$data['dataTypeCaption'] = $this->dataTypeCaption[$dataType];
		$data['dsView'] = $this->oMasterdata_m->GetDataForViewDisplay();

		return $data;
	}


	// -------------------------------------------- Set input display mode -----------------------------
	protected function SetInputDisplay($dataType=1, $inputMode=1, $rowId=null) {
		$this->data = $this->GetDataForInputDisplay($dataType, $rowId);
		// Caption.
		$this->data['dataType'] = $dataType;
		$this->data['dataTypeCaption'] = $this->dataTypeCaption[$dataType];
		$this->data['inputModeName'] = $this->inputModeName[$inputMode];
		// Set body section file view.
		$bodyView = ( ($this->commonName) ? 'CommonName' 
							: ( ($this->commonQtyUnit) ? 'CommonQtyUnit' 
								: $this->dataTypeLink[$dataType] ) );

		// Prepare Template.
		$this->extendedCss = 'backend/masterdata/input/extendedCss_v';
		$this->body = 'backend/masterdata/input/body' . $bodyView . '_v';
		$this->extendedJs = 'backend/masterdata/input/extendedJs_v';
		$this->renderWithTemplate();
	}

	// ---------------------------------------------- Initial input mode -------------------------------
	private function GetDataForInputDisplay($dataType=1, $rowId=null) {
		// Selection for masterdata object.
		$this->SelectMasterdataObject($dataType);

		// Set array data for View part.
		if(($rowId == null) || ($rowId == 0)) {
			$result['dsInput'] = $this->oMasterdata_m->GetTemplateForInputDisplay();
		} else {
			$dataSet = $this->oMasterdata_m->GetDataForInputDisplay($rowId);
			$result['dsInput'] = ((count($dataSet) > 0) ? $dataSet[0] 
								: $this->oMasterdata_m->GetTemplateForInputDisplay());
		}

		// Get DataSet to combobox.
		$dsComboBox = $this->oMasterdata_m->GetDataForComboBox();
		if($dsComboBox != null) {
			foreach($dsComboBox as $key => $value) {
				$result[$key] = $value;
			}
		}

		return $result;
	}


	// -------------------------------------------------- Save input mode ------------------------------
	private function SaveDataToDB($dsSave) {
		$result = false;

		$dataType = $dsSave['dataType'];
		unset($dsSave['dataType']);

		$rowId = $dsSave['rowId'];
		unset($dsSave['rowId']);

		// Selection for masterdata object.
		$this->SelectMasterdataObject($dataType);
		//if($dataType == '0') { $dsSave['Password'] = md5($dsSave['Password']); }

		// Save data to DB.
		$result = $this->oMasterdata_m->Save($rowId, $dsSave);

		return $result;
	}
// End Private function.
}