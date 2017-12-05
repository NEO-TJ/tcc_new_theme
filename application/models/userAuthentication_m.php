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
    // ------------------------------------------------- Validate --------------------------------------
    public function Validate() {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

        $this->db_m->tableName = $this->users_d->tableName;
        $arrWhere = [
					$this->users_d->colUserId   => $this->userId,
					$this->users_d->colPassword => $this->password,
					$this->users_d->colStatus   => '1'
        ];
		$result = $this->db_m->GetRowWhere($arrWhere);

        return $result;
    }
// End Public function.
}
