<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserAuthentication_m extends CI_Model {
// Public Property.
    public $id;
    public $userId;
    public $password;
    public $fkIdEmployee;
    public $level;
    public $active;
    public $createDate;
    public $updateDate;
// End Public Property.



// Constructor.
	public function __construct() {
        parent::__construct();
    }
// End Constructor.


// Public function.
    // ---------------------------------------------------------------------------------------- Validate
    public function GetProfile($id) {
        $this->load->model('dataclass/users_d');
		$this->load->model('db_m');

		// Check custom duplication.
		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->GetRowById($id);

		return $result;
    }

    // ---------------------------------------------------------------------------------------- Validate
    public function Validate() {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

        // Create sql string.
		$sqlStr = "SELECT *"
            . " FROM " . $this->users_d->tableName

            . " WHERE " . $this->users_d->colStatus . "=1"
            . " AND ((" . $this->users_d->colLevel . "<4  AND " .$this->users_d->colUserId . "='" . $this->userId . "')"
            . " OR (" . $this->users_d->colLevel . "=4 AND " . $this->users_d->colEmail . "='" . $this->userId . "'))";

        // Execute sql.
        $this->load->model('db_m');
        $result = $this->db_m->GetRow($sqlStr);


        return $result;
    }

    public function ChkEmailDup($email) {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

        $this->db_m->tableName = $this->users_d->tableName;
        $arrWhere = [
            $this->users_d->colEmail    => $email,
            $this->users_d->colStatus   => '1'
        ];
		$result = $this->db_m->Find($arrWhere);

        return $result;
    }
    
    //activate account
    function verifyEmail($key){
        $data = array('Status' => 1);
        $this->db->where('md5(Email)',$key);

        return $this->db->update('users', $data);    //update status as 1 to make active user
    }

    // ---------------------------------------------------------------------------------------- Save
    public function Save($id, $dsData) {
        $this->load->model('dataclass/users_d');
		$this->load->model('db_m');

		// Check custom duplication.
		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->Save($id, $dsData);

		return $result;
    }
// End Public function.
}
