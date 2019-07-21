<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends MY_Controller {
    
    function __construct() {
        parent::__construct();
    }

    public function index() {
        /**
         * Load home view
         */
        $this->processViewData('front/console', 'REST-API Console | CI-Application');
    }

}
