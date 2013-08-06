<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of skill_model
 *
 * @author JORIS
 */
class Skill_model extends CI_Model {
    
    /**
     * Sets variables at object initialization.
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all records in the skill table.
     * @return Array
     */
    function select_all() {
        $query = $this->db->get('skill');
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
     * Get the skill with id equal to the given id.
     * @param int $id
     * @return Array
     */
    function select($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('skill');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }
    
    /**
     * Insert a new record into the skill table.
     * @param int $data
     */
    function insert($data) {
        $this->db->insert('skill', $data);
        return;
    }
    
    /**
     * Update a record with given id in the skill table.
     * @param int   $id
     * @param array $data
     */
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('skill', $data);
        return;
    }
    
    /**
     * Delete a record in the skill table with given id.
     * @param type $id
     */
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('skill');
        return;
    }
    
}

?>
