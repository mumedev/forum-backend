<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * <p>
 * Test_model is a model class to do some quick tests with the framework,
 * independent of the actual application.
 * </p>
 * 
 * @author Joris Schelfaut
 */
class Test_model extends CI_Model {
    
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
        // Prepared statement and query to the database (selecting the rows
        // that we'll be using)
        // Equivalent of $this->db->query('GET name FROM test');
        $this->db->select('name');
        $query = $this->db->get('test');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return array();
        }
    }
    
    function create($data) {
        $this->db->insert('test', $data);
        return;
    }
    
    function update($data) {
        $this->db->where('name', 'Persona 1');
        $this->db->update('test', $data);
    }
    
    function delete() {
        $this->db->where('name', 'Persona 1');
        $this->db->delete('test');
    }
}

?>
