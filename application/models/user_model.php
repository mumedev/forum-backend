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
    function select($id, $username) {
        if ($id) $this->db->where('id', $id);
        if ($username) $this->db->where('username', $username);
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
        
        // TODO : string length, ... other checks ...
        $data['password'] = md5(trim($data['password']));
        
        if (! $data['password'] || ! $data['username']) return false;
        
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
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }
    
    /**
     * 
     * @param type $id
     * @param type $username
     * @param type $password
     * @return boolean
     */
    function validate_login($id, $username, $password) {
        if (! $username && ! $id) return false;
        if ($username)  $this->db->where('username', $username);
        if ($id)        $this->db->where('id', $id);
        $this->db->where('password', md5($password));
        $query = $this->db->get('user');
        return ($query->num_rows() == 1);
    }
    
    /**
     * Verify if there is a session for the given user.
     * @param type $id
     * @param type $username
     * @param type $session_id
     * @return boolean
     */
    function validate_session($id, $username, $session_id) {
        if (! $username && ! $id)   return false;
        if (! $session_id)          return false;
        if ($id) $this->db->where('id', $id);
        if ($username) $this->db->where('username', $username);
        $this->db->where('session_id', $session_id);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Create a new session for the given user.
     * @param type $id
     * @param type $username
     * @param type $password
     * @return type
     */
    function create_session($id, $username, $password) {
        if (! $this->validate_login($id, $username, $password)) return;
        $this->load->helper('string_helper');
        $data['session_id'] = random_string('alnum', 32);
        if ($id) $this->db->where('id', $id);
        if ($username) $this->db->where('username', $username);
        if ($this->db->update('user', $data))
            return $data['session_id'];
        else
            return;
    }
    
    /**
     * Delete the session for the given user.
     * @param type $id
     * @param type $username
     * @param type $session_id
     * @return boolean
     */
    function delete_session($id, $username, $session_id) {
        if (!$this->validate_session($id, $username, $session_id)) return false;
        if ($id) $this->db->where('id', $id);
        if ($username) $this->db->where('username', $username);
        $this->db->where('session_id', $session_id);
        $data['session_id'] = NULL;
        return $this->db->update('user', $data);
    }
    
    /**
     * 
     * @param type $id
     * @param type $username
     * @return type
     */
    function getskills($id, $username) {
        $query = $this->db->query('SELECT s.id, s.name FROM skill s, user_skill us WHERE us.user_id = ' . $id . ' AND us.skill_id = s.id');
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
     * @param type $username
     * @return type
     */
    function getanswers($id, $username) {
        $query = $this->db->query('SELECT a.id, a.date_posted, a.text, a.question_id, a.author '
                . ' FROM answer a WHERE a.author = ' . $id);
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
     * @param type $username
     * @return type
     */
    function getquestions($id, $username) {
        $query = $this->db->query('SELECT q.id, q.date_posted, q.text, q.author '
                . ' FROM question q WHERE q.author = ' . $id);
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