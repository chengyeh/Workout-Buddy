<?php
require_once(LIB_PATH.DS."database.php");

class DatabaseObject {
    protected static $table_name;

    /**
     * Returns all the rows from a table as objects
     *
     * @param
     * @return
     */
    public static function find_all(){
        return static::find_by_sql("SELECT * FROM ".static::$table_name);
    }

    /**
     *	Returns a row from a table as object
     *
     * @param
     * @return
     */
    public static function find_by_id($id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name .
                        " WHERE id=". $database->escape_value($id) . " LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    public static function find_by_x_id($x_id=0){
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name .
                        " WHERE x_id=". $database->escape_value($x_id) . " LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    /**
     * Returns sql from a table as objects
     *
     * @param
     * @return
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
     * Returns the count of rows from the table
     *
     * @param
     * @return
     */
    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    /**
     * Returns the count of rows from the table with condition
     *
     * @param
     * @return
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
     * Return a row of data from the table as object
     *
     * @param
     * @return
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
     *
     *
     * @param
     * @return
     */
    private function has_attribute($attribute){
        $object_vars = $this->attributes();
        return array_key_exists($attribute, $object_vars);
    }

    /**
     * Return object's attributes as an associative array
     *
     * @param
     * @return
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
     * @param
     * @return
     */
    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

    /**
     * Insert a object's data into the appropiate table
     *
     * @param
     * @return
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
     * @return
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
     * @return
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
