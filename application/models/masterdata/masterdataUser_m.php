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
		$this->load->model('dataclass/users_d');
		$this->load->model('dataclass/org_d');

		$criteria ='';
		// Prepare Criteria.
		$this->load->model('helper_m');
		if($arrId != null){
			$criteria = $this->helper_m->CreateCriteriaIn('u.'.$this->users_d->colId, $arrId, $criteria, ' WHERE ');
		}
		// Prepare Where.
		$criteria = $this->helper_m->CreateSqlWhere($criteria, $sqlWhere);

		// Create sql string.
		$sqlStr = "SELECT u." . $this->users_d->colId . " as id"
			. ", u." . $this->users_d->colUserId . " as รหัสผู้ใช้งาน"
			. ", u." . $this->users_d->colFirstName . " as ชื่อผู้ใช้งาน"
			. ", u." . $this->users_d->colLastName . " as นามสกุล"

			. ", CASE WHEN u." . $this->users_d->colGender
			. "=1 THEN 'ชาย' ELSE 'หญิง' END as เพศ"

			. ", CASE WHEN u." . $this->users_d->colLevel . "=1 THEN 'ผู้ดูแลระบบ'"
			. " WHEN u." . $this->users_d->colLevel . "=2 THEN 'ชำนาญการ'"
			. " WHEN u." . $this->users_d->colLevel . "=3 THEN 'ปฏิบัติการ'"
			. " ELSE 'อาสาสมัคร' END as ระดับสิทธิ์ในระบบ"

			. ", o." . $this->org_d->colDepartment . " as ชื่อหน่วยงาน"

			. ", CASE WHEN u." . $this->users_d->colStatus . "=0 THEN 'ยังไม่เปิดใช้งาน'"
			. " WHEN u." . $this->users_d->colStatus . "=1 THEN 'พร้อมใช้งาน'"
			. " WHEN u." . $this->users_d->colStatus . "=2 THEN 'รอการยืนยัน'"
			. " ELSE 'รหัสถูกล๊อค' END as สถานะของรหัส"

			. " FROM " . $this->users_d->tableName . " u"
			. " LEFT JOIN " . $this->org_d->tableName . " o"
			. " ON u." . $this->users_d->colFkOrg . "=o." . $this->org_d->colId

			. $criteria
			. " ORDER BY u." . $this->users_d->colLevel
			. ", u." . $this->users_d->colStatus
			. ", o." . $this->org_d->colDepartment
			. ", u." . $this->users_d->colUserId;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

		return $result;
	}

	// +++ To input ++++++++++++++++++++++++++++++++++++++++++++++++++++++
	public function GetDataForInputDisplay($id=null) {
		$this->load->model('dataclass/users_d');

		// Create sql string.
		$sqlStr = "SELECT *"
			. " FROM " . $this->users_d->tableName . " u"
			. " WHERE u." . $this->users_d->colId . "=" . $id;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

		return $result;
	}

	public function GetTemplateForInputDisplay() {
		$this->load->model('dataclass/users_d');

		$result = [
				$this->users_d->colId						=> 0,
				$this->users_d->colUserId				=> '',
				$this->users_d->colPassword			=> '',
				$this->users_d->colFirstName		=> '',
				$this->users_d->colLastName			=> '',
				$this->users_d->colEmail				=> '',
				$this->users_d->colGender				=> 0,
				$this->users_d->colAge					=> 0,
				$this->users_d->colIdCardNumber	=> '',
				$this->users_d->colLevel				=> 3,
				$this->users_d->colFkOrg				=> 0,
				$this->users_d->colStatus				=> 1,
		];

		return $result;
	}

	public function GetDataForComboBox() {
		$result['dsDepartment'] = $this->GetDsDepartment();

		return $result;
	}


	// ----------------------------------------------------------- Save ------------------------------------------
	public function Save($id=null, $dsData) {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

		$rResult = $this->PrepareDataUserTable($dsData);
		$dsSave = $rResult["dsSave"];
		$objCreateBy = $rResult["objCreateBy"];
		$tableNameUser = $this->users_d->tableName;

		// Check custom duplication.
		$this->db_m->tableName = $tableNameUser;
		$result = $this->db_m->Save($id, $dsSave, $objCreateBy);

		return $result;
	}


	// ----------------------------------------------------------- Delete ------------------------------------------
	public function Delete($id=0) {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');
		$this->db_m->tableName = $this->users_d->tableName;

		$result = $this->db_m->DeleteRow($id);
		
		return $result;
	}

	public function Inactive($id=0) {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');
		$this->db_m->tableName = $this->users_d->tableName;
		$data = array(
			$this->users_d->colStatus => 0,
			$this->users_d->colDeleteBy => $this->session->userdata['id']
		);

		$result = $this->db_m->UpdateRow($id, $data);
		
		return $result;
	}
// Public function.



// Private function.
	private function PrepareDataUserTable($dsData) {
		$this->load->model('dataclass/users_d');

		$dsData["dsSave"] = [
			$this->users_d->colUserId				=> $dsData[$this->users_d->colUserId],
			$this->users_d->colPassword			=> $dsData[$this->users_d->colPassword],
			$this->users_d->colEmail				=> $dsData[$this->users_d->colEmail],
			$this->users_d->colLevel				=> $dsData[$this->users_d->colLevel],
			$this->users_d->colFkOrg				=> $dsData[$this->users_d->colFkOrg],
			$this->users_d->colStatus				=> 1,
			$this->users_d->colFirstName		=> $dsData[$this->users_d->colFirstName],
			$this->users_d->colLastName			=> $dsData[$this->users_d->colLastName],
			$this->users_d->colGender				=> $dsData[$this->users_d->colGender],
			$this->users_d->colAge 					=> $dsData[$this->users_d->colAge],
			$this->users_d->colIdCardNumber	=> $dsData[$this->users_d->colIdCardNumber],
			$this->users_d->colUpdateBy			=> $this->session->userdata['id'],
		];
		$dsData['objCreateBy'] = [$this->users_d->colCreateBy => $this->session->userdata['id']];

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
