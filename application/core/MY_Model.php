<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Base model for all custom model classes
 * Extends CI_Model class
 * 
 * @property CI_DB_query_builder $db
 * @property CI_DB_forge $dbforge
 * @property CI_Config $config
 * @property CI_Loader $load
 * @property CI_Session $session
 */
class MY_Model extends CI_Model {

    private $result; // Hold query result
    protected $primaryKey; // Hold child table Primary key
    protected $tableName; // Hold child table name
    protected $dbColumns; // Hold child table columns
    protected $condition; // Hold query condition
    protected $data; // Hold data for query insert / update

    public function __construct() {
        parent::__construct();
    }

    /**
     * Flush model data and conditions after each method call
     * 
     * @param string $method Class method name
     * @param mix $param Called method arguments
     * @return mix Executed result of called method
     */
    public function __call($method, $param) {
        $result = $this->$method($param);

        $this->condition = $this->data = [];

        return $result;
    }

    /**
     * Get table row based on query condition
     * 
     * @param bool $arr Check if return result should be in array or object
     * @param string $columnSpecific Specific column to return value from array or object
     * 
     * @return mixed Query Result
     */
    public function getTableRow($arr = false, $columnSpecific = '') {
        $query = $this->db->where($this->condition)->get($this->tableName);

        if ($arr) {
            $this->result = $query->row_array();
            if ($columnSpecific != '' && array_key_exists($columnSpecific, $this->result)) {
                return $this->result[$columnSpecific];
            }
        } else {
            $this->result = $query->row();
            if ($columnSpecific != '' && property_exists($this->result, $columnSpecific)) {
                return $this->result->$columnSpecific;
            }
        }
        return $this->result;
    }

    /**
     * Get table row based on primary key
     * 
     * @param mixed $id Primary key value 
     * @param bool $arr Check if return result should be in array or object
     * @param string $columnSpecific Specific column to return value from array or object
     * 
     * @return mixed Query Result
     */
    public function getTableRowById($id, $arr = false, $columnSpecific = '') {
        $query = $this->db->where($this->primaryKey, $id)->get($this->tableName);

        if ($arr) {
            $this->result = $query->row_array();
            if ($columnSpecific != '' && array_key_exists($columnSpecific, $this->result)) {
                return $this->result[$columnSpecific];
            }
        } else {
            $this->result = $query->row();
            if ($columnSpecific != '' && property_exists($this->result, $columnSpecific)) {
                return $this->result->$columnSpecific;
            }
        }

        return $this->result;
    }

    /**
     * Get table row based on primary key
     * 
     * @return mixed if success returns insert ID, else false
     */
    public function insertIntoTable() {
        $this->data['created_at'] = date('Y-m-d H:i:s');
        $this->result = $this->db->insert($this->tableName, $this->data);
        return $this->result ? $this->db->insert_id() : false;
    }

