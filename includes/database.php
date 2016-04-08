<?php
require_once(LIB_PATH.DS."config.php");

class MySQLDatabase{
    
    private $connection;/*!< A variable referencing the connection*/
    public $last_query;/*!< Variable tracking last query*/
    private $magic_quotes_active;/*!< Variable keeping track of awehther magic_qoutes is active*/
    private $real_escape_string_exists;/*!< Variable to keep track of wether real_escape_string exists or not*/
    
    /**
	 * Default constructor which connects to database 
	 */
    function __construct(){
        $this->open_connection();
        $this->magic_quotes_active = get_magic_quotes_gpc();
        $this->real_escape_string_exists = function_exists("mysql_real_escape_string");
    }

   /**
	 * Opens the connection to the database. 
	 */
    public function open_connection(){
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->connection){
            die("Database connection failed. " . mysqli_error($this->connection));
        } else {
            $db_select = mysqli_select_db($this->connection, DB_NAME);
            if (!$db_select){
                die("Database selection failed. " . mysqli_error());
            }
        }
    }
    
     /**
	 * Close the connection to the database. 
	 */
    public function close_connection(){
        if (isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    
     /**
	 * Query the database with given sql string.
	 *
	 * @param SQL statement as string
	 * @return result set
	 */
    public function query($sql){
        $this->last_query = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }
    
     /**
	 * Escapes special characters from the string.
	 *
	 * @param string value
	 * @return string of all special characters escaped
	 */
    public function escape_value($value){
        if($this->real_escape_string_exists){
            if($this->magic_quotes_active){ $value = stripslashes($value);}
            $value = mysqli_real_escape_string($this->connection, $value);
        } else {
            if(!$this->magic_quotes_active){$value = addslashes($value);}
        }
        return $value;
    }
    
    //database-neutral methods.
    
    /**
	 * Create an array that corresponds to the fetched row or NULL if there 
	 * are no more rows for the result set represented by the result parameter.
	 *
	 * @param result set
	 * @return associated array
	 */
    public function fetch_array($result_set){
        return mysqli_fetch_array($result_set);
    }
    
     /**
	 * Obtain the number of rows in the result set.
	 *
	 * @param  Unbuffered result sets 
	 * @return number of rows in the result set.
	 */

    public function num_rows($result_set){
        return mysqli_num_rows($result_set);
    }
    
     /**
	 * Query database for last id of insert into a database.
	 *
	 * 
	 * @return Results of database Query
	 */
    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }
    
     /**
	 * Query the database number of rows affected by last sql statement.
	 *
	 * 
	 * @return Results of database query  
	 */
    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }
    
     /**
	 * Confirms whether databse was successully queried.
	 *
	 * @param
	 * @return Output message.
	 */
    private function confirm_query($result){
        if(!$result){
            $output = "Databse query failed. " . mysqli_error($this->connection) . "<br />";
            $output .= "Last SQL query: " . $this->last_query;
            die($output);
        }
    }
}//end of MySQLDatabse class.

/*!< A global database variable reference the database in use.*/
$database = new MySQLDatabase();

?>