<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class welcome_homes extends MY_Controller {
  public function __construct() {
		parent::__construct();
		$this->load->model('selectblog');  
	}

  public function index() {
		// Article.
   	$sql="select * from article where FK_Article_Category = 1 and edate <= now() ORDER BY id DESC LIMIT 0,3";
		$rs=$this->db->query($sql);

		if($rs->num_rows() == 0){
			$data['rs'] = array();
		}else{
			$data['rs'] =$rs->result_array();
		}

		// Slide show
		$slide="select * from slideshow";
		$sl=$this->db->query($slide);

		if($sl->num_rows() == 0){
			$data['sl'] = array();
		}else{
			$data['sl'] =$sl->result_array();
		}

		// Category.
		$sqls="select * from article where FK_Article_Category = 2 and edate <= now() ORDER BY id DESC LIMIT 0,3";
		$rt=$this->db->query($sqls);

		if($rt->num_rows() == 0){
			$data['rt'] = array();
		}else{
			$data['rt'] =$rt->result_array();
		}  

		// Top ten marine debris.
		$this->load->model("report_m");
		$rData = $this->report_m->GetMarineDebrisTopTen();
		$data['dsMarineDebris10'] = $rData['dsMarineDebrisTopTen'];
		$data['marineDebrisTotal'] = $rData['marineDebrisTotal'];

		// Set template
		$this->data = $data;
		$this->body = 'frontend/welcome_home/view/index';
		$this->isHomePage = true;
		$this->renderWithTemplate();	
	}
}

