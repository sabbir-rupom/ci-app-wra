<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Authentication Controller Class
 * 
 * @property M_User $mu of User Model Class
 * @property M_LogUserLogin $ml of User Login Log Model Class
 */
class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();

        /**
         * Load necessary model class
         */
        $this->load->model('M_User', 'mu');
        $this->load->model('M_LogUserLogin', 'ml');
    }

    public function index() {
        $this->login();
    }

    /**
     * Method to view and validate login credential
     */
    public function login() {

        if ($this->isAdmin) {
            /**
             * If admin is logged in, redirect him to dashboard by default
             */
            redirect('admin/dashboard');
        }

        if ($this->input->method(TRUE) == 'POST') {
            if ($this->_processLogin()) {
                /**
                 * Redirect to dashboard if admin validation is successful
                 */
                redirect('admin/dashboard');
            }
        }

        /**
         * Load login form view
         */
        $this->data['pageTitle'] = 'Login | Admin';
        $this->data['isAdmin'] = $this->isAdmin;
        $this->load->view('login', $this->data);
    }

    /**
     * Verify admin credential from Form Post
     * 
     * @return boolean
     */
    private function _processLogin() {
        $username = $this->input->post('username', true);
        $password = trim($this->input->post('password'));
        

        // Check admin exists or not in user table
        $this->mu->condition = ['username' => $username, 'role' => $this->mu::USER_ROLES['admin']];
        $userInfo = $this->mu->getTableRow();

        if (!empty($userInfo)) {
            

            // Check user provided correct password or not
            if (password_verify($password, $userInfo->password) === TRUE) {

                $this->session->set_flashdata('success-msg', ' User is found!');

                $this->session->set_userdata([
                    'userId' => $userInfo->id,
                    'username' => $userInfo->username,
                    'admin' => true
                ]);

                // Add user login time in database
                $this->ml->data = [
                    'login_type' => 'admin',
                    'user_id' => $userInfo->id,
                    'time' => time()
                    ];
                $this->ml->insertIntoTable($this->ml->data);

                return true;
            } else {

                $this->session->set_flashdata('error-msg', ' Admin not found!');
            }
        } else {

            $this->session->set_flashdata('error-msg', ' Admin not found!');
        }

        return false;
    }
    
    /**
     * Destroy User Session 
     * Redirects to Login Form
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}
