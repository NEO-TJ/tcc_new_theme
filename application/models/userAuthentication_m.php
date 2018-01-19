<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserAuthentication_m extends CI_Model {
// Public Property.
    public $id;
    public $userName;
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
    // ---------------------------------------------------------------------------------------- Get profile
    public function GetProfile($id) {
        $this->load->model('dataclass/users_d');
		$this->load->model('db_m');

		// Check custom duplication.
		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->GetRowById($id);

		return $result;
    }

    // ---------------------------------------------------------------------------------------- Validate
    public function Validate($userName, $password) {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

        $this->db_m->tableName = $this->users_d->tableName;
        $rWhere = array(
            $this->users_d->colUserId   => $userName,
            $this->users_d->colPassword => $password
        );
        $result = $this->db_m->GetRowWhere($rWhere);

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
