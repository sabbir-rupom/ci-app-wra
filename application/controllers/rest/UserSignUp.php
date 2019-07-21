<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property M_User $mu 
 */
class UserSignUp extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->loginRequired = FALSE;
    }

    public function index() {
        echo 'hello';
    }

}
