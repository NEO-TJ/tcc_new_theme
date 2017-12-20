<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User Management class created by CodexWorld
 */
class Users extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->model('user');
        session_start(); 
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
        // flash data.
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        // Check submit post.
        if($this->input->post('loginSubmit')){
            $this->form_validation->set_rules('username', 'Username or Email', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == true) {
                /*
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
                */
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
                    $this->validate();
                } else {
                    $data['error_msg'] = 'รหัส captcha ไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
                }
            }else{
                $data['error_msg'] = 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
            }
        }

        // Set data to view file.
        $data['image'] = $this->captcha_setting();

        // Load the view.
        $this->data = $data;
		$this->body = 'frontend/users/login';
        $this->extendedJs = 'frontend/users/extendedJs_v';
		$this->renderWithTemplate();
    }
    
    /*
     * User registration
     */
    public function registration(){
        $data = array();
        $userData = array();
        // flash data.
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        // Check submit post.
        if($this->input->post('regisSubmit')){
            $this->form_validation->set_rules('First_Name', 'ชื่อ', 'required');
            $this->form_validation->set_rules('Email', 'อีเมล์', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('Password', 'password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'confirm password', 'required|matches[Password]');

            $this->form_validation->set_rules('Last_Name', 'นามสกุล', 'required');
            $this->form_validation->set_rules('Age', 'อายุ', 'required');

            $this->load->model("dataclass/users_d");
            $userData = array(
                $this->users_d->colEmail        => strip_tags($this->input->post('Email')),
                $this->users_d->colPassword     => strip_tags($this->input->post('Password')),
                $this->users_d->colFirstName    => strip_tags($this->input->post('First_Name')),
                $this->users_d->colLastName     => strip_tags($this->input->post('Last_Name')),
                $this->users_d->colGender       => $this->input->post('Gender'),
                $this->users_d->colAge          => strip_tags($this->input->post('Age')),
                $this->users_d->colLevel        => 4,
                $this->users_d->colStatus       => 1,
            );

            if($this->form_validation->run() == true){
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
                    $this->load->model("userAuthentication_m");
                    $result = $this->userAuthentication_m->Save(null, $userData);
                    if($result) {
                        $this->session->set_userdata('success_msg'
                        , 'คุณทำการลงทะเบียน สำเร็จเรียบร้อยแล้ว กรุณา login เข้าสู่ระบบ.');
                        redirect('users/login');
                    }else{
                        $data['error_msg'] = 'มีบางอย่างผิดพลาด โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
                    }
                } else {
                    $data['error_msg'] = 'รหัส captcha ไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
                }
            }
        }

        // Set data to view file.
        $data['image'] = $this->captcha_setting();
        $data['user'] = $userData;

        // Load the view.
		$this->data = $data;
        $this->body = 'frontend/users/registration';
		$this->renderWithTemplate();
    }
    

    /*
     * User edit profile
     */
    public function profile(){
        if(!($this->is_logged())) {exit(0);}
        $data = array();
        $userData = array();
        // flash data.
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        // Check submit post.
        if($this->input->post('editSubmit')){
            $this->form_validation->set_rules('First_Name', 'ชื่อ', 'required');
            $this->form_validation->set_rules('Password', 'password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'confirm password', 'required|matches[Password]');

            $this->form_validation->set_rules('Last_Name', 'นามสกุล', 'required');
            $this->form_validation->set_rules('Age', 'อายุ', 'required');

            $this->load->model("dataclass/users_d");
            $userData = array(
                $this->users_d->colEmail        => strip_tags($this->input->post('Email')),
                $this->users_d->colFirstName    => strip_tags($this->input->post('First_Name')),
                $this->users_d->colLastName     => strip_tags($this->input->post('Last_Name')),
                $this->users_d->colGender       => $this->input->post('Gender'),
                $this->users_d->colAge          => strip_tags($this->input->post('Age')),
            );

            if($this->form_validation->run() == true){
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
                    $userData[$this->users_d->colPassword] = strip_tags($this->input->post('Password'));
                    unset($userData[$this->users_d->colEmail]);

                    $this->load->model("userAuthentication_m");
                    $result = $this->userAuthentication_m->Save($this->session->userdata['id'], $userData);
                    
                    if($result) {
                        $dsProfile = $this->userAuthentication_m->GetProfile($this->session->userdata['id']);
                        $userData = ((count($dsProfile) > 0) ? $dsProfile[0] : NULL);
                        $data['success_msg'] = 'คุณทำการแก้ไขข้อมูลส่วนตัว เรียบร้อยแล้ว.';
                    }else{
                        $data['error_msg'] = 'มีบางอย่างผิดพลาด โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
                    }
                } else {
                    $data['error_msg'] = 'รหัส captcha ไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
                }
            }
        } else {
            $this->load->model("userAuthentication_m");
            $dsProfile = $this->userAuthentication_m->GetProfile($this->session->userdata['id']);
            $userData = ((count($dsProfile) > 0) ? $dsProfile[0] : NULL);
        }

        // Set data to view file.
        $data['image'] = $this->captcha_setting();
        $data['user'] = $userData;

        // Load the view.
        $this->data = $data;
        $this->body = 'frontend/users/profile';
		$this->renderWithTemplate();
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
        $this->load->model("userAuthentication_m");
        $checkEmail = $this->userAuthentication_m->ChkEmailDup($str);

        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }



    // Private function.
    public function validate() {
		$this->load->model('userAuthentication_m');
		// get data from db
        $this->userAuthentication_m->userId = $this->input->post('username');
		$this->userAuthentication_m->password = $this->input->post('password');
		$user = $this->userAuthentication_m->Validate();

		if(count($user) > 0) {
            $data = array();
			foreach ($user as $u) {
				$data['id']		= $u['id'];
				$data['userId']	= $u['UserId'];
                $data['level']	= $u['Level'];
                $data['isUserLoggedIn'] = TRUE;
                $data['user_name'] = $u['First_Name'];
			}
			// set data to session
			$this->session->set_userdata($data);

			//check level user
			switch ($data['level']) {
				case '1':
					// redirect page to backend page
					redirect("/iccCard");
					break;
				case '2':
					// redirect page to backend page
					redirect("/iccCard");
					break;
				case '3':
					// redirect page to backend page
					redirect("/iccCard");
					break;
				default:
					// redirect page to user page
					redirect("/");
					break;
			}
		} else {
            $data['error_msg'] = 'Wrong email or password, please try again.';
            // redirect with session msessage
			//$this->session->set_flashdata('msg',  'ข้อมูลไม่ถูกต้องกรุณาลองใหม่อีกครั้ง');
			//header('Location: ../');
        }
    }

    // This function genrate CAPTCHA image and store in "image folder".
    public function captcha_setting($imgWidth=280){
        $values = array(
            'word' => '',
            'word_length' => 5,
            'img_path' => './assets/images/captcha/',
            'img_url' =>  base_url() .'assets/images/captcha/',
            'font_path'  => base_url() . 'system/fonts/texb.ttf',
            'img_width' => $imgWidth,
            'img_height' => 50,
            'expiration' => 3600
        );
        $data = create_captcha($values);
        $_SESSION['captchaWord'] = $data['word'];

        // image will store in "$data['image']" index and its send on view page
        return $data['image'];
    }

    // For new image on click refresh button.
    public function captcha_refresh(){
        $values = array(
            'word' => '',
            'word_length' => 8,
            'img_path' => './assets/images/captcha/',
            'img_url' =>  base_url() .'assets/images/captcha/',
            'font_path'  => base_url() . 'system/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 50,
            'expiration' => 3600
        );
        $data = create_captcha($values);
        $_SESSION['captchaWord'] = $data['word'];
        echo $data['image'];
    }
    // End private function.
}