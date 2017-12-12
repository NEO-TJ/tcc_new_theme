<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MapPlace_m extends CI_Model
{
// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.


// Public Method.
	// ---------------------------------------------------- Get  To view -----------------------------------------
	public function GetDataForViewDisplay($rFilter=null) {
		$this->load->model('dataclass/geoLocation_d');
		$this->load->model('dataclass/iccCard_d');
		$this->load->model('dataclass/weightUnit_d');

    // Prepare Filter.
		$sqlWhere = $this->CreateSqlWhereFilter($rFilter);

		// Create sql string.
		$sqlStr = "SELECT m." . $this->geoLocation_d->colId . ", c." . $this->iccCard_d->colProjectName
					. ", m." . $this->geoLocation_d->colLatitude . ", m." . $this->geoLocation_d->colLongitude
					. ", CONCAT(c." . $this->iccCard_d->colGarbageWeight
					. ",' ',wu." . $this->weightUnit_d->colName . ") AS totalGarbageQty"
					. ", m." . $this->geoLocation_d->colImagePath

					. " FROM " . $this->geoLocation_d->tableName . " AS m"
					. " LEFT JOIN " . $this->iccCard_d->tableName . " AS c"
					. " ON m." . $this->geoLocation_d->colFkIccCard
					. "=c." . $this->iccCard_d->colId
					. " AND c." . $this->iccCard_d->colActive . "=1"

					. " LEFT JOIN " . $this->weightUnit_d->tableName . " AS wu"
					. " ON c." . $this->iccCard_d->colFkWeightUnit
					. "=wu." . $this->weightUnit_d->colId

					. $sqlWhere
					
					. " GROUP BY m." . $this->geoLocation_d->colLatitude
					. ", m." . $this->geoLocation_d->colLongitude;

		// Execute sql.
		$this->load->model('db_m');
		$result = $this->db_m->GetRow($sqlStr);

		return $result;
	}
// End Public Method.


// Private function.
	// -------------------------------------------------------------------------------------------- Gen Sql
	private function CreateSqlWhereFilter($rFilter=null) {
		$this->load->model('dataclass/iccCard_d');
		$this->load->model('dataclass/geoLocation_d');

		// Create sql string where.
		$sqlWhere = " WHERE c." . $this->iccCard_d->colActive . "=1"
			. " AND m." . $this->geoLocation_d->colActive . "=1";

		if($rFilter !== NULL) {
			$sqlWhere .= (isset($rFilter['provinceCode']) && ($rFilter['provinceCode'] > 0)
					? " AND c." . $this->iccCard_d->colFkProvinceCode . "=" . $rFilter['provinceCode']
					: NULL );
			$sqlWhere .= (isset($rFilter['iccCardId']) && ($rFilter['iccCardId'] != '0')
					? " AND c." . $this->iccCard_d->colId . "=" . $rFilter['iccCardId']
					: NULL );
			$sqlWhere .= (isset($rFilter['orgId']) && ($rFilter['orgId'] > 0)
					? " AND c." . $this->iccCard_d->colFkOrg . "=" . $rFilter['orgId']
					: NULL );
			$sqlWhere .= " AND c." . $this->iccCard_d->colEventDate;
			$sqlWhere .= " BETWEEN '" . $rFilter['strDateStart'] . "%' AND '" . $rFilter['strDateEnd'] . "%'";
		}

		return $sqlWhere;
	}
	// -------------------------------------------------------------------------------------------- End Gen Sql
// End Private function.
}
