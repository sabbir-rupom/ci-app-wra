<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User authentication class to verify admin controller access
 * 
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Router $router
 */
class Authenticate {

    private $CI;
    private $subDirectoryClass;
    private $ignoredController;

    function __construct() {
        $this->CI = & get_instance();
        $this->ignoredController = ['Auth'];
        $this->subDirectoryClass = strtolower($this->CI->router->fetch_directory());
    }

    /**
     * Check if an admin is logged in or not
     * If logged in allow access to Admin controller classes 
     * Else redirect to Admin login page 
     */
    public function checkController() {
        
        if(stristr($this->subDirectoryClass, 'admin')) {

            if ($this->CI->session->has_userdata('userId') == false || $this->CI->session->userdata('userId') <= 0) {
                if (in_array($this->CI->router->fetch_class(), $this->ignoredController) == false) {
                    redirect('admin/login');
                }
            }
        }

    }

}


