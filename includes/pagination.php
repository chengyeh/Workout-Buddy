<?php
/*
 *	@file pagination.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Hepler class for paginate of data.
*/

class Pagination {
    public $current_page; 
    public $per_page; //number of rows per page
    public $total_count; //total number of rows
    
    /**
     * Default constructor with default values
     *
     * @return
     */
    public function __construct($page=1,$per_page=20, $total_count=0){
        $this->current_page = (int)$page;
        $this->per_page = (int)$per_page;
        $this->total_count = (int)$total_count;
    }
    
    /**
     * Returns the calculated offset 
     *
     * @return offset
     */
    public function offset(){
        return ($this->current_page -1) * $this->per_page;
    }
    
    /**
     * Returns total number of pages
     *
     * @return total number of pages
     */
    public function total_pages(){
        return ceil($this->total_count/$this->per_page);
    }
    
    /**
     * Returns the previous page number
     *
     * @return previous page numbe
     */
    public function previous_page(){
        return $this->current_page -1;
    }
    
    /**
     * Returns next page number
     *
     * @return next page number
     */
    public function next_page(){
        return $this->current_page +1;
    }
    
    /**
     * Returns boolean if a page has a previous page
     *
     * @return boolean
     */
    public function has_previous_page(){
        return $this->previous_page() >= 1 ? true : false;
    }
    
    /**
     * Returns boolean if a page has a next page
     *
     * @return boolean
     */
    public function has_next_page(){
        return $this->next_page() <= $this->total_pages() ? true : false;
    }
}

?>