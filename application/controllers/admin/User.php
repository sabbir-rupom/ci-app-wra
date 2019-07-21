<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item Settings Class
 * 
 * @property M_User $mu of User Model Class
 * @property M_Item $mi of Item Model Class
 */
class User extends MY_Controller {

    /**
     * Sidebar active menu slug
     * @var string 
     */
    protected $activeMenu;

    public function __construct() {
        parent::__construct();

        $this->activeMenu = 'us';

        // Load required database models
        $this->load->model('M_User', 'mu');
        $this->load->model('M_Item', 'mi');
    }

    /**
     * Redirects to Item List view method
     */
    public function index() {
        $this->show();
    }

    /**
     * View User in Tabular List
     */
    public function show() {
        $this->load->library('table');
        $this->data['userList'] = $this->mu->getTableData();

        /**
         * Load list view page
         */
        $this->processViewData('admin/user/list', 'User Settings | Admin', $this->activeMenu);
    }

    /**
     * Method for user details view
     * 
     * @param int $id User Id
     */
    public function details($id = 0) {

        $id = intval($id);
        /**
         * Get Item Information from database table
         */
        $this->data['userInfo'] = $this->mi->getTableRowById($id);
        $this->data['userId'] = $id;

        if (empty($this->data['userInfo'])) {
            $this->session->set_flashdata('error', 'Error! User does not exist!');
            redirect('admin/user/list');
        }

        /**
         * Load list view page
         */
        $this->processViewData('admin/user/details', 'User Settings | Admin', $this->activeMenu);
    }

    public function delete($id = 0) {
        $id = intval($id);
        if ($this->mi->deleteTableRowById($id) > 0) {
            // Success message in session
            $this->session->set_flashdata('success', 'Success! Item has been deleted!');
        } else {
            // Error message in session
            $this->session->set_flashdata('error', 'Error! Failed to delete item!');
        }

        redirect('admin/item/list');
    }

}
