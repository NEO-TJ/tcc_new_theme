<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Management class created by CodexWorld
 */
class Users extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
    }
    
    /*
     * User account information
     */
    public function account(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            //load the view
            $this->load->view('users/account', $data);
        }else{
            redirect('users/login');
        }
    }
    
    /*
     * User login
     */
    public function login(){
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('loginSubmit')){
            $this->form_validation->set_rules('username', 'Username or Email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'name'=>$this->input->post('username'),
                    'email'=>$this->input->post('username'), // For Where Or Statement
                    'password' => md5($this->input->post('password')),
                    'status' => '1'
                );
                $checkLogin = $this->user->getRows($con);
               //var_dump($checkLogin);
                if($checkLogin){
                    $this->session->set_userdata('userdata', $checkLogin);
                    $user_data = $this->session->userdata('userdata');
                    $this->session->set_userdata('user_name',$user_data['name']);
                    $this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('userId',$checkLogin['id']);

                    if($user_data['is_admin'] == 1){
                        redirect('/dashboard');
                    }else{
                        redirect('/');
                    }

                    
                }else{
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                } 
            }
        }

		$this->body = 'frontend/users/login';
		$this->data = $data;
		$this->renderWithTemplate2();	



       // $this->load->view('frontend/users/login');
    }
    
    /*
     * User registration
     */
    public function registration(){
        $data = array();
        $userData = array();
        if($this->input->post('regisSubmit')){
            $this->form_validation->set_rules('name', 'ชื่อ-นามสกุล', 'required');
            $this->form_validation->set_rules('email', 'อีเมล์', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'confirm password', 'required|matches[password]');

            $this->form_validation->set_rules('card_id', 'หมายเลขบัตรประชาชน', 'required');
            $this->form_validation->set_rules('year_old', 'อายุ', 'required');


            $userData = array(
                'name' => strip_tags($this->input->post('name')),
                'email' => strip_tags($this->input->post('email')),
                'card_id' => strip_tags($this->input->post('card_id')),
                'password' => md5($this->input->post('password')),
                'sex' => $this->input->post('sex'),
                'year_old' => strip_tags($this->input->post('year_old'))
            );

            if($this->form_validation->run() == true){
                $insert = $this->user->insert($userData);
                if($insert){
                    $this->session->set_userdata('success_msg', 'คุณทำการลงทะเบียน สำเร็จเรียบร้อยแล้ว กรุณา login เข้าสู่ระบบ.');
                    redirect('users/login');
                }else{
                    $data['error_msg'] = 'มีบางอย่างผิดพลาด.';
                }
            }
        }
        $data['user'] = $userData;
        //load the view

        $this->body = 'frontend/users/registration';
		$this->data = $data;
		$this->renderWithTemplate2();

       // $this->load->view('frontend/users/registration', $data);
    }
    
    /*
     * User logout
     */
    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('/');
    }
    
    /*
     * Existing email check during validation
     */
    public function email_check($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('email'=>$str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}