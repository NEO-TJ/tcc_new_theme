<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class HiddenTools extends MY_Controller {
// Constructor.
    function __construct() {
        parent::__construct();
    }
// End Constructor.



// Route method.
    private function autoEncryptPassword() {
        $result = "Incomplete";
        $this->load->model("HiddenTools_m");
        if($this->HiddenTools_m->autoEncryptPassword()) {
            $result = "Complete";
        }

        echo $result;
    }
// End Route method.
}