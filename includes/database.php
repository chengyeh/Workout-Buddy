<?php
// Workout Buddy Manual
// 
//    
// Copyright (C) <2016>  <Paul Charles, Kuei-Hsien Chu, Purna Doddapaneni, Dilesh Fernando, Cheng-Yeh Lee>
// 
// This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
// 
// You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
?>
<?php
/*
 *	@file database.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Database connetivity and CRUD functionality .
*/

require_once(LIB_PATH.DS."config.php");

class MySQLDatabase{
    
    private $connection;
    public $last_query;
    private $magic_quotes_active;
    private $real_escape_string_exists;
    
    /**
	 * Default constructor connects to database 
	 *
	 * @param
	 * @param
	 * @return
	 */
    function __construct(){
        $this->open_connection();
        $this->magic_quotes_active = get_magic_quotes_gpc();
        $this->real_escape_string_exists = function_exists("mysql_real_escape_string");
    }

   /**
	 * This method opens the connection to the database. 
	 *
	 * @param
	 * @param
	 * @return
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
	 * This method close the connection to the database. 
	 *
	 * @param
	 * @param
	 * @return
	 */
    public function close_connection(){
        if (isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
    
     /**
	 * This method queries database with given sql string.
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
	 * This method escapes special characters from the string.
	 *
	 * @param string
	 * @return string all special characters escaped
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
	 * Returns an array that corresponds to the fetched row or NULL if there 
	 *are no more rows for the result set represented by the result parameter.
	 *
	 * @param result set
	 * @return returns associated array
	 */
    public function fetch_array($result_set){
        return mysqli_fetch_array($result_set);
    }
    
     /**
	 * Returns the number of rows in the result set.
	 *
	 * @param  Unbuffered result sets 
	 * @return Returns number of rows in the result set.
	 */

    public function num_rows($result_set){
        return mysqli_num_rows($result_set);
    }
    
     /**
	 * Returns the last id of insert into that database.
	 *
	 * @param
	 * @return
	 */
    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }
    
     /**
	 * Returns the number of rows affected by last sql statement.
	 *
	 * @param
	 * @return
	 */
    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }
    
     /**
	 * Confirms wheather query was a success.
	 *
	 * @param
	 * @return
	 */
    private function confirm_query($result){
        if(!$result){
            $output = "Database query failed. " . mysqli_error($this->connection) . "<br />";
            $output .= "Last SQL query: " . $this->last_query;
            die($output);
        }
    }
}//end of MySQLDatabse class.

//Create instance of the Database class.
$database = new MySQLDatabase();

?>