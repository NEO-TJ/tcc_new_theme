<?php
class AjaxService extends MY_Controller {
// Constructor.
	public function __construct() {
		parent::__construct();
	}
// End Constructor.


// Method start.
	public function index() {
	}
// End Method start.

// AJAX function.
	// ---------------------------------------------------------------------------------------- Get data to ComboBox
	public function ajaxGetPlaceByDaterange() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->load->model("dataclass/users_d");

			$strDateStart = $this->input->post('strDateStart');
			$strDateEnd = $this->input->post('strDateEnd');
			$blnFilterOrg = ( (($this->input->post('filterOrg') == 1)
										&& ($this->session->userdata('level') != userLevel::Admin))
										? TRUE : FALSE);

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetPlaceByDaterange($strDateStart, $strDateEnd, $blnFilterOrg);

			echo json_encode($dsData);
		}
	}
	public function ajaxGetPlaceByProvince() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->load->model("dataclass/users_d");

			$strDateStart = $this->input->post('strDateStart');
			$strDateEnd = $this->input->post('strDateEnd');
			$provinceCode = $this->input->post('provinceCode');
			$blnFilterOrg = ( (($this->input->post('filterOrg') == 1)
										&& ($this->session->userdata('level') != userLevel::Admin))
										? TRUE : FALSE);

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetPlaceByProvince($strDateStart, $strDateEnd, $provinceCode, $blnFilterOrg);

			echo json_encode($dsData);
		}
	}
	public function ajaxGetAmphurByProvince() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$provinceCode = $this->input->post('provinceCode');

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetOnlyAmphurByProvince($provinceCode);

			echo json_encode($dsData);
		}
	}
	// ---------------------------------------------------------------------------------------- Get data from Multiselect ComboBox
	public function ajaxGetPlaceByMultiProvince() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->load->model("dataclass/users_d");
			$this->load->model("helper_m");

			$strDateStart = $this->input->post('strDateStart');
			$strDateEnd = $this->input->post('strDateEnd');
			$rProvinceCode = $this->helper_m->getPostArrayHelper($this->input->post('rProvinceCode'));
			$blnFilterOrg = ( (($this->input->post('filterOrg') == 1)
										&& ($this->session->userdata('level') != userLevel::Admin))
										? TRUE : FALSE);

			$this->load->model("iccCard_m");
			$dsData = $this->iccCard_m->GetPlaceByMultiProvince($strDateStart, $strDateEnd, $rProvinceCode, $blnFilterOrg);

			echo json_encode($dsData);
		}
	}


	// ---------------------------------------------------------------------------------------- Get data for comment
	public function ajaxGetComments() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$iccCardId = $this->input->post('iccCardId');

			$this->load->model("comments_m");
			$dsData = $this->comments_m->GetDsComments($iccCardId);

			echo json_encode($dsData);
		}
	}

	// ---------------------------------------------------------------------------------------- Insert data to comment
	public function ajaxInsertComments() {
		$commentId = 0;
		if($this->session->userdata('isUserLoggedIn')) {
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$dsComments = $this->input->post('dsComments');

				// Prepare data before save to database.
				$dsComments = $this->prepareDataBeforeSave($dsComments);

				// Insert to database.
				$this->load->model("comments_m");
				$commentId = $this->comments_m->InsertComments($dsComments);
			}
		} else {
			$commentId = -1;
		}

		echo ($commentId);
	}

	// ---------------------------------------------------------------------------------------- Update data to comment
	public function ajaxUpdateComments() {
		$result = 0;
		if($this->session->userdata('isUserLoggedIn')) {
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$commentsId = $this->input->post('commentsId');
				$dsComments = $this->input->post('dsComments');

				// Prepare data before save to database.
				$this->load->model("dataclass/comments_d");
				$dsComments = $this->prepareDataBeforeSave($dsComments);

				// Update to database.
				$this->load->model("comments_m");
				$result = $this->comments_m->UpdateComments($commentsId, $dsComments);
			}
		} else {
			$result = -1;
		}

		echo ($result);
	}

	// ---------------------------------------------------------------------------------------- Delete data to comment
	public function ajaxDeleteComments() {
		$result = 0;
		if($this->session->userdata('isUserLoggedIn')) {
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$commentsId = $this->input->post('commentsId');

				// Delete to database.
				$this->load->model("comments_m");
				$result = $this->comments_m->DeleteComments($commentsId);
			}
		} else {
			$result = -1;
		}

		echo ($result);
	}


	// ---------------------------------------------------------------------------------------- Update data to comment
	public function ajaxUpvoteComments() {
		$result = 0;
		if($this->session->userdata('isUserLoggedIn')) {
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$commentsId = $this->input->post('commentsId');
				$creatorId = $this->input->post('creatorId');
				$dsComments = $this->input->post('dsComments');

				// Prepare data before save to database.
				$dsComments = $this->prepareDataBeforeSave($dsComments, $creatorId);

				// Upvote to database.
				$this->load->model("comments_m");
				$result = $this->comments_m->UpvoteComments($commentsId, $dsComments);
			}
		} else {
			$result = -1;
		}

		echo ($result);
	}


	// ---------------------------------------------------------------------------------------- Valid User Id
	public function ajaxValidUserId() {
		$result = false;
		if($this->session->userdata('isUserLoggedIn')) {
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$userId = $this->input->post('userId');

				$this->load->model('masterdata/masterdataUser_m');
				$result = $this->masterdataUser_m->ValidUserId($userId);
			}
		}

		echo (($result) ? 0 : 1);
	}
