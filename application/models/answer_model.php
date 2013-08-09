<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of answer_model
 *
 * @author Joris Schelfaut
 */
class Answer_model extends CI_Model {
    
    /**
     * Sets variables at object initialization.
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Get all records in the answer table.
     * @return Array
     */
    function select_all() {
        $query = $this->db->get('answer');
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
     * Get the answer with id equal to the given id.
     * @param int $id
     * @return Array
     */
    function select($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('answer');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }
    
    /**
     * Insert a new record into the answer table.
     * @param int $data
     */
    function insert($data) {
        $this->db->insert('answer', $data);
        return;
    }
    
    /**
     * Update a record with given id in the answer table.
     * @param int   $id
     * @param array $data
     */
    function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('answer', $data);
        return;
    }
    
    /**
     * Delete a record in the answer table with given id.
     * @param type $id
     */
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('answer');
        return;
    }
    
    function getquestion($id) {
        $query = $this->db->query('SELECT q.id, q.author, q.date_posted, q.text FROM question q, answer a WHERE a.id = ' . $id . ' AND a.question_id = q.id');
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
