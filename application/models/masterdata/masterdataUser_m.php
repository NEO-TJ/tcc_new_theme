<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterdataUser_m extends CI_Model {
// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.



// Public function.
	// ------------------------------------------------------------ Get ------------------------------------------
	// +++ To view +++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function GetDataForViewDisplay($arrId=null, $sqlWhere=null) {
		$this->load->model('dataclass/user_d');
		$this->load->model('dataclass/org_d');

		$criteria ='';
		// Prepare Criteria.
		$this->load->model('helper_m');
		if($arrId != null){
			$criteria = $this->helper_m->CreateCriteriaIn('u.'.$this->user_d->colId, $arrId, $criteria, ' WHERE ');
		}
		// Prepare Where.
		$criteria = $this->helper_m->CreateSqlWhere($criteria, $sqlWhere);

		// Create sql string.
		$sqlStr = "SELECT u." . $this->user_d->colId
			. ", u." . $this->user_d->colUserId
			. ", u." . $this->user_d->colFirstName
			. ", u." . $this->user_d->colLastName

			. ", CASE WHEN u." . $this->user_d->colGender
			. "=1 THEN 'Male' ELSE 'Female' END as " . $this->user_d->colGender

			. ", CASE WHEN u." . $this->user_d->colLevel . "=1 THEN 'ผู้ดูแลระบบ'"
			. " WHEN u." . $this->user_d->colLevel . "=2 THEN 'ชำนาญการ'"
			. " WHEN u." . $this->user_d->colLevel . "=3 THEN 'ปฏิบัติการ'"
			. " ELSE 'อาสาสมัคร' END as " . $this->user_d->colLevel

			. ", o." . $this->org_d->colDepartment

			. ", CASE WHEN u." . $this->user_d->colStatus . "=0 THEN 'ยังไม่เปิดใช้งาน'"
			. " WHEN u." . $this->user_d->colStatus . "=1 THEN 'พร้อมใช้งาน'"
			. " WHEN u." . $this->user_d->colStatus . "=2 THEN 'รอการยืนยัน'"
			. " ELSE 'รหัสถูกล๊อค' END as " . $this->user_d->colStatus

			. " FROM " . $this->user_d->tableName . " u"
			. " LEFT JOIN " . $this->org_d->tableName . " o"
			. " ON u." . $this->user_d->colFkDepartment . "=o." . $this->org_d->colDepartment

			. $criteria
			. " ORDER BY u." . $this->user_d->colLevel
			. ", u." . $this->user_d->colStatus
			. ", o." . $this->org_d->colDepartment
			. ", u." . $this->user_d->colUserId;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

		return $result;
	}

	// +++ To input ++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function GetDataForInputDisplay($id=null) {
		$this->load->model('dataclass/user_d');

		// Create sql string.
		$sqlStr = "SELECT *, u." . $this->user_d->colId . " masterId"
			. " FROM " . $this->user_d->tableName . " u"
			. " WHERE u." . $this->user_d->colId . "=" . $id;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

		return $result;
	}

	public function GetTemplateForInputDisplay() {
		$this->load->model('dataclass/user_d');
		$this->load->model('dataclass/employee_d');

		$result = [
				'masterId'											=> 0,
				$this->user_d->colUserId				=> '',
				$this->user_d->colPassword			=> '',
				$this->user_d->colFirstName			=> '',
				$this->user_d->colLastName			=> '',
				$this->user_d->colEmail					=> '',
				$this->user_d->colGender				=> 0,
				$this->user_d->colAge						=> 0,
				$this->user_d->colIdCardNumber	=> '',
				$this->user_d->colLevel					=> 3,
				$this->user_d->colFkDepartment	=> 0,
				$this->user_d->colStatus				=> 1,
		];

		return $result;
	}

	public function GetDataForComboBox() {
		$result['dsDepartment'] = $this->GetDsDepartment();

		return $result;
	}


	// ----------------------------------------------------------- Save ------------------------------------------
	public function Save($id=null, $dsData) {
		$this->load->model('dataclass/user_d');
		$this->load->model('db_m');

		$rResult = $this->PrepareDataUserTable($dsData);
		$dsSave = $rResult["dsSave"];
		$objCreateBy = $rResult["objCreateBy"];
		$tableNameUser = $this->user_d->tableName;

		// Check custom duplication.
		$this->db_m->tableName = $tableNameUser;
		$result = $this->db_m->Save($id, $dsSave, $objCreateBy);

		return $result;
	}
// Public function.



// Private function.
	private function PrepareDataUserTable($dsData) {
		$this->load->model('dataclass/user_d');

		$dsData["dsSave"] = [
			$this->user_d->colUserId				=> $dsData[$this->user_d->colUserId],
			$this->user_d->colPassword			=> $dsData[$this->user_d->colPassword],
			$this->user_d->colEmail					=> $dsData[$this->user_d->colEmail],
			$this->user_d->colLevel					=> $dsData[$this->user_d->colLevel],
			$this->user_d->colFkDepartment	=> $dsData[$this->user_d->colFkDepartment],
			$this->user_d->colStatus				=> 1,
			$this->user_d->colFirstName			=> $dsData[$this->user_d->colFirstName],
			$this->user_d->colLastName			=> $dsData[$this->user_d->colLastName],
			$this->user_d->colGender				=> $dsData[$this->user_d->colGender],
			$this->user_d->colAge 					=> $dsData[$this->user_d->colAge],
			$this->user_d->colIdCardNumber	=> $dsData[$this->user_d->colIdCardNumber],
			$this->user_d->colUpdateBy			=> $this->session->userdata['id'],
		];
		$dsData['objCreateBy'] = [$this->user_d->colCreateBy => $this->session->userdata['id']];

		return $dsData;
	}


	// ---------------------------------------------------- Get DB to combobox -----------------------------------
	// ^^^^******^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ Org table ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^****
	private function GetDsDepartment($id=0) {
		$this->load->model("dataclass/org_d");
		$this->load->model("db_m");

		$this->db_m->tableName = $this->org_d->tableName;
		$this->db_m->sequenceColumn = $this->org_d->colDepartment;
		$strSelect = $this->org_d->colId . ', ' . $this->org_d->colDepartment;
		$dataSet = $this->db_m->GetRowById($id, null, $strSelect);
    
		return $dataSet;
	}
// End Private function.
}