// End AJAX function.



// Private method.
	// -------------------------------------------------------------------------------------------- Prepare data to db.
	private function prepareDataBeforeSave($dsComments, $creatorId=0) {
		$this->load->model('dataclass/comments_d');

		// Set profile picture url.
		if(array_key_exists($this->comments_d->colProfilePictureUrl, $dsComments)) {
			$parts = explode('/', $dsComments[$this->comments_d->colProfilePictureUrl]);
			$last = array_pop($parts);
			$parts = array(implode('/', $parts), $last);
			$dsComments[$this->comments_d->colProfilePictureUrl] = (isset($parts[1]) ? $parts[1] : "");
		}

		// Set user id.
		if(array_key_exists($this->comments_d->colCreator, $dsComments)) {
			$dsComments[$this->comments_d->colCreator] = $this->session->userdata('id');
		}

		// Set parent id.
		if(array_key_exists($this->comments_d->colParent, $dsComments)) {
			$dsComments[$this->comments_d->colParent] = (( (int)$dsComments[$this->comments_d->colParent] > 0 ) 
				? $dsComments[$this->comments_d->colParent] : NULL);
		}

		
		// Set User has upvoted.
		if(array_key_exists($this->comments_d->colUserHasUpvoted, $dsComments)) {
			// Convert string to boolean.
			$dsComments[$this->comments_d->colUserHasUpvoted] = (
				($dsComments[$this->comments_d->colUserHasUpvoted] == "1")
				? TRUE : FALSE);
			// Check creator is upvote? (toggle).
			$dsComments[$this->comments_d->colUserHasUpvoted] = (
				($creatorId == $this->session->userdata('id'))
				? !$dsComments[$this->comments_d->colUserHasUpvoted]
				: $dsComments[$this->comments_d->colUserHasUpvoted]);
		}

		// Set created by admin.
		if(array_key_exists($this->comments_d->colCreatedByAdmin, $dsComments)) {
			$dsComments[$this->comments_d->colCreatedByAdmin] = (
				($dsComments[$this->comments_d->colCreatedByAdmin] == "1")
				? TRUE : FALSE);
		}

		return $dsComments;
	}

	// -------------------------------------------------------------------------------------------- json helper.
	private function JsonParseInt($objJson, $rField) {
		$objJsonLength = count($objJson);
		$rFieldLength = count($rField);
		for($i = 0; $i < $objJsonLength; $i++) {
				for($j = 0; $j < $rFieldLength; $j++) {
						$objJson[$i][$rField[$j]] = (int)$objJson[$i][$rField[$j]];
				}
		}
		return $objJson;
	}
// End private method.
}