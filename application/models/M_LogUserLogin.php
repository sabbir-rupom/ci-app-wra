<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_LogUserLogin extends MY_Model {
    
    /**
     * Name of the associated table in database
     * @var string  
     */
    protected $tableName = 'log_user_logins';
    
    /**
     * Primary key of the table
     * @var int  
     */
    protected $primaryKey = 'id';
    
    /**
     * Database table column definitions
     * @var array 
     */
    protected $dbColumns = array(
        'id' => array(
            'type' => 'int',
        ),
        'user_id' => array(
            'type' => 'id',
        ),
        'login_type' => array(
            'type' => 'string',
        ),
        'time' => array(
            'type' => 'int',
        ),
        'created_at' => array(
            'type' => 'datetime',
        ),
        'updated_at' => array(
            'type' => 'datetime',
        )
    );

    
    /**
     * Hold query condition
     * @var array  
     */
    public $condition;

    /**
     * Hold data for query insert / update
     * @var array 
     */
    public $data;

    public function __construct() {
        parent::__construct();
        $this->condition = $this->data = [];
    }
}
