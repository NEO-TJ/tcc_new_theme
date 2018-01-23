<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserAuthentication_m extends CI_Model {
// Public Property.
    public $id;
    public $userName;
    public $password;
    public $fkIdEmployee;
    public $level;
    public $status;
    public $createDate;
    public $updateDate;

    public $active;
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
        $rWhere = [
            $this->users_d->colEmail => $email,
            $this->users_d->colStatus . ' !=' => userStatus::Deleted
        ];
		$result = $this->db_m->Find($rWhere);

        return $result;
    }

    public function ChkEmailReset($email) {
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

        $this->db_m->tableName = $this->users_d->tableName;
        $rWhere = [
            $this->users_d->colEmail => $email,
            $this->users_d->colStatus . ' !=' => userStatus::Deleted
        ];
        $result = $this->db_m->Find($rWhere);
        $this->status = ($result ? $this->db_m->dataSet[0]['Status'] : -1);

        return $result;
    }
    
    //activate account
    function verifyEmail($emailEncode){
        $resultUserStatus = -1;
        $this->load->model("dataclass/users_d");
		$this->load->model('db_m');

        $this->db_m->tableName = $this->users_d->tableName;
        $rWhere = [
            'md5(' . $this->users_d->colEmail . ')' => $emailEncode,
            $this->users_d->colStatus . ' !=' => userStatus::Deleted
        ];
        $resultFind = $this->db_m->Find($rWhere);
        $resultUserStatus = ($resultFind ? $this->db_m->dataSet[0]['Status'] : -1);

        if($resultUserStatus == userStatus::Inactive) {
            $dsData = array($this->users_d->colStatus => userStatus::Active);
            $resultUserStatus = ($this->db_m->UpdateRow(null, $dsData, $rWhere) ? userStatus::Active : -1);
        }

        return ($resultUserStatus);
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


    // ---------------------------------------------------------------------------------------- Reset Password
    public function ResetPassword($email, $newPassword) {
        $this->load->model('dataclass/users_d');
        $this->load->model('db_m');

        // Check custom duplication.
        $dsData = array($this->users_d->colPassword => $newPassword);
        $rWhere = array(
            $this->users_d->colEmail => $email,
            $this->users_d->colStatus . ' !=' => userStatus::Deleted
        );

		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->UpdateRow(null, $dsData, $rWhere);

		return $result;
    }
// End Public function.
}
