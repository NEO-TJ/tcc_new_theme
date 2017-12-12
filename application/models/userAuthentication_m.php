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
    public function Validate() {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

        /*
            $this->db_m->tableName = $this->users_d->tableName;
            $arrWhere = [
                        $this->users_d->colUserId   => $this->userId,
                        $this->users_d->colPassword => $this->password,
                        $this->users_d->colStatus   => '1'
            ];
            $result = $this->db_m->GetRowWhere($arrWhere);
        */
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

    // ---------------------------------------------------------------------------------------- Validate
    public function Save($dsData) {
        $this->load->model('dataclass/users_d');
		$this->load->model('db_m');

		// Check custom duplication.
		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->CreateRow($dsData);

		return $result;
    }
// End Public function.
}
