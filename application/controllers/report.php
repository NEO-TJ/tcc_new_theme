<?php
class Report extends MY_Controller {
// Property.
	private $captionPage = [1 => "รายงานข้อมูลขยะทะเลในประเทศไทย"];
// End Property.


// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.




// Method start.
	public function index() {
		$this->mainReport();
	}
// End Method start.



// Routing function.
	private function mainReport() {
		// Prepare data of view.
		$this->data = $this->GetInitialMainReportData();

		// Prepare Template.
		$this->extendedCss = 'frontend/report/main/extendedCss_v';
		$this->body = 'frontend/report/main/body_v';
		$this->extendedJs = 'frontend/report/main/extendedJs_v';
		$this->footer = 'frontend/report/main/footer_v';
		$this->renderWithTemplate();
	}
// End Routing function.


// AJAX function.
	// ---------------------------------------------------------------------------------------- Get Data for Combobox report and map.
	public function ajaxGetMainReportData() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$rankingLimit = $this->input->post('rankingLimit');
			$strDateStart = $this->input->post('strDateStart');
			$strDateEnd = $this->input->post('strDateEnd');
			$provinceCode = $this->input->post('provinceCode');
			$provinceCode = ( ($provinceCode > 0 ) ? $provinceCode : null);
			$iccCardId = $this->input->post('iccCardId');
			$iccCardId = ((($iccCardId == "0" ) || ($iccCardId == 0 )) ? null : $iccCardId);

			$this->load->model("report_m");
			$result = $this->report_m->GetMainReportData($rankingLimit, $strDateStart, $strDateEnd, $provinceCode, $iccCardId);

			echo json_encode($result);
		}
	}
// END AJAX function.


// Private function.
	// ---------------------------------------------------------------------------------------- Get initial data for Main Report.
	private function GetInitialMainReportData() {
		$data["map"] = $this->CreateMap()["map"];

		return $data;
	}

	// ---------------------------------------------------------------------------------------- Create Map.
	private function CreateMap($dsMapTransaction=array()) {
		$this->load->library('googlemaps');
		// Config.
		$config['apiKey'] = 'AIzaSyClagICh6L2KDnt5-14byUhE-wBRnjiYeg';
		$config['center'] = '10.3,101';
		$config['zoom'] = '6';
		$config['cluster'] = TRUE;
		//$config['places'] = TRUE;
		$this->googlemaps->initialize($config);

		// Marker.
		foreach($dsMapTransaction as $row) {
			$marker = array();
			$marker['position'] = $row['Lat'] . "," . $row['Lon'];
			$marker['title']  = $row['Project_Name'];
			$marker['infowindow_content'] = $row['Project_Name'] . "<p>" . $row['totalGarbageQty'];
			$this->googlemaps->add_marker($marker);
		}

		$data['map'] = $this->googlemaps->create_map();

		return $data;
	}
// End Private function.
}