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
        $encryptPassword = md5($password);
		$this->load->model('dataclass/users_d');
		$this->load->model('db_m');

        $this->db_m->tableName = $this->users_d->tableName;
        $rWhere = array(
            $this->users_d->colUserId   => $userName,
            $this->users_d->colPassword => $encryptPassword,
            $this->users_d->colStatus . ' !=' => userStatus::Deleted
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
            $this->users_d->colStatus . ' !=' => userStatus::Deleted,
            $this->users_d->colStatus . ' !=' => userStatus::Inactive
        ];
		$result = $this->db_m->Find($rWhere);

        return $result;
    }

    public function ChkEmailExist($email) {
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
    function verifyEmail($encryptEmail){
        $resultUserStatus = -1;
        $this->load->model("dataclass/users_d");
		$this->load->model('db_m');

        $this->db_m->tableName = $this->users_d->tableName;
        $rWhere = [
            'md5(' . $this->users_d->colEmail . ')' => $encryptEmail,
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
        // Encrypt password.
        if (array_key_exists($this->users_d->colPassword, $dsData)) {
            $dsData[$this->users_d->colPassword] = md5($dsData[$this->users_d->colPassword]);
        }

		// Check custom duplication.
		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->Save($id, $dsData);

		return $result;
    }
    public function SaveRegister($dsData) {
        $this->load->model('dataclass/users_d');
        $this->load->model('db_m');
        // Encrypt password.
        if (array_key_exists($this->users_d->colPassword, $dsData)) {
            $dsData[$this->users_d->colPassword] = md5($dsData[$this->users_d->colPassword]);
        }

		// Check custom duplication.
        $this->db_m->tableName = $this->users_d->tableName;
        $rWhere = array($this->users_d->colUserId => $dsData[$this->users_d->colUserId]);
		$result = $this->db_m->SaveCustomChkDup($rWhere, $dsData);

		return $result;
    }

    // ---------------------------------------------------------------------------------------- Reset Password
    public function ResetPassword($email, $newPassword) {
        $encryptNewPassword = md5($newPassword);
        $this->load->model('dataclass/users_d');
        $this->load->model('db_m');

        // Check custom duplication.
        $dsData = array($this->users_d->colPassword => $encryptNewPassword);
        $rWhere = array(
            $this->users_d->colEmail => $email,
            $this->users_d->colStatus . ' !=' => userStatus::Deleted
        );

		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->UpdateRow(null, $dsData, $rWhere);

		return $result;
    }

    // ---------------------------------------------------------------------------------------- Reset Password
    public function ChangePassword($id, $newPassword) {
        $encryptNewPassword = md5($newPassword);
        $this->load->model('dataclass/users_d');
        $this->load->model('db_m');

        // Check custom duplication.
        $dsData = array($this->users_d->colPassword => $encryptNewPassword);
        $rWhere = array(
            $this->users_d->colId => $id,
            $this->users_d->colStatus . ' !=' => userStatus::Deleted
        );

		$this->db_m->tableName = $this->users_d->tableName;
		$result = $this->db_m->UpdateRow(null, $dsData, $rWhere);

		return $result;
    }
// End Public function.
}
