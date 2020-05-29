<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Controller
 * Base class for all custom controller of the project
 *
 * @property CI_DB_query_builder $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Hooks $hooks
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Table $table
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Validation $validation
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 */
class MY_Controller extends CI_Controller {

    /**
     * Detect Ajax request
     * @var bool 
     */
    protected $isAjaxRequest;

    /**
     * Detect if admin is logged in or not
     * @var bool 
     */
    protected $isAdmin = false;

    /**
     * Detect if admin is logged in or not
     * @var bool 
     */
    protected $isApiCall = false;

    /**
     * Hold array of data to pass in CI view 
     * 
     * @var array 
     */
    protected $data;
    protected $requestMethod;
    protected $getParams;
    protected $headers;
    protected $json;
    protected $result;
    protected $tokenPayload;
    protected $token = NULL;

    function __construct() {
        parent::__construct();

        if (strtolower($this->router->fetch_directory()) == 'rest') {
            $this->isApiCall = true;

            $this->headers = $this->input->request_headers();
            $this->getParams = $this->input->get();
            $this->load->model('M_api');
            // Request JSON.
            $this->requestMethod = $this->input->method(TRUE);
            if (in_array($this->requestMethod, array('POST', 'PUT', 'DELETE'))) {
                $this->data = $this->input->raw_input_stream;
                $this->json = json_decode($this->data);

                if (!empty($this->data) && is_null($this->json)) {
                    throw new Api_Exception(Result_code::INVALID_JSON, "Invalid JSON: $data");
                }
            }

            $this->token = $this->input->get_request_header(self::HEADER_SESSION_ID_KEY, TRUE);
        } else {

            // Check ajax request
            $this->isAjaxRequest = $this->input->is_ajax_request();

            // Check admin is logged in or not
            if ($this->session->has_userdata('userId') && $this->session->userdata('userId') > 0) {
                $this->isAdmin = true;

                $this->data = [
                    'userData' => [
                        'id' => $this->session->userdata('userId'),
                        'username' => $this->session->userdata('username'),
                        'email' => $this->session->userdata('email')
                    ]
                ];
            } else {
                $this->isAdmin = false;
            }
        }
    }

    /**
     * This function Initialize all basic parameters 
     * which are to be passed in view page
     * 
     * @param string $viewPage Page name inside codeIgniter view template
     * @param string $pageTitle Page title for the web page in the browser
     * @param string $activeMenu Status of menu which is currently active
     */
    protected function processViewData($viewPage, $pageTitle, $activeMenu = null) {

        $this->data['mainView'] = $viewPage;
        $this->data['pageTitle'] = $pageTitle;
        $this->data['activeMenu'] = $activeMenu;
        $this->data['isAdmin'] = $this->isAdmin;

        $this->load->view(THEMES_TEMPLATE, $this->data);
    }

    /**
     * Image upload process
     * 
     * @param string $fileField Form file input field name 
     * @param sring $uploadPath File upload path string
     * @return mixed Uploaded image name, boolean false otherwise 
     */
    protected function processFileUpload($fileField, $uploadPath, $image = true) {

        /**
         * Check if upload path is working or not
         */
        if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0775, true)) {
                $this->session->set_flashdata('error', 'Error! Permission denied in upload path!');
            }
        } else {
            if (!is_writable($uploadPath)) {
                $this->session->set_flashdata('error', 'Error! Upload path is not writable, permission denied!');
            }
        }

        $imageName = '';
        if (file_exists($_FILES[$fileField]['tmp_name']) || is_uploaded_file($_FILES[$fileField]['tmp_name'])) {
            $fileName = '';
            if ($image) {
                /**
                 * Process image upload
                 */
                $imageInfo = getimagesize($_FILES[$fileField]['tmp_name']);
                $fileName = 'img' . rand(0, 5) . '-' . time() . image_type_to_extension($imageInfo[2]);
                $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
                $config['max_size'] = 2048;
                $config['min_width'] = 400;
                $config['min_height'] = 400;
                $config['overwrite'] = true;
                $config['file_name'] = $fileName;
                $config['upload_path'] = $uploadPath;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($fileField)) {

                    $this->session->set_flashdata('error', 'Error! ' . $this->upload->display_errors());
                    return false;
                }
            }
            return $fileName;
        } else {
            $this->session->set_flashdata('error', 'Error! Uploaded file not found!');
        }

        return false;
    }

}
