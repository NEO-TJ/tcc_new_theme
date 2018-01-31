<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HiddenTools_m extends CI_Model {
// Constructor.
	public function __construct() {
        parent::__construct();
    }
// End Constructor.


// Public function.
    // ------------------------------------------------------------------------ Hidden function Encrypt Password
    public function autoEncryptPassword() {
        $result = true;
        $this->load->model('dataclass/users_d');
        $this->load->model('db_m');

        // Get all users.
        $sqlStr = "SELECT " . $this->users_d->colId
            . ", " . $this->users_d->colPassword
            . " FROM " . $this->users_d->tableName;
        $dsUser = $this->db_m->GetRow($sqlStr);
        
        // Update encrypt password all users.
        $this->db_m->tableName = $this->users_d->tableName;
        foreach($dsUser as $rowUser) {
            $dsData = array($this->users_d->colPassword => md5($rowUser[$this->users_d->colPassword]));
            $rWhere = array($this->users_d->colId => $rowUser[$this->users_d->colId]);

            $result &= $this->db_m->UpdateRow(null, $dsData, $rWhere);
        }

		return $result;
    }
// End Public function.
}
