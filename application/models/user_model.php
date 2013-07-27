<?php
/**
 * Description of user_model
 *
 * @author Joris Schelfaut
 */
class User_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * <p>
     * Get all records in the Test table.
     * </p>
     * @return Array
     */
    function get_all() {
        
        $this->db->select('name');
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return array();
        }
    }
}

?>
