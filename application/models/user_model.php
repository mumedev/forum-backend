<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * The User_model class provides methods for reading and writing
 * from and to the database respectively.
 *
 * @author Joris Schelfaut
 */
class User_model extends CI_Model {
    
    /**
     * Sets variables at object initialization.
     * E.g.
     *      $params = array('type' => 'large', 'color' => 'red');
     *      $this->load->library('Someclass', $params);
     * Source:
     * http://ellislab.com/codeigniter/user-guide/general/creating_libraries.html
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all records in the user table.
     * @return Array
     */
    function select_all() {
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
    
    /**
     * Get the user with id equal to the given id.
     * @param type $id
     * @return type
     */
    function select($id) {
        $this->db->where('id', $id);
        //$this->db->select('name, date_joined, password');
        $query = $this->db->get('user');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }
    
    /**
     * Insert a new record into the user table.
     * @param int $data
     */
    function insert($data) {
        return $this->db->insert('user', $data);
    }
    
    /**
     * Update a record with given id in the user table.
     * @param int   $id
     * @param array $data
     */
    function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }
    
    /**
     * Delete a record in the user table with given id.
     * @param type $id
     */
    function delete($id) {
        //$this->db->where('id', $this->uri->segment(3));
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }
    
    function validate_login() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('user');
        return ($query->num_rows() == 1);
    }
    
}

?>