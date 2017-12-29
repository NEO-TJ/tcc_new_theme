<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_d extends CI_Model {
	// Property.
    public $tableName = "comments";
	public $colId = "id";
    public $colTopicId = "topic_id";
    public $colCreator = "creator";
    public $colCreated = "created";
    public $colModified = "modified";
    public $colContent = "content";
    public $colProfilePictureUrl = "profile_picture_url";
    public $colParent = "parent";
    public $colUpvoteCount = "upvote_count";
    public $colUserHasUpvoted = "user_has_upvoted";
    public $colCreatedByAdmin = "created_by_admin";
    public $colCreatedByCurrentUser = "created_by_current_user";


    // Constructor.
	public function __construct() {
        parent::__construct();
    }
}
