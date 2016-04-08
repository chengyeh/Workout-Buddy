<?php
require_once(LIB_PATH.DS."database.php");
/**
     * Database object containing information of all the various attributes(table column headers, presence of attribute etc.) of the database.
     *
     * @param  
     * @return All rows from table are returned
     */
class DatabaseObject {
    protected static $table_name;
    
    /**
     * Query all the rows from a table
     *
     * @param  
     * @return All rows from table are returned
     */
    public static function find_all(){
        return static::find_by_sql("SELECT * FROM ".static::$table_name);
    }
    
    /**
     *	Query table to acquire user by id and store results in an array
     *
     * @param int $ID to keep track of user
     * @return Array containing queried objects
     */
    public static function find_by_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name .
                        " WHERE id=". $database->escape_value($id) . " LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    
    /**
     * Query SQL from a table as objects and store in an array
     *
     * @param Empty String
     * @return Array containing queried objects
     */
    public static function find_by_sql($sql=""){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)){
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    /**
     * Query the count of rows from the table
     *
     * @param
     * @return array containing number of rows
     */
    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }
    
    /**
     * Count the number of times a certain value appears in a table and store it in an array
     *
     *
     * @return array containing row size
     */
    public static function count_all_where($condition){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $sql .= " WHERE " . $condition;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }
    
    /**
     * Query database for a certain object
     *
     * @param The value being searched for in table
     * @return A row of data from the table as object
     */
    private static function instantiate($record){
        $class_name = get_called_class();
        $object = new $class_name;
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        return $object;
    }
    
    /**
     * Checks whether the database contains a certain attribute(column name)
     *
     * @param Attribute name
     * @return True or false based on whether attribute is present.
     */
    private function has_attribute($attribute){
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars);
    }
    
    /**
     * Query database for object's attributes and store as an array.
     *
     * @param
     * @return Array with attributes 
     */
    protected function attributes(){
        $attributes = array();
        foreach(static::$db_fields as $field){
            if(property_exists($this, $field)){
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }
    
    /**
     * 
     *
     * @param
     * @return
     */
    protected function sanitized_attributes(){
        global $database;
        $clean_attributes = array();
        foreach($this->attributes() as $key=>$value){
            $clean_attributes[$key]=$database->escape_value($value);
        }
        return $clean_attributes;
    }
    
    /**
     * Save a object to the database table
     *
     */
    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }
    
    /**
     * Insert a object's data into the appropiate table
     * @return true if succesully inserted into table, else false.
     */
    public function create(){
        global $database;
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO ". static::$table_name ." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("','", array_values($attributes));
        $sql .= "')";
        if($database->query($sql)){
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Objects data is updated to appropiate table
     *
     * @param
     * @return return true or false if a row was updated
     */
    public function update(){
        global $database;
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach($attributes as $key=>$value){
            $attributes_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ". static::$table_name ." SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= " WHERE id=". $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }
    
    /**
     * Delete object's data from the table.
     *
     * @param
     * @return True of false based on whether object was deleted.
     */
    public function delete(){
        global $database;
        $sql = "DELETE FROM ". static::$table_name;
        $sql .= " WHERE id=". $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }
}
?>