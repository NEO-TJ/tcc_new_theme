<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventImageAdmin extends MY_Controller {

// Constructor.
	function __construct() {
		parent::__construct();
		$this->isBackend = true;
	}
// End Constructor.



// Method start.
	public function index() {
		$this->overallThumpnailImage();
	}	
// End Method start.


// Routing function.
	private function overallThumpnailImage() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$iccCardId = $this->input->post('iccCardId');

			// Prepare data of view.
			$this->data = $this->GetDataForRenderMainPage($iccCardId);
	
			// Prepare Template.
			$this->RenderPage();
		}
	}

	public function uploadImage() {
		if(!($this->is_logged())) {exit(0);}
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$iccCardId = $this->input->post('iccCardId');

			$this->uploadImageAndCreateThumpnail($iccCardId);
			redirect(base_url('eventImageAdmin/dpm/' . $iccCardId));
		}
	}

	public function dpm() {
		if(!($this->is_logged())) {exit(0);}

		$data['iccCardId'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->load->view("backend/eventImageAdmin/dummyPostMethod_v", $data);
	}
// End Routing function.


// AJAX function.
	// ---------------------------------------------------------------------------------------- Delete files from disk and DB.
	public function ajaxDeleteImage() {
		if(!($this->is_logged())) {exit(0);}

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$resultThumb = FALSE;
			$resultOriginal = FALSE;
			$rResult["response"] = 0;
			$rResult["htmlTable"] = "";

			$iccCardId = $this->input->post('iccCardId');
			$eventImageId = $this->input->post('eventImageId');
			$fileName = $this->input->post('fileName');
			$pathFileThumb = './uploads/Event_Images/thumbs/' . $fileName;
			$pathFileOriginal = './uploads/Event_Images/' . $fileName;

			// Check file exist or not : thumb
			if(file_exists($pathFileThumb)) {
				unlink($pathFileThumb);
				$resultThumb = !file_exists($pathFileThumb);
			} else {
				$resultThumb = TRUE;
			}

			// Check file exist or not : original
			if(file_exists($pathFileOriginal)) {
				unlink($pathFileOriginal);
				$resultOriginal = !file_exists($pathFileOriginal);
			} else {
				$resultOriginal = TRUE;
			}

			if($resultThumb && $resultOriginal) {
				$this->load->model("eventImage_m");

				if($this->eventImage_m->InactiveImage($eventImageId)) {
					// Generate html table.
					$data['dsImage'] = $this->eventImage_m->GetDsEventImage($iccCardId);
		
					$rResult["htmlTable"] = $this->load->view("backend/eventImageAdmin/bodyTableImage_v", $data, TRUE);
					$rResult["response"] = 1;
				}
			}

			echo json_encode($rResult);
		}
	}
// End AJAX function.





// Private function.
	private function GetDataForRenderMainPage($iccCardId=null) {
		$this->load->model("eventImage_m");
		$data['dsImage'] = $this->eventImage_m->GetDsEventImage($iccCardId);

		$dsIccCard = $this->eventImage_m->GetDsIccCard($iccCardId);
		$data['iccCardId'] = $iccCardId;
		$data['dsIccCard'] = $dsIccCard;

		return $data;
	}

	private function uploadImageAndCreateThumpnail($iccCardId=null) {
		$result = FALSE;
		$this->load->model("eventImage_m");

		// Upload multiply.
		if(isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] != '4') {
			$files = $_FILES;
			$count = count($_FILES['imageFile']['name']); // count element 
			for($i=0; $i<$count; $i++) {
			// Change to new file name with existing extension file.	microtime(true)
				$newFilename = "project-" . $iccCardId . "_" . date("ymd-Hisu") . "."
					. pathinfo(parse_url($files['imageFile']['name'][$i])['path'], PATHINFO_EXTENSION);
				$files['imageFile']['name'][$i] = $newFilename;
			// Initial file obj.
				$_FILES['imageFile']['name']= $files['imageFile']['name'][$i];
				$_FILES['imageFile']['type']= $files['imageFile']['type'][$i];
				$_FILES['imageFile']['tmp_name']= $files['imageFile']['tmp_name'][$i];
				$_FILES['imageFile']['error']= $files['imageFile']['error'][$i];
				$_FILES['imageFile']['size']= $files['imageFile']['size'][$i];
			// Initial path file&folder.
				$config['upload_path'] = './uploads/Event_Images/';
				$target_path = './uploads/Event_Images/thumbs/';
			// Config file type, size save method.
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '20000'; //limit 1 mb
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				$config['max_width'] = '2560';// image max width 
				$config['max_height'] = '1440';
			// Push Config to library.
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
			// Upload file.
				$resultUpload = $this->upload->do_upload('imageFile');
			// Validate upload file.
				if(!$resultUpload) {
				// Can't upload file : send UI for inform user.
					$error = array('upload_error' => $this->upload->display_errors());
					$this->session->set_flashdata('error',  $error['upload_error']); 
					echo $files['imageFile']['name'][$i].' '.$error['upload_error']; exit;
				} else {
				// Success upload file : Prepare upload file info for insert to database.
					$fileName = $this->upload->file_name;

					$data = array('upload_data' => $this->upload->data()); 
			// Thumnail : Resize Image.
				// Thumpnail : Initial path file&folder.
					$path = $data['upload_data']['full_path'];
					$q['name'] = $data['upload_data']['file_name'];
				// Thumpnail : Config file type, size save method.
					$configi['image_library'] = 'gd2';
					$configi['source_image'] = $path;
					$configi['new_image'] = $target_path;
					$configi['maintain_ratio'] = TRUE;
					$configi['width'] = 120; // new size
					$configi['height'] = 120;
				// Thumpnail : Push Config to library.
					$this->load->library('image_lib');
					$this->image_lib->initialize($configi);
				// Thumpnail : Resize file.
					$this->image_lib->resize();

				// Save info to.
					$image_upload = array('priority' => 0, 'FK_ICC_Card' => $iccCardId, 'image_URL' => $fileName);
					$resutl = $this->eventImage_m->AddNewImage($image_upload);
				}
			}
		}

		return $result;
	}

	private function RenderPage() {
		// Prepare Template.
		$this->extendedCss = 'backend/eventImageAdmin/extendedCss_v';
		$this->body = 'backend/eventImageAdmin/body_v';
		$this->extendedJs = 'backend/eventImageAdmin/extendedJs_v';
		$this->renderWithTemplate();
	}
// End Private function.
}