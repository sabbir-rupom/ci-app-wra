<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property M_User mu Get Properties of User Model Class
 * @property M_UserItem mut Get Properties of User Item Model Class
 * @property M_Item mi Get Properties of Item Model Class
 * @property M_LogUserLogin mlu Get Properties of Log User Login Model Class
 */
class Dashboard extends MY_Controller {

    public $activeMenu;

    function __construct() {
        parent::__construct();
        $this->activeMenu = 'ds';
    }

    public function index() {
        /**
         * Load admin dashboard view
         */
        $this->processViewData('admin/dashboard', 'Dashboard | Admin', $this->activeMenu);
    }

}

