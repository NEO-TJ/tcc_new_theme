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
		// Calc total.
		$sqls="select SUM(gt.Garbage_Qty) as qty"
			. " from garbage_transaction gt"
			. " left join garbage g on gt.FK_Garbage=g.id"
			. " where gt.Active = 1";
		$dsMarineDebrisTotal=$this->db->query($sqls);

		if($dsMarineDebrisTotal->num_rows() == 0){
			$data['dsMarineDebrisTotal'] = 1;
			$dsMarineDebrisTotal = 1;
		}else{
			$dsTemp =$dsMarineDebrisTotal->result_array();
			$data['dsMarineDebrisTotal'] = $dsTemp[0]["qty"];
		}

		// get top ten and percent.
		$sqls="select g.Name, SUM(gt.Garbage_Qty) as qty"
			. " from garbage_transaction gt"
			. " left join garbage g on gt.FK_Garbage=g.id"
			. " where gt.Active = 1"
			. " group by gt.FK_Garbage"
			. " order by qty desc"
			. " limit 10";
		$dsMarineDebris10=$this->db->query($sqls);

		if($dsMarineDebris10->num_rows() == 0){
			$data['dsMarineDebris10'] = array();
		}else{
			$data['dsMarineDebris10'] =$dsMarineDebris10->result_array();
		}

		// Set template
		$this->data = $data;
		$this->body = 'frontend/welcome_home/view/index';
		$this->isHomePage = true;
		$this->renderWithTemplate();	
	}
}

