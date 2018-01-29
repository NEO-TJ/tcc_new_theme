<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends MY_Controller {
// Member.
    private $formValidateSetMessage;
// End Member.

// Constructor.
    function __construct() {
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->library('form_validation');
        $this->load->model('user');
        session_start(); 
    }
// End Constructor.



// Route method.
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
            $this->form_validation->set_rules('Last_Name', 'นามสกุล', 'required');
            $this->form_validation->set_rules('Age', 'อายุ', 'required');

            $this->load->model("dataclass/users_d");
            $userData = array(
                $this->users_d->colFirstName    => strip_tags($this->input->post('First_Name')),
                $this->users_d->colLastName     => strip_tags($this->input->post('Last_Name')),
                $this->users_d->colGender       => $this->input->post('Gender'),
                $this->users_d->colAge          => strip_tags($this->input->post('Age')),
            );

            if($this->form_validation->run() == true){
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
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
        $data['image'] = $this->createCaptcha();
        $data['user'] = $userData;

        // Load the view.
        $this->data = $data;
        $this->body = 'frontend/users/profile_v';
        $this->extendedJs = 'frontend/users/extendedJs_v';
		$this->renderWithTemplate();
    }
    
    public function login(){
        $data = array();
        // flash data.
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('info_msg')){
            $data['info_msg'] = $this->session->userdata('info_msg');
            $this->session->unset_userdata('info_msg');
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
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
                    $data['error_msg'] = $this->userValidate(
                        $this->input->post('username'), $this->input->post('password'));
                } else {
                    $data['error_msg'] = 'รหัส captcha ไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
                }
            }else{
                $data['error_msg'] = 'อีเมล์หรือรหัสผ่านไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้ง';
            }
        }

        // Set data to view file.
        $data['image'] = $this->createCaptcha();

        // Load the view.
        $this->data = $data;
		$this->body = 'frontend/users/login_v';
        $this->extendedJs = 'frontend/users/extendedJs_v';
		$this->renderWithTemplate();
    }
    
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
            $this->form_validation->set_rules('Email', 'อีเมล์', 'required|valid_email|callback_emailChkDup');
            $this->form_validation->set_rules('Password', 'password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'confirm password', 'required|matches[Password]');

            $this->form_validation->set_rules('Last_Name', 'นามสกุล', 'required');
            $this->form_validation->set_rules('Age', 'อายุ', 'required');

            $this->load->model("dataclass/users_d");
            $userData = array(
                $this->users_d->colUserId       => strip_tags($this->input->post('Email')),
                $this->users_d->colPassword     => strip_tags($this->input->post('Password')),
                $this->users_d->colEmail        => strip_tags($this->input->post('Email')),
                $this->users_d->colFirstName    => strip_tags($this->input->post('First_Name')),
                $this->users_d->colLastName     => strip_tags($this->input->post('Last_Name')),
                $this->users_d->colGender       => $this->input->post('Gender'),
                $this->users_d->colAge          => strip_tags($this->input->post('Age')),
                $this->users_d->colLevel        => userLevel::Volunteer,
                $this->users_d->colStatus       => userStatus::Inactive,
            );

            if($this->form_validation->run() == true){
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
                    $this->load->model("userAuthentication_m");
                    $resultSaveNewUser = $this->userAuthentication_m->Save(null, $userData);

                    if($resultSaveNewUser) {
                        if($this->sendEmailActivateUser($this->input->post('Email'))){
                            $this->session->set_userdata('success_msg'
                                , 'ระบบได้ทำการลงทะเบียนสมาชิกใหม่เรียบร้อยแล้ว<br>'
                                . 'ทางเราได้จัดส่งอีเมล์เพื่อยีนยันการสมัครไปยังที่อยู่อีเมล์ที่คุณลงทะเบียนไว้แล้ว<br>'
                                . 'กรุณายืนยันการสมัครจากอีเมล์ที่ทางเราส่งให้ เพื่อดำเนินการสมัครสมาชิกอย่างสมบูรณ์<br>'
                                . 'ขอบคุณคะ'
                            );
                            redirect('users/login');
                        } else {
                            $data['error_msg'] = 'ระบบส่ง Email ผิดพลาด<br>'
                                . 'กรุณาลองใหม่อีกครั้งคะ';
                        }
                    }else{
                        $data['error_msg'] = 'เกิดข้อผิดพลาดในการบันทึกข้อมูลเข้าสู่ระบบ โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้งคะ';
                    }
                } else {
                    $data['error_msg'] = 'รหัส captcha ไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้งคะ';
                }
            } else {
                $data['error_msg'] = $this->formValidateSetMessage;
            }
        }

        // Set data to view file.
        $data['image'] = $this->createCaptcha();
        $data['user'] = $userData;

        // Load the view.
		$this->data = $data;
        $this->body = 'frontend/users/registration_v';
        $this->extendedJs = 'frontend/users/extendedJs_v';
		$this->renderWithTemplate();
    }
    
    public function forgotPassword() {
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
        if($this->input->post('forgotPasswordSubmit')){
            $this->form_validation->set_rules('Email', 'อีเมล์', 'required|valid_email|callback_emailChkReset');

            if($this->form_validation->run() == true){
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
                    $this->load->model("userAuthentication_m");
                    $this->load->model('helper_m');
                    $email = strip_tags($this->input->post('Email'));
                    $newPassword = $this->helper_m->random_str(8);
                    $resultResetPassword = $this->userAuthentication_m->ResetPassword($email, $newPassword);

                    if($resultResetPassword) {
                        if($this->sendEmailResetPassword($email, $newPassword)){
                            $data['success_msg'] = 'ทางเราได้ส่งรหัสผ่านใหม่ผ่านไปยังอีเมล์ที่คุณลงทะเบียนไว้แล้ว<br>'
                                . 'กรุณาตรวจสอบ email ของท่าน และนำรหัสผ่านใหม่ที่ได้รับทางอีเมล์<br>'
                                . 'มาใช้ในการเข้าสู่ระบบสมาชิกของเวปไซต์ได้แล้วคะ ขอบคุณคะ';
                        } else {
                            $data['error_msg'] = 'เกิดเหตุขัดข้องในการส่ง Email<br>'
                                . 'กรุณาลองใหม่อีกครั้งคะ';
                        }
                    } else {
                        $data['error_msg'] = 'ระบบไม่สามารถรีเซ็ตรหัสผ่านได้, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้งคะ';
                    }
                } else {
                    $data['error_msg'] = 'รหัส captcha ไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้งคะ';
                }
            } else {
                $data['error_msg'] = $this->formValidateSetMessage;
            }
        }

        // Set data to view file.
        $data['image'] = $this->createCaptcha();

        // Load the view.
        $this->data = $data;
		$this->body = 'frontend/users/forgotPassword_v';
        $this->extendedJs = 'frontend/users/extendedJs_v';
		$this->renderWithTemplate();
    }


    public function confirmEmail($hashcode){
        $this->load->model('userAuthentication_m');
        $userStatus = $this->userAuthentication_m->verifyEmail($hashcode);

        // flash data.
        if($userStatus == userStatus::Active){
            $this->session->set_userdata('success_msg', 'อีเมล์ของท่านได้รับการยืนยันในระบบเรียบร้อยแล้ว<br>ท่านสามารถเข้าสู่ระบบได้');
        }else if($userStatus == userStatus::Locked){
            $this->session->set_userdata('error_msg', 'อีเมล์นี้ถูกระงับการใช้งานชั่วคราว<br>โปรดติดต่อผู้ดูแลเวปไซต์');
        }else{
            $this->session->set_userdata('error_msg', 'เกิดความผิดพลาดในการยืนยันรหัสผู้ใช้งาน<br>โปรดติดต่อผู้ดูแลเวปไซต์');
        }

        redirect('users/login');
    }

    public function resetPassword($hashcode){
        $this->load->model('userAuthentication_m');
        $userStatus = $this->userAuthentication_m->verifyEmail($hashcode);

        // flash data.
        if($userStatus == userStatus::Active){
            $this->session->set_userdata('success_msg', 'ระบบได้ทำการรีเซ็ตรหัสผ่านเรียบร้อยแล้ว<br>ท่านสามารถเข้าสู่ระบบได้ปรกติ');
        }else if($userStatus == userStatus::Locked){
            $this->session->set_userdata('error_msg', 'อีเมล์นี้ถูกระงับการใช้งานชั่วคราว<br>โปรดติดต่อผู้ดูแลเวปไซต์');
        }else{
            $this->session->set_userdata('error_msg', 'เกิดความผิดพลาดในการรีเซ็ตรหัสผ่าน<br>โปรดติดต่อผู้ดูแลเวปไซต์');
        }

        redirect('users/login');
    }


        
    public function changePassword() {
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
        if($this->input->post('changePasswordSubmit')){
            $this->form_validation->set_rules('old_password', 'old password', 'required');
            $this->form_validation->set_rules('new_password', 'new password', 'required');
            $this->form_validation->set_rules('password_confirmation', 'confirm password', 'required|matches[new_password]');

            if($this->form_validation->run() == true){
                if (strcasecmp($_SESSION['captchaWord'], $_POST['captcha']) == 0) {
                    $this->load->model("userAuthentication_m");
                    $oldPassword = strip_tags($this->input->post('old_password'));
                    $newPassword = strip_tags($this->input->post('new_password'));

                    $dsUser = $this->userAuthentication_m->Validate(
                        $this->session->userdata('userId')
                        , $oldPassword);
                    $countUser = count($dsUser);
                    if($countUser == 1) {
                        $user = $dsUser[0];
                        if($user['Status'] == 0) {
                            $data['error_msg'] = 'รหัสสมาชิกนี้ยังไม่ถูกเปิดให้ใช้งาน<br>'
                            . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
                        } else if($user['Status'] == 1) {
                            if($this->userAuthentication_m->ChangePassword($user['id'], $newPassword)){
                                $this->session->sess_destroy();
                                redirect('users/login');
                            } else {
                                $data['error_msg'] = 'ไม่สามารถเปลี่ยนรหัสผ่านได้<br>'
                                    . 'กรุณาลองใหม่อีกครั้งคะ';
                            }    
                        } else if($user['Status'] == 2) {
                            $data['error_msg'] = 'รหัสสมาชิกนี้อยู่ในสถานะ รอการยืนยันตัวตน<br>'
                            . 'กรุณาตรวจสอบอีเมล์ที่ท่านลงทะเบียนใว้และทำการยืนยันตามข้อมูลที่แจ้งไว้ในอีเมล์ของท่าน';
                        } else if($user['Status'] == 3) {
                            $data['error_msg'] = 'รหัสสมาชิกนี้อยู่ในสถานะถูกล๊อคจากระบบ<br>'
                            . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
                        } else {
                            $data['error_msg'] = 'เกิดข้อขัดข้องกับรหัสสมาชิกในระบบ<br>'
                            . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
                        }
                    } else if($countUser > 1) {
                        $data['error_msg'] = 'เกิดความซ้ำซ้อนของรหัสสมาชิกนี้ในระบบ<br>'
                            . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
                    } else {
                        $data['error_msg'] = 'รหัสผ่านของท่านไม่ถูกต้อง<br>'
                            . 'โปรดตรวจสอบรหัสผ่านของท่านและลองใหม่อีกครั้ง';
                    }
                } else {
                    $data['error_msg'] = 'รหัส captcha ไม่ถูกต้อง, โปรดตรวจสอบข้อมูลและลองใหม่อีกครั้งคะ';
                }
            }
        }

        // Set data to view file.
        $data['image'] = $this->createCaptcha();

        // Load the view.
        $this->data = $data;
		$this->body = 'frontend/users/changePassword_v';
        $this->extendedJs = 'frontend/users/extendedJs_v';
		$this->renderWithTemplate();
    }

    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('/');
    }
