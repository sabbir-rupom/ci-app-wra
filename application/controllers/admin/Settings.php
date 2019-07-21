<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property M_User $mu of User Model Class
 */
class Settings extends MY_Controller {

    public $activeMenu;

    function __construct() {
        parent::__construct();
        $this->activeMenu = 'st';

        // Load User Model Class
        $this->load->model('M_User', 'mu');
    }

    public function index() {
        /**
         * Redirect to settings view method
         */
        $this->show();
    }

    /**
     * View Admin Settings Form
     */
    public function show() {
        /**
         * Load admin settings view
         */
        $this->processViewData('admin/settings', 'Settings | Admin', $this->activeMenu);
    }

    /**
     * Change Admin Password through Post method
     */
    public function changePassword() {
        if ($this->input->post('new_password')) {
            /**
             * Get Post Data
             */
            $curr_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $conf_password = $this->input->post('confirm_password');

            /**
             * Get admin information by user ID
             */
            $adminInfo = $this->mu->get_table_row('admin_users', array('id' => $adminID));

            if (!empty($adminInfo)) {
                $password = $adminInfo->password;
                if (password_verify($curr_password, $password) === FALSE) {
                    $this->session->set_flashdata('error-msg', ' Your current password does not match!');
                } else {
                    if ($new_password == $conf_password) {
                        if (strlen($new_password) > 4) {
                            $password = password_hash(trim($new_password), PASSWORD_BCRYPT, array('cost' => 10));

                            $this->mu->data = [
                                'password' => $password
                            ];

                            $this->mu->updateTableById($this->data['userData']['id']);
                            $this->session->set_flashdata('success-msg', ' Password updated successfully');
                        } else {
                            $this->session->set_flashdata('error-msg', ' Password length must be greater than 4 characters');
                        }
                    } else {
                        $this->session->set_flashdata('error-msg', ' Password did not match!');
                    }
                }
            } else {
                $this->session->set_flashdata('error-msg', ' A session error eccured! Please login again.');
                redirect('admin/login');
            }
        }

        // return to settings view page
        $this->show();
    }

}
