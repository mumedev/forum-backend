<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Question
 * 
 * (also question_skill querries)
 * 
 * @author Joris Schelfaut
 */
class Question_model extends CI_Model {
    
    /**
     * Sets variables at object initialization.
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all records in the question table.
     * @return Array
     */
    function select_all() {
        $query = $this->db->get('question');
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
     * Get the question with id equal to the given id.
     * @param int $id
     * @return Array
     */
    function select($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('question');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }
    
    /**
     * Insert a new record into the question table.
     * @param int $data
     */
    function insert($data) {
        $this->db->insert('question', $data);
        return;
    }
    
    /**
     * Update a record with given id in the question table.
     * @param int   $id
     * @param array $data
     */
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('question', $data);
        return;
    }
    
    /**
     * Delete a record in the question table with given id.
     * @param type $id
     */
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('question');
        return;
    }
    
    /**
     * @param type $id
     * @return type
     */
    function getanswers($id) {
        $query = $this->db->query('SELECT a.id, a.date_posted, a.text, a.question_id, a.author '
                . ' FROM answer a WHERE a.question_id = ' . $id);
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
     * 
     * @param type $id
     * @return type
     */
    function getskills($id) {
        $query = $this->db->query('SELECT s.id, s.name FROM skill s, question_skill qs WHERE qs.question_id = ' . $id . ' AND qs.skill_id = s.id');
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
