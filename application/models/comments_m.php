<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_m extends CI_Model {
// Property.
	private $userIconPath = "assets/images/comment/";
// End Property.


// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.


// ******************************************************************************************** Method
	// ------------------------------------------------------------------------------------------ Get Dataset Comments.
	public function GetDsComments($iccCardId=null) {
		$userIconPath = base_url() . $this->userIconPath;
		$userId = ($this->session->userdata('isUserLoggedIn') ? $this->session->userdata('id') : -1);

		$this->load->model("dataclass/comments_d");
		$this->load->model("dataclass/users_d");
		$this->load->model("db_m");

		$sqlStr = "SELECT c." . $this->comments_d->colId
			. ", c." .$this->comments_d->colCreator
			. ", u." .$this->users_d->colFirstName . " fullname"
			. ", c." .$this->comments_d->colCreated
			. ", c." .$this->comments_d->colModified
			. ", c." .$this->comments_d->colContent
			. ', CONCAT("' .$userIconPath . '",c.' . $this->comments_d->colProfilePictureUrl
			. ') as ' . $this->comments_d->colProfilePictureUrl
			. ", c." .$this->comments_d->colParent
			. ", c." .$this->comments_d->colUpvoteCount
			. ", c." .$this->comments_d->colUserHasUpvoted
			. ", c." .$this->comments_d->colCreatedByAdmin
			. ", c." .$this->comments_d->colCreator . "=" . $userId
			. " as " . $this->comments_d->colCreatedByCurrentUser

			. " FROM " . $this->comments_d->tableName . " c"
			. " LEFT JOIN " .$this->users_d->tableName . " u"
			. " ON c." . $this->comments_d->colCreator . "=u." . $this->users_d->colId

			. ( (isset($iccCardId) && ($iccCardId > 0)) 
			? " WHERE c." . $this->comments_d->colTopicId . "=" . $iccCardId : "");

		// Execute sql.
		$this->load->model('db_m');
		$dataSet = $this->db_m->GetRow($sqlStr);

		return $dataSet;
	}


	// ------------------------------------------------------------------------------------------ Insert Database Comments.
	public function InsertComments($dsComments) {
		$this->load->model('dataclass/comments_d');
		$this->load->model('db_m');
		$this->db_m->tableName = $this->comments_d->tableName;

		$commentsId = (($this->db_m->CreateRow($dsComments)) ? $this->db_m->insertId : 0);

		return $commentsId;
	}

	// ------------------------------------------------------------------------------------------ Update Database Comments.
	public function UpdateComments($commentsId, $dsComments) {
		$this->load->model('dataclass/comments_d');
		$this->load->model('db_m');
		$this->db_m->tableName = $this->comments_d->tableName;

		$result = (($this->db_m->UpdateRow($commentsId, $dsComments)) ? 1 : 0);

		return $result;
	}

	// ------------------------------------------------------------------------------------------ Delete Database Comments.
	public function DeleteComments($commentsId) {
		$this->load->model('dataclass/comments_d');
		$this->load->model('db_m');
		$this->db_m->tableName = $this->comments_d->tableName;

		$result = (($this->db_m->DeleteRow($commentsId)) ? 1 : 0);

		return $result;
	}


	// ------------------------------------------------------------------------------------------ Update Database Comments.
	public function UpvoteComments($commentsId, $dsComments) {
		$this->load->model('dataclass/comments_d');
		$this->load->model('db_m');
		$this->db_m->tableName = $this->comments_d->tableName;

		$result = (($this->db_m->UpdateRow($commentsId, $dsComments)) ? 1 : 0);

		return $result;
	}
}
// ******************************************************************************************** End Method