// End Route method.


// AJAX method.
    public function captchaRefresh($imgWidth=280){
        $result = $this->generateCaptcha(280);

        echo $result;
    }
// End AJAX method.

// Private function.
    // ---------- Validate User.
    private function userValidate($userName, $password) {
		$this->load->model('userAuthentication_m');
        $result = '';
		// get data from db
        $dsUser = $this->userAuthentication_m->Validate($userName, $password);
        $countUser = count($dsUser);

		if($countUser == 1) {
            $user = $dsUser[0];
            if($user['Status'] == 0) {
                $result = 'รหัสสมาชิกนี้ยังไม่ถูกเปิดให้ใช้งาน<br>'
                . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
            } else if($user['Status'] == 1) {
                $data = array(
                    'id'                => $user['id'],
                    'userId'            => $user['UserId'],
                    'level'             => $user['Level'],
                    'isUserLoggedIn'    => TRUE,
                    'user_name'         => $user['First_Name'],
                );

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
            } else if($user['Status'] == 2) {
                $result = 'รหัสสมาชิกนี้อยู่ในสถานะ รอการยืนยันตัวตน<br>'
                . 'กรุณาตรวจสอบอีเมล์ที่ท่านลงทะเบียนใว้และทำการยืนยันตามข้อมูลที่แจ้งไว้ในอีเมล์ของท่าน';
            } else if($user['Status'] == 3) {
                $result = 'รหัสสมาชิกนี้อยู่ในสถานะถูกล๊อคจากระบบ<br>'
                . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
            } else {
                $result = 'เกิดข้อขัดข้องกับรหัสสมาชิกในระบบ<br>'
                . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
            }
        } else if($countUser > 1) {
            $result = 'เกิดความซ้ำซ้อนของรหัสสมาชิกนี้ในระบบ<br>'
                . 'กรุณาติดต่อเจ้าหน้าที่ที่เกี่ยวข้อง';
		} else {
            $result = 'อีเมล์ หรือ รหัสผ่านของท่านไม่ถูกต้อง<br>'
                . 'โปรดตรวจสอบอีเมล์หรือรหัสผ่านของท่านและลองใหม่อีกครั้ง';
        }

        return $result;
    }
    // ---------- End Validate User.



    // ---------- Send Email.
    private function sendEmailActivateUser($emailReceiver) {
        $this->load->library('email');
        $urlConfirmEmail = base_url('Users/confirmEmail') . '/';

        $subject = 'ยืนยันการลงทะเบียน สมาชิกเวป thaicoastalcleanup';
        $message = 'เรียน ท่านสมาชิก,<br><br> เพื่อความสมบูรณ์ในการสมัครสมาชิก โปรดคลิ๊กปุ่ม activation ด้านล่างนี้เพื่อยืนยันการสมัครสมาชิก<br><br>'
        . '<a href=' . $urlConfirmEmail
        . md5($emailReceiver) . '>' . $urlConfirmEmail
        . md5($emailReceiver) .'</a><br><br>ขอบคุณค่ะ';

        $result = $this->email
            ->from('dmcrtccmaster@gmail.com')
            ->to($emailReceiver)
            ->subject($subject)
            ->message($message)
            ->send();

        return $result;
    }

    private function sendEmailResetPassword($emailReceiver, $newPassword) {
        $this->load->library('email');
        $urlConfirmEmail = base_url('Users/resetPassword') . '/';

        $subject = 'รหัสผ่านใหม่สำหรับการเข้าใช้งานในระบบสมาชิกของเวปไซต์ thaicoastalcleanup';
        $message = 'เรียน ท่านสมาชิก,<br><br> เนื่องจากท่านได้ทำการรีเซ็ตรหัสผ่านใหม่ที่เวปไซต์ thaicoastalcleanup'
            . 'ทางเวปไซต์จึงได้ทำการส่งรหัสผ่านใหม่ เพื่อนำไปใช้ในการเข้าระบบสมาชิกของเวปไซต์ตามข้อมูลด้านล่างนี้<br><hr>'
            . 'รหัสผ่านใหม่ = ' . $newPassword . '<hr><br>'
            . 'โปรดคลิ๊กปุ่ม activation ด้านล่างนี้ เพื่อกลับสู่เวปไซต์ thaicoastalcleanup<br><br>'
            . '<a href=' . $urlConfirmEmail
            . md5($emailReceiver) . '>' . $urlConfirmEmail
            . md5($emailReceiver) .'</a><br><br>ขอบคุณค่ะ';

        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'
        . ' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset='
            . strtolower(config_item('charset')) . '" />
            <title>' . html_escape($subject) . '</title>
            <style type="text/css">
                body {
                    font-family: Arial, Verdana, Helvetica, sans-serif;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
        ' . $message . '
        </body>
        </html>';

        $result = $this->email
            ->from('dmcrtccmaster@gmail.com')
            ->to($emailReceiver)
            ->subject($subject)
            ->message($body)
            ->send();

        return $result;
    }
    // ---------- End Send Email.


    // ---------- Email Validate.
    public function emailChkDup($email){
        $this->load->model("userAuthentication_m");
        $blnResult = $this->userAuthentication_m->ChkEmailDup($email);

        if($blnResult){
            $this->formValidateSetMessage = 'อีเมล์นี้มีอยู่ในระบบแล้ว';
            return FALSE;
        } else {
            $this->formValidateSetMessage = '';
            return TRUE;
        }
    }

    public function emailChkReset($email){
        $this->load->model("userAuthentication_m");
        $blnResult = $this->userAuthentication_m->ChkEmailExist($email);

        if($blnResult){
            $this->load->model("dataclass/users_d");
            $userStatus = $this->userAuthentication_m->status;
            
            if(($userStatus == userStatus::Active) || ($userStatus == userStatus::Inactive)) {
                $this->formValidateSetMessage = '';
                return TRUE;
            } else if($userStatus == userStatus::Locked) {
                $this->formValidateSetMessage = 'อีเมล์นี้ถูกระงับการใช้งานชั่วคราว<br>โปรดติดต่อผู้ดูแลเวปไซต์';
                return FALSE;
            } else {
                $this->formValidateSetMessage = 'เกิดความผิดพลาดในการรีเซ็ตรหัสผ่าน<br>โปรดติดต่อผู้ดูแลเวปไซต์';
                return FALSE;
            }
        } else {
            $this->formValidateSetMessage = 'อีเมล์นี้ยังไม่มีอยู่ในระบบ';
            return FALSE;
        }
    }
    // ---------- End Email Validate.



    // ---------- Captcha management.
    private function createCaptcha($imgWidth=280){
        $result = $this->generateCaptcha(280);

        return $result;
    }

    private function generateCaptcha($imgWidth=280) {
        $values = array(
            'word' => '',
            'word_length' => 5,
            'img_path' => './assets/images/captcha/',
            'img_url' =>  base_url() .'assets/images/captcha/',
            'font_path'  => FCPATH . 'assets/fonts/VERDANA.TTF',
            'img_width' => $imgWidth,
            'img_height' => 50,
            'expiration' => 7200
        );
        $rCaptcha = create_captcha($values);
        $_SESSION['captchaWord'] = $rCaptcha['word'];

        // image will store in "$rCaptcha['image']" index and its send on view page
        return $rCaptcha['image'];
    }
    // ---------- End Captcha management.
// End private function.
}