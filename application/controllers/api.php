<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

/**
 * The public REST API controller class.
 * 
 * Supported actions for each resource :
 * 
 * <ul>
 *  <li>
 *      GET : Used to fetch information about an existing resource. 
 *      This is used by browsers when you enter a URL and hit go, 
 *      or when you click on a link, so it perfect for fetching information
 *      on one of your REST resources (like user).
 *      <br />
 *      A GET method signature consists out of the API method followed by
 *      "_get".
 *  </li>
 *  <li>
 *      POST : Used to update an existing resource with information. 
 *      Browsers use this to submit most types of forms on the internet,
 *      although some use GET as well by submitting the form action with a
 *      query string containing the field data.
 *      <br />
 *      A POST method signature consists out of the API method followed by
 *      "_post".
 *      
 *  </li>
 * </ul>
 *
 * @author  Joris Schelfaut
 * @info    based on a tutorial by Philip Sturgeon
 */
class Api extends REST_Controller {
    
    /**
     * Default page loaded when the controller is loaded.
     */
    function index() {
        $params['page'] = 'api';
        $this->load->view('templates/default', $params);
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  user methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * Returns information on the user profile.
     * parameters:
     *      id          INT         the id of the user
     *      username    STRING      the username of the user
     * At least one of both is required.
     */
    function user_getinfo_get() {
        $id = $this->get('id');
        $username = $this->get('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
        }
        $this->load->model('user_model');
        $user = $this->user_model->select($id, $username);
        if ($user) {
            $this->response($user, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Requires authentication.
     */
    function user_updateinfo_post() {
        $id = $this->post('id');
        $username = $this->post('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        if (! $this->_validate_session($id, $username, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
        $data = array();
        if ($this->post('username')) $data['username'] = $this->post('username');
        if ($this->post('password')) $data['password'] = $this->post('password');
        if ($this->post('emailaddress')) $data['email_address'] = $this->post('emailaddress');
        if ($this->post('homepage')) $data['homepage'] = $this->post('homepage');
        
        $this->load->model('user_model');
        $result = $this->user_model->update($id, $data);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    function user_register_post() {
        $data = array();
        
        if ($this->post('username')) $data['username'] = $this->post('username');
        if ($this->post('password')) $data['password'] = $this->post('password');
        if ($this->post('emailaddress')) $data['email_address'] = $this->post('emailaddress');
        if ($this->post('homepage')) $data['homepage'] = $this->post('homepage');
        
        $this->load->model('user_model');
        $result = $this->user_model->insert($data);

        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    /**
     * Delete a given user.
     * Requires authentication.
     */
    function user_delete_post() {
        $id = $this->post('id');
        $username = $this->post('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        if (! $this->_validate_session($id, $username, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
        $this->load->model('user_model');
        $result = $this->user_model->delete($id, $username);
        
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    
    function user_search_get() {}
    
    /**
     * Get the skills for a given user.
     */
    function user_getskills_get() {
        $id = $this->get('id');
        $username = $this->get('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('user_model');
        $skills = $this->user_model->getskills($id, $username);
        if ($skills) {
            $this->response($skills, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Get the answers given by a certain user.
     */
    function user_getanswers_get() {
        $id = $this->get('id');
        $username = $this->get('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('user_model');
        $answers = $this->user_model->getanswers($id, $username);
        if ($answers) {
            $this->response($answers, 200);
        } else {
            $this->response(NULL, 404);
        }
        
    }
    
    /**
     * Retrieve the question posed by a user.
     */
    function user_getquestions_get() {
        $id = $this->get('id');
        $username = $this->get('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('user_model');
        $questions = $this->user_model->getquestions($id, $username);
        if ($questions) {
            $this->response($questions, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  skill methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    function skill_search_get() {}
    
    /**
     * Create a new skill.
     */
    function skill_create_post() {
        if (! $this->_validate_session($this->post('id'), NULL, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
        $this->load->model('skill_model');
        $data['name'] = $this->post('name');
        $this->skill_model->insert($data);
    }
    
    /**
     * Get the questions related to a given skill.
     */
    function skill_getquestions_get() {
        $id = $this->get('id');
        $name = $this->get('name');
        if (!$id && !$name) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('skill_model');
        $questions = $this->skill_model->getquestions($id, $name);
        if ($questions) {
            $this->response($questions, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Get the users that have a given skill.
     */
    function skill_getusers_get() {
        $id = $this->get('id');
        $name = $this->get('name');
        if (!$id && !$name) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('skill_model');
        $users = $this->skill_model->getusers($id, $name);
        if ($users) {
            $this->response($users, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  question methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    function question_search_get() {}
    
    function question_getanswers_get() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('question_model');
        $users = $this->question_model->getanswers($id);
        if ($users) {
            $this->response($users, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    function question_getskills_get() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('question_model');
        $skills = $this->question_model->getskills($id);
        if ($skills) {
            $this->response($skills, 200);
        } else {
            $this->response(NULL, 404);
        }    
    }
    
    function question_create_post() {
        $id = $this->post('id');
        $username = $this->post('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        if (! $this->_validate_session($id, $username, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    function question_getinfo_get() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('question_model');
        $question = $this->question_model->select($id);
        if ($question) {
            $this->response($question, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    function question_delete_post() {
        $id = $this->post('id');
        $username = $this->post('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        if (! $this->_validate_session($id, $username, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  answer methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    function answer_search_get() {}
    
    /**
     * Get the question for the given answer.
     */
    function answer_getquestion_get() {
        $id = $this->get('id');
        if (!$id) {
            $this->response(NULL, 400);
            return;
        }
        $this->load->model('answer_model');
        $question = $this->answer_model->getquestion($id);
        if ($question) {
            $this->response($question, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * Create an answer.
     */
    function answer_create_post() {
        $id = $this->post('id');
        $username = $this->post('username');
        if (!$id && !$username) {
            $this->response(NULL, 400);
            return;
        }
        if (! $this->_validate_session($id, $username, $this->post('session'))) {
            $this->response(array('status' => 'failed'));
            return;
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////
    //
    //  authentication methods
    //
    ////////////////////////////////////////////////////////////////////////////
    
    /**
     * Start a new session for the given user.
     */
    function authentication_startsession_get() {
        $this->load->model('user_model');
        $key = $this->user_model->create_session($this->get('id'), $this->get('username'), $this->get('password'));
        if ($key) {
            $this->response($key, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    /**
     * End the session for the given user.
     */
    function authentication_endsession_get() {
        $this->load->model('user_model');
        $this->user_model->delete_session($this->get('id'), $this->get('username'), $this->get('session'));
    }
    
    /**
     * Verifies if the given $session_id corresponds to the stored session
     * id for the user.
     * @param   String $session_id
     * @return  boolean
     */
    function _validate_session($id, $username, $session_id) {
        $this->load->model('user_model');
        return $this->user_model->validate_session($id, $username, $session_id);
    }
    
}

?>
