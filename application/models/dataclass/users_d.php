<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
abstract class userStatus {
    const Inactive = 0;
    const Active = 1;
    const Locked = 2;
    const Deleted = 3;
}

class Users_d extends CI_Model {
	// Property.
    public $tableName = "users";
	public $colId = "id";
	public $colUserId = "UserId";
	public $colPassword = "Password";
	public $colEmail = "Email";
	public $colLevel = "Level";
	public $colStatus = "Status";
	public $colFirstName = "First_Name";
	public $colLastName = "Last_Name";
	public $colDepartment = "Department";
	public $colGender = "Gender";
	public $colAge = "Age";
	public $colIdCardNumber = "ID_Card_Number";
	public $colFkDepartment = "FK_Department";

	public $colCreateDate = "Create_Date";
    public $colCreateBy = "Create_By";
    public $colUpdateDate = "Update_Date";
    public $colUpdateBy = "Update_By";
    public $colDeleteDate = "Delete_Date";
    public $colDeleteBy = "Delete_By";


    // Constructor.
	public function __construct() {
        parent::__construct();
    }
}
