<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_User extends MY_Model {

    /**
     * Name of the associated table in database
     * @var string  
     */
    protected $tableName = 'users';

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
            'return' => true
        ),
        'first_name' => array(
            'type' => 'string',
            'return' => true
        ),
        'last_name' => array(
            'type' => 'string',
            'return' => true
        ),
        'email' => array(
            'type' => 'string',
            'return' => true
        ),
        'username' => array(
            'type' => 'string',
            'return' => true
        ),
        'password' => array(
            'type' => 'string',
            'return' => true
        ),
        'profile_image' => array(
            'type' => 'string',
            'return' => true
        ),
        'gender' => array(
            'type' => 'string',
            'return' => true
        ),
        'personal_info' => array(
            'type' => 'string',
            'return' => true
        ),
        'notification_token' => array(
            'type' => 'string',
            'return' => true
        ),
        'role' => array(
            'type' => 'int',
            'return' => true
        ),
        'last_active_time' => array(
            'type' => 'datetime',
            'return' => false
        ),
        'created_at' => array(
            'type' => 'datetime',
            'return' => false
        ),
        'updated_at' => array(
            'type' => 'datetime',
            'return' => false
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
    
    /**
     * Definitions of user roles
     */
    const USER_ROLES = [
        'user' => 1,
        'admin' => 2
    ];

    public function __construct() {
        parent::__construct();
        $this->condition = $this->data = [];
    }

}
