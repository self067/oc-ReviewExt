<?php
class ControllerToolReviewext extends Controller {

public function index() {
			$this->load->language('tool/upload');

			$json = array();

			if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

				// Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
					$json['error'] = $this->language->get('error_filename');
				}

        // Allowed file extension types
				$allowed = array();

				$extension_allowed = 'png,jpe,jpeg,jpg,gif';

				$filetypes = explode(",", $extension_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Allowed file mime types
				$allowed = array();

				$mime_allowed = 'image/png,image/jpeg,image/gif';

				$filetypes = explode(",", $mime_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($this->request->files['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Return any upload error
				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}

			if (!$json) {
				$folder = DIR_IMAGE . 'reviews/';
				$file = token(32) . $filename;

				move_uploaded_file($this->request->files['file']['tmp_name'], $folder . $file);

        // $this->load->model('catalog/reviewext');
        $this->load->model('tool/upload');

        // write to oc_upload
        $json['code'] = $this->model_tool_upload->addUpload($filename, $file);

				// $this->load->model('tool/reviewext');
				// $preview = $this->model_tool_reviewext->resize($file, $folder);
				
				// if ($result) {
        if ($json['code']) {
          
					// $json['file'] = $result;
          $json['file'] = 'reviews/' . $file;
          $json['preview'] = 'reviews/' . $file;
          
					$json['success'] = $this->language->get('text_upload');
				} else {
					$json['error'] = $this->language->get('error_upload');
				}
			}

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
	}
}
