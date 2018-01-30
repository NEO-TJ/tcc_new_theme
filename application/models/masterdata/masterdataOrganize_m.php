<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterdataOrganize_m extends CI_Model {
// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.



// Public function.
	// ------------------------------------------------------------ Get ------------------------------------------
	// +++ To view +++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function GetDataForViewDisplay($arrId=null, $sqlWhere=null) {
		$this->load->model('dataclass/org_d');

		$criteria ='';
		// Prepare Criteria.
		$this->load->model('helper_m');
		if($arrId != null){
			$criteria = $this->helper_m->CreateCriteriaIn('o.'.$this->org_d->colId, $arrId, $criteria, ' WHERE ');
		}
		// Prepare Where.
		$criteria = $this->helper_m->CreateSqlWhere($criteria, $sqlWhere);

		// Create sql string.
		$sqlStr = "SELECT o." . $this->org_d->colId . " as id"
			. ", o." . $this->org_d->colDepartment . " as ชื่อหน่วยงาน"
			. ", o." . $this->org_d->colLocation . " as สถานที่ตั้ง"
			. " FROM " . $this->org_d->tableName . " o"

			. $criteria
			. " ORDER BY o." . $this->org_d->colDepartment
			. ", o." . $this->org_d->colLocation;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

		return $result;
	}

	// +++ To input ++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function GetDataForInputDisplay($id=null) {
		$this->load->model('dataclass/org_d');

		// Create sql string.
		$sqlStr = "SELECT *"
			. " FROM " . $this->org_d->tableName . " o"
			. " WHERE o." . $this->org_d->colId . "=" . $id;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

		return $result;
	}

	public function GetTemplateForInputDisplay() {
		$this->load->model('dataclass/org_d');

		$result = [
				$this->org_d->colId					=> 0,
				$this->org_d->colDeglon			=> 0,
				$this->org_d->colDeglat			=> 0,

				$this->org_d->colUtmx				=> 0,
				$this->org_d->colUtmy				=> 0,
				$this->org_d->colUtmz				=> 0,
				$this->org_d->colUtmp				=> '',

				$this->org_d->colGmaplon		=> 0,
				$this->org_d->colGmaplat		=> 0,

				$this->org_d->colDepartment	=> '',
				$this->org_d->colLocation		=> '',
		];

		return $result;
	}

	public function GetDataForComboBox() {
		return null;
	}


	// ----------------------------------------------------------- Save ------------------------------------------
	public function Save($id=null, $dsData) {
		$this->load->model('dataclass/org_d');
		$this->load->model('db_m');

		// Check custom duplication.
		$rChkDuplication = [
			$this->org_d->colDepartment => $dsData[$this->org_d->colDepartment],
			$this->org_d->colId . " !=" => ( ($id == null) ? 0 : $id)
		];
		$this->db_m->rChkDuplication = $rChkDuplication;
		// End Check custom duplication.

		$this->db_m->tableName = $this->org_d->tableName;

		$result = $this->db_m->Save($id, $dsData);
		$this->db_m->rChkDuplication = null;

		return $result;
	}


	// ----------------------------------------------------------- Delete ------------------------------------------
	public function Delete($id=0) {
		$this->load->model('dataclass/org_d');
		$this->load->model('db_m');
		$this->db_m->tableName = $this->org_d->tableName;

		$result = $this->db_m->DeleteRow($id);
		
		return $result;
	}
// Public function.
}