    /**
     * Update table based on conditions provided 
     * 
     * @return bool if success returns true, else false
     */
    public function updateTable() {
        $this->db->where($this->condition)->update($this->tableName, $this->data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    /**
     * Update table row based on primary key
     * 
     * @param mixed $id Primary key value 
     * 
     * @return bool if success returns true, else false
     */
    public function updateTableById($id) {
        $this->db->where($this->primaryKey, $id)->update($this->tableName, $this->data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    /**
     * Delete all rows inside a table 
     */
    public function truncateTable() {
        $this->db->truncate($this->tableName);
    }

    /**
     * Get table data based on conditions provided
     * 
     * @param string $select Comma separated column names
     * @param int $limit Row limit to be fetched 
     * @param int $offset Row offset after which to be fetched 
     * @param string $sortBy Table data sort parameter
     * @param string $sortOrder Table data sorting order parameter
     * @param bool $arr Check if return result should be in array or object
     * 
     * @return mixed Query Result
     */
    public function getTableData($select = '*', $limit = 15, $offset = 0, $sortBy = '', $sortOrder = 'ASC', $arr = false) {
        if (empty($sortBy)) {
            $sortBy = $this->primaryKey;
        }
        if (!empty($this->condition)) {
            $this->_prepareConditions($this->condition);
        }
        if ($limit > 0) {
            $this->db->order_by($sortBy, $sortOrder);
        }
        $query = $this->db->select($select)->get($this->tableName);

        $this->result = $arr ? $query->result_array() : $query->result();

        return $this->result;
    }

    /**
     * Count table data based on conditions
     * 
     * @return int Number of results found
     */
    public function countTableRow($all = false) {
        if ($all) {
            $this->result = $this->db->select($this->primaryKey)->count_all_results($this->tableName);
        } else {
            $this->result = $this->db->where($this->condition)->count_all_results($this->tableName);
        }
        return $this->result;
    }

    /**
     * Delete table rows based on conditions
     * 
     * @return int Number of deleted rows
     */
    public function deleteTableRow() {
        $this->db->delete($this->tableName, $this->condition);
        return $this->db->affected_rows();
    }

    /**
     * Delete table rows based on primary key
     * 
     * @return int Number of deleted rows
     */
    public function deleteTableRowById($id) {
        $this->db->delete($this->tableName, [$this->primaryKey => $id]);
        return $this->db->affected_rows();
    }

    /**
     * Get table columns
     * 
     * @param bool $arr Check if return result should be in array or object
     * 
     * @return mixed list of table columns
     */
    public function getTableColumns($arr = false) {
        $query = $this->db->query('SHOW COLUMNS FROM ' . $this->tableName);
        $this->result = $arr ? $query->result_array() : $query->result();
        return $this->result;
    }

    /**
     * Check if data is unique based on conditions provided
     * 
     * @return bool True if unique, False otherwise 
     */
    public function checkUnique() {
        $this->result = $this->countTableRow();
        return $this->result > 0 ? false : true;
    }

    /**
     * Return the column name list defined in model class
     */
    protected function getColumns() {
        if (isset($this->dbColumns)) {
            return array_keys($this->dbColumns);
        }

        return array();
    }

    /**
     * To check whether there requested column both in database and model class definition.
     *
     * @param $name Name of the column to be verified
     * 
     * @return bool Returns true if column is properly defined, false otherwise
     */
    public function isValidColumn($name) {
        return in_array($name, $this->getColumns()) &&
                in_array($name, $this->getTableColumns(true));
    }

    /**
     * Returns the type of column.
     *
     * @param string $column Target column name defined in model class
     * @return string Data type of targeted column
     */
    protected static function getColumnType($column) {
        return $this->dbColumns[$column]['type'];
    }

    /**
     * Return an associative array after processing all data with proper type
     */
    public function processTableData() {
        $this->result = [];
        foreach ($this->getColumns() as $column) {
            if ('int' === $this->getColumnType($column) && isset($this->{$column})) {
                $this->result[$column] = (int) $this->{$column};
            } elseif ('float' === $this->getColumnType($column) && isset($this->{$column})) {
                $this->result[$column] = floatval($this->{$column});
            } elseif ('bool' === $this->getColumnType($column) && isset($this->{$column}) && !is_null($this->{$column})) {
                $this->result[$column] = (bool) $this->{$column};
            } else {
                $this->result[$column] = (!isset($this->{$column}) || is_null($this->{$column})) ? '' : $this->{$column};
            }
        }

        return $this->result;
    }

    /**
     * Return table name declared in child class
     * 
     * @return string Table name 
     */
    public static function getTableName() {
        $instance = new static;
        $this->tableName = $instance->tableName;
        unset($instance);
        return $this->tableName;
    }

    /**
     * Generate random token string in base64 format
     * 
     * @return string Random token
     */
    public function generateToken() {
        $issueTime = time() . '_' . rand(1000, 9999);
        return base64_encode($issueTime);
    }

    /**
     * Parse condition keys and prepare necessary CI active records for DB Query
     * 
     * @param array $conditions DB query conditions
     */
    private function _prepareConditions($conditions) {
        $and = $or = $in = $like = [];
        foreach ($conditions as $c => $v) {
            $v = trim($v);
            if (preg_match('~\sor|\s\|$~', $c)) {
                $or[] = $v;
            } elseif (stristr($c, ' like')) {
                $like[] = $v;
            } elseif(is_array($v)) {
                $in[] = $v;
            } else {
                $and[] = $v;
            }
        }
        
        if(!empty($and)) {
            $this->db->where($and);
        } 
        if(!empty($or)) {
            $this->db->or_where($or);
        } 
        if(!empty($like)) {
            $this->db->like($like);
        } 
        if(!empty($in)) {
            $this->db->where_in($in);
        }
        
        return true;
    }

}
