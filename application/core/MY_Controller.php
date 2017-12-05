<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
// Set the class variable.
    private $dataTemplate = array();
    public $data = array();
    public $routingCode = 0;
// End Set the class variable.

// Set default variable.
    public $extendedCss = '';
    public $header = '';
    public $body = '';
    public $footer = '';
    public $extendedJs = '';
// End Set default variable.

// Set default condition variable.
    public $useCssTemplate = true;
    public $useJsTemplate = true;
    public $useJsTemplateHeadTag = false;

    public $isBackend = false;
// Set default condition variable.


// public method.
    // ************************************************* Load template *********************************
    protected function renderWithTemplate() {
        // Set default data.
        $this->data['level'] = ( ($this->session->userdata('level')) ? $this->session->userdata('level') : 0 );
        // making temlate and send data to view.
        $this->dataTemplate['useCssTemplate'] = $this->useCssTemplate;
        $this->dataTemplate['useJsTemplate'] = $this->useJsTemplate;
        $this->dataTemplate['useJsTemplateHeadTag'] = $this->useJsTemplateHeadTag;

        $this->dataTemplate['extendedCss'] = ((($this->extendedCss != null) && ($this->extendedCss != ''))
            ? $this->load->view($this->extendedCss, $this->data, true) : '');

        $this->dataTemplate['header'] = ((($this->header != null) && ($this->header != ''))
            ? $this->load->view($this->header, $this->data, true) : '');

        $this->dataTemplate['body'] = ((($this->body != null) && ($this->body != ''))
            ? $this->load->view($this->body, $this->data, true) : '');

        $this->dataTemplate['footer'] = ((($this->footer != null) && ($this->footer != ''))
            ? $this->load->view($this->footer, $this->data, true) : '');

        $this->dataTemplate['extendedJs'] = ((($this->extendedJs != null) && ($this->extendedJs != ''))
            ? $this->load->view($this->extendedJs, $this->data, true) : '');

        if($this->isBackend) {
            // Implement Simple Login Check using simple session for all admin controller.
            if (isset($this->session->userdata['isUserLoggedIn']) && $this->session->userdata['isUserLoggedIn'] == true) {
                $this->load->view('template/admin_template', $this->dataTemplate);
            } else {
                redirect('users/login');
            }
            // $this->load->view('template/admin_template', $this->dataTemplate);
        } else {
            $this->load->view('template/welcome_index', $this->dataTemplate);
        }
    }
    protected function renderWithTemplate3() {
        $this->dataTemplate['extendedCss'] = ((($this->extendedCss != null) && ($this->extendedCss != ''))
            ? $this->load->view($this->extendedCss, $this->data, true) : '');

        $this->dataTemplate['header'] = ((($this->header != null) && ($this->header != ''))
            ? $this->load->view($this->header, $this->data, true) : '');

        $this->dataTemplate['body'] = ((($this->body != null) && ($this->body != ''))
            ? $this->load->view($this->body, $this->data, true) : '');

        $this->dataTemplate['footer'] = ((($this->footer != null) && ($this->footer != ''))
            ? $this->load->view($this->footer, $this->data, true) : '');

        $this->dataTemplate['extendedJs'] = ((($this->extendedJs != null) && ($this->extendedJs != ''))
            ? $this->load->view($this->extendedJs, $this->data, true) : '');

        // Implement Simple Login Check using simple session for all admin controller.
        if (isset($this->session->userdata['isUserLoggedIn']) && $this->session->userdata['isUserLoggedIn'] == true) {
            $this->load->view('template/admin_template', $this->dataTemplate);
        } else {
            redirect('users/login');
        }
    }


    protected function renderWithTemplate2() {
        // Set default data.
        $this->dataTemplate['level'] = ( ($this->session->userdata('level')) ? $this->session->userdata('level') : 0 );
        // making temlate and send data to view.
        $this->dataTemplate['useCssTemplate'] = $this->useCssTemplate;
        $this->dataTemplate['useJsTemplate'] = $this->useJsTemplate;
        $this->dataTemplate['useJsTemplateHeadTag'] = $this->useJsTemplateHeadTag;

        $this->dataTemplate['extendedCss'] = ((($this->extendedCss != null) && ($this->extendedCss != ''))
            ? $this->load->view($this->extendedCss, $this->data, true) : '');

        $this->dataTemplate['header'] = ((($this->header != null) && ($this->header != ''))
            ? $this->load->view($this->header, $this->data, true) : '');

        $this->dataTemplate['body'] = ((($this->body != null) && ($this->body != ''))
            ? $this->load->view($this->body, $this->data, true) : '');

        $this->dataTemplate['footer'] = ((($this->footer != null) && ($this->footer != ''))
            ? $this->load->view($this->footer, $this->data, true) : '');

        $this->dataTemplate['extendedJs'] = ((($this->extendedJs != null) && ($this->extendedJs != ''))
            ? $this->load->view($this->extendedJs, $this->data, true) : '');

        if($this->isBackend) {
            $this->load->view('template/welcome_index', $this->dataTemplate);
        } else {
            $this->load->view('template/welcome_index', $this->dataTemplate);
        }

    }


	// *************************************************** Check logged ********************************
	protected function is_logged() {
            /*
		if(!$this->session->userdata('id')){
			$this->logout();
			return false;
		} else {
                    
			
		}*/
                return true;
	}
	protected function logout() {
        $this->session->sess_destroy();
        redirect("index");
    }
    // **************************************************** End logged *********************************
// End public method.
}