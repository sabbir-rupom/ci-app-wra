<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_UserItem extends MY_Model {
    
    /**
     * Name of the associated table in database
     * @var string  
     */
    protected $tableName = 'user_items';
    
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
        'user_id' => array(
            'type' => 'int',
            'return' => true
        ),
        'item_id' => array(
            'type' => 'int',
            'return' => true
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

    public function __construct() {
        parent::__construct();
        $this->condition = $this->data = [];
    }

}
